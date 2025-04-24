<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public string $defaultGroup = 'default';
    public array $default;
    public array $tests;

    public function __construct()
    {
        parent::__construct();

        // Configuration pour la base de données par défaut
        $this->default = [
            'DSN'          => '',
            'hostname'     => env('DB_HOST', 'localhost'),
            'username'     => env('DB_USER', 'root'),
            'password'     => env('DB_PASSWORD', ''),
            'database'     => env('DB_NAME', 'TP02_DEVOPS'),
            'DBDriver'     => 'MySQLi',
            'DBPrefix'     => '',
            'pConnect'     => false,
            'DBDebug'      => (ENVIRONMENT !== 'production'),
            'charset'      => 'utf8mb4',
            'DBCollat'     => 'utf8mb4_general_ci',
            'swapPre'      => '',
            'encrypt'      => false,
            'compress'     => false,
            'strictOn'     => false,
            'failover'     => [],
            'port'         => env('DB_PORT', 3306),
            'numberNative' => false,
            'foundRows'    => false,
            'dateFormat'   => [
                'date'     => 'Y-m-d',
                'datetime' => 'Y-m-d H:i:s',
                'time'     => 'H:i:s',
            ],
        ];

        // Configuration pour la base de données lors des tests
        $this->tests = [
            'DSN'          => '',
            'hostname'     => env('DB_HOST', '127.0.0.1'),
            'username'     => env('DB_USER', 'root'),
            'password'     => env('DB_PASSWORD', ''),
            'database'     => env('DB_NAME', 'TP02_DEVOPS'),
            'DBDriver'     => 'MySQLi',
            'DBPrefix'     => 'test_',
            'pConnect'     => false,
            'DBDebug'      => true,  // Définir à true pour afficher les erreurs en test
            'charset'      => 'utf8mb4',
            'DBCollat'     => 'utf8mb4_general_ci',
            'swapPre'      => '',
            'encrypt'      => false,
            'compress'     => false,
            'strictOn'     => false,
            'failover'     => [],
            'port'         => env('DB_PORT', 3306),
            'foreignKeys'  => true,  // Assurer la prise en charge des clés étrangères en test
            'dateFormat'   => [
                'date'     => 'Y-m-d',
                'datetime' => 'Y-m-d H:i:s',
                'time'     => 'H:i:s',
            ],
        ];

        // Si l'environnement est 'testing', on passe à la configuration 'tests'
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
