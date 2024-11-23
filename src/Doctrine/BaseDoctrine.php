<?php
    namespace App\Doctrine;

    use PDO;
    use PDOException;
    
    class BaseDoctrine {
        private $pdo;
        private $dsn;

        private $chst;
        private $drvr;
        private $host;
        private $name;
        private $pass;
        private $port;
        private $user;

        public function __construct() {
            $this->chst = $_ENV['DB_CHST'];
            $this->drvr = $_ENV['DB_DRVR'];
            $this->host = $_ENV['DB_HOST'];
            $this->name = $_ENV['DB_NAME'];
            $this->pass = $_ENV['DB_PASS'];
            $this->port = $_ENV['DB_PORT'];
            $this->user = $_ENV['DB_USER'];
        }

        # Generar data source name
        private function source($base) {
            $data = "{$this->drvr}:";
            $data .= "host={$this->host};";
            $data .= "port={$this->port};";
            $data .= $base ? "dbname={$this->name};" : "";
            $data .= "charset={$this->chst};";
            return $data;
        }

        # Construir conexión de la BD
        public function server() {
            $this->dsn = $this->source(false);
            try {
                $this->pdo = new PDO($this->dsn, $this->user, $this->pass);
                $this->pdo->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
                echo "Server Successful" . "</br>";
                return $this->pdo;
            } catch (PDOException $e) {
                echo "Server Falied" . "</br>";
                die("Error:" . " " . $e->getMessage());
                return null;
            }
        }

        # Construir conexión de la BD
        public function connect() {
            $this->dsn = $this->source(true);
            try {
                $this->pdo = new PDO($this->dsn, $this->user, $this->pass);
                $this->pdo->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
                echo "Connection Successful" . "</br>";
                return $this->pdo;
            } catch (PDOException $e) {
                echo "Connection Falied" . "</br>";
                die("Error:" . " " . $e->getMessage());
                return null;
            }
        }
        
        # Consultar la base de datos
        public function verify() {
            # Usamr un marcador de parámetro para el nombre de la base
            $stmt = $this->pdo->prepare("SHOW DATABASES LIKE :dbname");
            # Pasar el valor del nombre al marcador de parámetro
            $stmt->execute([':dbname' => $this->name]);
            return $stmt->fetch() ? true : false;
        }

        # Consultar tablas de la BD
        public function table() {
            try {
                $stmt = $this->pdo->query("SHOW TABLES");
                return $stmt->fetchAll(PDO::FETCH_COLUMN);
            } catch (PDOException $e) {
                echo "Not found tables" . "</br>";
                echo "Message: " . $e->getMessage();
                return [];
            }
        }
    }
