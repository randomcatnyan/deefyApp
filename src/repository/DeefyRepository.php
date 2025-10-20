<?php

namespace iutnc\deefy\repository;

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

    public function findPlaylistById(int $id): Playlist {
        $query = "SELECT * FROM playlist WHERE id=$id";
        $query = $this->pdo->prepare($query);
        $query->execute();
        return $query->fetch();
    }

    public function getAllPlaylists() {
        $query = "SELECT * FROM playlist ";
        $query = $this->pdo->prepare($query);
        $query->execute();
        return $query->fetchAll();
    }

    public function saveEmptyPlaylist(Playlist $pl): Playlist {
        $query = "INSERT INTO playlist (nom) VALUES (:nom)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['nom' => $pl->nom]);
        $pl->setID($this->pdo->lastInsertId());
        return $pl;
    }

    public function saveTrack(AudioTrack $track) {
        $query = "INSERT INTO track (titre) VALUES (:nom)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['nom' => $track->nom]);
        $track->setID($this->pdo->lastInsertId());
        return $track;
    }

    public function addTrackToPlaylist(AudioTrack $track, Playlist $pl) {}

}
