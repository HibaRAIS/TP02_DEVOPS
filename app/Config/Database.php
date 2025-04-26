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

        // Configuration pour la base de données par défaut (développement)
        $this->default = [
            'DSN'          => '',
            'hostname'     => env('database.default.hostname', '127.0.0.1'),
            'username'     => env('database.default.username', 'root'),
            'password'     => env('database.default.password', ''),
            'database'     => env('database.default.database', 'TP02_DEVOPS'),
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
            'port'         => (int) env('database.default.port', 3306),
            'numberNative' => false,
            'foundRows'    => false,
            'dateFormat'   => [
                'date'     => 'Y-m-d',
                'datetime' => 'Y-m-d H:i:s',
                'time'     => 'H:i:s',
            ],
        ];

        // Configuration pour les tests
        $this->tests = [
            'DSN'          => '',
            'hostname'     => env('DB_HOST', env('database.default.hostname', '127.0.0.1')),
            'username'     => env('DB_USER', env('database.default.username', 'root')),
            'password'     => env('DB_PASSWORD', env('database.default.password', '')),
            'database'     => env('DB_NAME', env('database.default.database', 'TP02_DEVOPS')),
            'DBDriver'     => 'MySQLi',
            'DBPrefix'     => 'test_',
            'pConnect'     => false,
            'DBDebug'      => true,
            'charset'      => 'utf8mb4',
            'DBCollat'     => 'utf8mb4_general_ci',
            'swapPre'      => '',
            'encrypt'      => false,
            'compress'     => false,
            'strictOn'     => false,
            'failover'     => [],
            'port'         => (int) env('DB_PORT', env('database.default.port', 3306)),
            'foreignKeys'  => true,
            'dateFormat'   => [
                'date'     => 'Y-m-d',
                'datetime' => 'Y-m-d H:i:s',
                'time'     => 'H:i:s',
            ],
        ];

        // Priorité aux variables d'environnement de test si définies
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
            
            // Surcharge pour GitHub Actions
            if (getenv('GITHUB_ACTIONS') === 'true') {
                $this->tests['password'] = 'root';
            }
        }
    }
}