<?php
    namespace App\Library;

    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\ORMSetup;
    use Doctrine\DBAL\Logging\EchoSQLLogger;

    class Doctrine {
        private $debug;

        private $chst;
        private $cnnt;
        private $drvr;
        private $host;
        private $name;
        private $pass;
        private $port;
        private $user;

        public function __construct() {
            $this->debug = $_ENV['APP_DEBUG'];

            $this->chst = $_ENV['DB_CHARSET'];
            $this->cnnt = $_ENV['DB_CONNECT'];
            $this->drvr = $_ENV['DB_DRIVER'];
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
            $params = $this->params();

            // Crear el EntityManager
            $entityManager = EntityManager::create($params, $config);

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
                'driver'   => $this->drvr,
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
?>
