<?php
    namespace App\Core;

    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\ORMSetup;
    use Doctrine\DBAL\Logging\EchoSQLLogger;

    class Doctrine {
        private $debug;

        private $chst;
        private $drvr;
        private $host;
        private $name;
        private $pass;
        private $port;
        private $user;

        public function __construct() {
            $this->debug = $_ENV['DEBUG'];

            $this->chst = $_ENV['DB_CHST'];
            $this->drvr = $_ENV['DB_DRVR'];
            $this->host = $_ENV['DB_HOST'];
            $this->name = $_ENV['DB_NAME'];
            $this->pass = $_ENV['DB_PASS'];
            $this->port = $_ENV['DB_PORT'];
            $this->user = $_ENV['DB_USER'];
        }

        public function manager() {

           // Crear configuración para Doctrine ORM
            $config = ORMSetup::createAttributeMetadataConfiguration(
                paths: [ENT . '/application', ENT . '/technology'],
                isDevMode: $this->debug
            );

            // Configuración de conexión
            $connectionParams = [
                'dbname'   => $this->name,
                'user'     => $this->user,
                'password' => $this->pass,
                'host'     => $this->host,
                'driver'   => 'pdo_mysql',
                'charset'  => $this->chst,
            ];

            // Crear el EntityManager
            $entityManager = EntityManager::create($connectionParams, $config);

            // Configurar SQL Logger
            $entityManager->getConnection()
                ->getConfiguration()
                ->setSQLLogger(new EchoSQLLogger());

            // Retornar EntityManager
            return $entityManager;
        }

        # Configuración de la conexión
        private function params() {
            return [
                'driver'   => 'pdo_mysql',
                'host'     => $this->host,
                'dbname'   => $this->name,
                'user'     => $this->user,
                'password' => $this->pass,
                'charset'  => $this->chst,
                'options'  => [
                    \PDO::MYSQL_ATTR_INIT_COMMAND =>
                        "SET NAMES '" . $this->chst . "'"
                ]
            ];
        }
    }
