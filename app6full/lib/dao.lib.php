<?php
/**
 * Clase DAO
 */
class Dao {
    private $pdo;

    /**
     * Constructor
     * 
     * @param string ruta del fichero sqlite
     */
    function __construct($fichero) {
        if (file_exists($fichero)) {
            $this->connect($fichero);
        } else { 
            // Crear la base de datos
            $this->connect($fichero);
            $this->createSchema();
        }
    }

    /**
     * Getters
     */
    function getPdo() { return $this->pdo; }

    /**
     * Conexión a la base de datos
     * 
     * @param string ruta del fichero sqlite
     */
    private function connect($fichero) {
        try {
            $dsn = 'sqlite:'.$fichero;
            $this->pdo = new PDO($dsn);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            var_dump($e);
            exit;   // <============= 
        }
    }

    /**
     * Crea el esquema de tablas de la app
     * 
     * passwd
     * usuarios
     * deportes
     * usuarios_deportes (N:M)
     */
    private function createSchema() {
        // Tabla de administradores
        $sql = 'CREATE TABLE passwd (
            usuario TEXT PRIMARY KEY,
            clave TEXT NOT NULL
        )';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        // Un administrador inicial
        $sql = 'INSERT INTO passwd (usuario, clave)
                    VALUES ("usuario1", "clave1")';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        // Tabla de usuarios
        $sql = 'CREATE TABLE usuarios (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nombre TEXT NOT NULL UNIQUE,
                    nacido TEXT NOT NULL,
                    sexo TEXT NOT NULL,
                    foto TEXT
                )';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        // Tabla de deportes
        $sql = 'CREATE TABLE deportes (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nombre TEXT NOT NULL UNIQUE
                )';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        // Tabla de usuarios_deportes
        $sql = 'CREATE TABLE usuarios_deportes (
                    id_usuario INTEGER NOT NULL,
                    id_deporte INTEGER NOT NULL,
                    PRIMARY KEY (id_usuario, id_deporte),
                    FOREIGN KEY (id_usuario)
                        REFERENCES usuarios (id)
                            ON UPDATE CASCADE
                            ON DELETE CASCADE,
                    FOREIGN KEY (id_deporte)
                        REFERENCES deportes (id)
                            ON UPDATE RESTRICT
                            ON DELETE RESTRICT
        )';
         $stmt = $this->pdo->prepare($sql);
         $stmt->execute();
    }
}
