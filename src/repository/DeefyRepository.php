<?php

namespace iutnc\deefy\repository;

use iutnc\deefy\entity\Playlist;

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
        $result = $query->execute();
        $result = $query->fetch();
        if (isset($result["nom"])) {
            $r = new Playlist($result["nom"]);
        } else $r = null;
        return $r;
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
        $track_title = $track->get(title);
        $track_author = $track->get(author);
        $query = "INSERT INTO track (titre, auteur_podcast) VALUES ('$track_title', '$track_author')";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $track->setID($this->pdo->lastInsertId());
        return $track;
    }

    public function addTrackToPlaylist(AudioTrack $track, Playlist $pl) {}

}
