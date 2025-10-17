<?php

namespace iutnc\deefy\repository;

class DeefyRepository {

    private \PDO $pdo;
    private static ?DeefyRepository $instance = null;
    private static array $config = [ ];

    private function __construct(array $conf) {
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
        self::$config = [ 'dsn'=> $conf['driver'] . ":" . $conf['host'] . ";dbname=" . $conf['database'],'user'=> $conf['username'],'pass'=> $conf['password'] ];
    }

    public function findPlaylistById(int $id): Playlist {
                return $this->pdo->prepare("SELECT * FROM `playlist` WHERE id=$id")->execute();
    }

    public function getAllPlaylists() {
        return $this->pdo->prepare("SELECT * FROM `playlist` ")->execute();
    }

    public function saveEmptyPlaylist(Playlist $pl): Playlist {}

    public function saveTrack(AudioTrack $track) {}

    public function addTrackToPlaylist(AudioTrack $track, Playlist $pl) {}

}
