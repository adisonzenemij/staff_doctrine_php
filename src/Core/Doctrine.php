<?php
    namespace App\Core;

    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\Tools\Setup;
    use Doctrine\ORM\Tools\SchemaTool;

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

        public function manager(): EntityManager {
            # Ruta a las entidades en tu proyecto
            $paths = [
                ENT . '/application',
                ENT . '/technology',
            ];
            # Configurar el uso de anotaciones
            $config = Setup::createAnnotationMetadataConfiguration(
                $paths,
                $this->debug,
                null,
                null,
                false
            );
            # Crear la entidad gestionada o administrada
            $entityManager = EntityManager::create($this->params(), $config);

            # Activar el SQL Logger
            $entityManager->getConfiguration()->setSQLLogger(new \Doctrine\DBAL\Logging\EchoSQLLogger());

            # Depuración: Verificar las entidades cargadas
            $metadatas = $entityManager->getMetadataFactory()->getAllMetadata();
            if (empty($metadatas)) {
                echo "No entities found!";
            } else {
                echo "Entities loaded: " . count($metadatas);
            }

            # Crear las tablas (si no existen)
            $schemaTool = new SchemaTool($entityManager);
            try {
                $schemaTool->createSchema($metadatas);
                echo "Schema created successfully!";
            } catch (\Exception $e) {
                echo "Error creating schema: " . $e->getMessage();
            }
            # Retornar entidad gestionada
            return $entityManager;
        }

        # Configuración de la conexión
        private function params(): array {
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
