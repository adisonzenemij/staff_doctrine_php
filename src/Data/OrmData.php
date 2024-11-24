<?php
    namespace App\Data;

    use App\Data\ConfigData;
    use PDO;
    use PDOException;
    
    class OrmData {
        private $server;
        private $verify;

        private $chst;
        private $name;
        private $orm;

        public function __construct(ConfigData $configData) {
            $this->server = $configData->server();
            $this->verify  = $configData->verify();

            $this->chst = $_ENV['DB_CHARSET'];
            $this->name = $_ENV['DB_NAME'];
            $this->orm = $_ENV['DB_ORM'];
        }

        public function operation() {
            return [
                'none' => 'none',
                'drop' => 'drop',
                'create' => 'create',
                'design' => 'design',
            ];
        }

        # Ejecutar orm definido
        public function execute() {
            # Asignar operaciones para la base de datos
            $actions = $this->operation();
            # Verificar que la acción exista en el mapeo
            if (array_key_exists($this->orm, $actions)) {
                # Llamar al método correspondiente
                $this->{$actions[$this->orm]}();
            } else {
                echo "Invalid ORM: {$this->orm}" . "<br>";
            }
        }

        # Mensaje de informacion
        public function none() {
            echo "ORM not established" . "<br>";
        }

        # Borrar la base de datos
        public function drop() {
            if ($this->verify) {
                $action = "Dropping database '{$this->name}'";
                $stmt = "
                    DROP DATABASE
                    IF EXISTS `{$this->name}`
                ";
                $this->statement($stmt, $action);
            }
        }

        # Crear la base de datos
        public function create() {
            $action = "Creating database '{$this->name}'";
            $stmt = "
                CREATE DATABASE
                IF NOT EXISTS `{$this->name}`
                CHARACTER SET {$this->chst}
            ";
            $this->statement($stmt, $action);
        }

        # Eliminar y generar la base de datos
        public function design() {
            # DROP DATABASE IF EXISTS
            $this->drop();
            # CREATE DATABASE IF NOT EXISTS
            $this->create();
        }

        # Ejecutar una declaración SQL y manejar errores
        private function statement($stmt, $action) {
            echo $stmt . "<br>";
            try {
                $this->server->exec($stmt);
                echo "Success: {$action}" . "<br>";
            } catch (PDOException $e) {
                echo "Error: {$action}" . "<br>";
                echo "Error: " . $e->getMessage();
            }
        }
    }
?>
