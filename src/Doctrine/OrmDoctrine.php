<?php
    namespace App\Doctrine;
    
    class OrmDoctrine {
        # Consultar la base de datos
        public function verify() {
            # SHOW DATABASES LIKE
        }

        # Borrar la base de datos
        public function drop() {
            # DROP DATABASE IF EXISTS
        }

        # Crear la base de datos
        public function create() {
            # CREATE DATABASE IF NOT EXISTS
        }

        # Eliminar y generar la base de datos
        public function design() {
            # DROP DATABASE IF EXISTS
            # CREATE DATABASE IF NOT EXISTS
        }
    }
