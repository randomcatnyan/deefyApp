<?php

namespace iutnc\deefy\repository;

use iutnc\deefy\entity\Playlist;
use iutnc\deefy\entity\AudioTrack;

class DeefyRepository {

    private \PDO $pdo;
    private static ?DeefyRepository $instance = null;
    private static array $config = [ ];

    private function __construct(array $conf) {
        $conf = self::$config;
        $this->pdo = new \PDO($conf['dsn'], $conf['user'], $conf['pass'], [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new DeefyRepository(self::$config);
        }
        return self::$instance;
    }

    public static function setConfig(string $file) {
        $conf = parse_ini_file($file);
        if ($conf === false) {
            throw new \Exception("Error reading configuration file");
        }
        self::$config = [ 'dsn'=> $conf['driver'] . ":host=" . $conf['host'] . ";dbname=" . $conf['database'],'user'=> $conf['username'],'pass'=> $conf['password'] ];
    }

    //unfinished
    public function findPlaylistById(int $id): ?Playlist {
        $query = "SELECT * FROM playlist WHERE id=$id";
        $query = $this->pdo->prepare($query);
        $query->execute();
        $result = $query->fetch();
        if ( $result ) {
            $to_return = new Playlist($result["nom"]);
            $to_return->setID($result["id"]);
        } else $to_return = null;
        return $to_return;
    }

    public function getAllPlaylists() {
        $query = "SELECT * FROM playlist ";
        $query = $this->pdo->prepare($query);
        $query->execute();
        $to_return = [];
        foreach ( $query as $pl ) {
            $playlist = new Playlist($pl["nom"]);
            $playlist->setID($pl["id"]);
            array_push($to_return, $playlist);
        }
        return $to_return;
    }

    public function saveEmptyPlaylist(Playlist $pl): Playlist {
        $playlist_name = $pl->getName();
        $query = "INSERT INTO playlist (nom) VALUES ('$playlist_name')";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $pl->setID($this->pdo->lastInsertId());
        return $pl;
    }

    public function saveTrack(AudioTrack $track) {
        $track_title = $track->title;
        $track_author = $track->author;
        $query = "INSERT INTO track (titre, auteur_podcast) VALUES ('$track_title', '$track_author')";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $track->setID($this->pdo->lastInsertId());
        return $track;
    }

    public function addTrackToPlaylist(AudioTrack $track, Playlist $pl) {
        $id_track = $track->id;
        $id_playlist = $pl->getID();
        $query = "SELECT * FROM playlist2track WHERE id_pl = $id_playlist AND id_track = $id_track";
        $query = $this->pdo->prepare($query);
        $query->execute();
        $row = $query->fetch();
        if ( $row == null ) {
            $query = "INSERT INTO playlist2track (id_pl, id_track, no_piste_dans_liste) VALUES ('$id_playlist', '$id_track', 1)";
        } else {
            $query = "UPDATE playlist2track SET no_piste_dans_liste = " . ( $row["no_piste_dans_liste"] + 1 ) . " WHERE id_pl = $id_playlist AND id_track = $id_track";
        }
        $query = $this->pdo->prepare($query);
        $query->execute();
    }

}
