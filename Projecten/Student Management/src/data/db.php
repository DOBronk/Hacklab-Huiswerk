<?php

// Example class used

class PdoService
{
    private $host = '127.0.0.1:3306';
    private $db = 'schoolmanager';

    private $pdo;

    private static $pdoService;

    /**
     * PdoService constructor.
     * 
     * Initializes a new instance of the PdoService class.
     */
    public function __construct()
    {
        $env = parse_ini_file('.env');

        $dsn = "mysql:host=$this->host;dbname=$this->db";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->pdo = new PDO($dsn, $env['dbuser'], $env['dbpass'], $options);
    }

    /**
     * Get the singleton instance of the PdoService class.
     * 
     * @return PdoService The singleton instance of the PdoService class.
     */
    public static function getInstance()
    {
        if (!isset(self::$pdoService)) {
            self::$pdoService = new PdoService();
        }
        return self::$pdoService;
    }

    /**
     * Insert a new record into the database.
     * 
     * @param string $sql The SQL query to execute.
     * @param array $values The values to bind to the query.
     * @return int The ID of the last inserted record.
     */
    public function insert(string $sql, array $values): int
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);
        return $this->pdo->lastInsertId();
    }

    /**
     * Fetch a single record from the database.
     * 
     * @param int $id The ID of the record to fetch.
     * @param string $table The name of the table to fetch from.
     * @return array The fetched record as an associative array.
     */
    public function fetch(string $table): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Fetch all records from a table in the database.
     * 
     * @param string $table The name of the table to fetch from.
     * @return array An array of fetched records as associative arrays.
     */
    public function fetchAll(string $table): array
    {
        $stmt = $this->pdo->query("SELECT * FROM $table");
        return $stmt->fetchAll();
    }

}