<?php

class DBConnect {
    static private string $db_host;
    static private string $db_user;
    static private string $db_pass;
    static private string $db_name;

    static public mysqli $conn;

    /**
     * @param array for database config
     * @return mysqli connection
     */
    public function __construct(Array $db) {
        self::$db_host = $db['host'];
        self::$db_user = $db['user'];
        self::$db_pass = $db['password'];
        self::$db_name = $db['name'];

        self::$conn = new mysqli(
            self::$db_host,
            self::$db_user,
            self::$db_pass,
            self::$db_name
        );

        $this->check_connection();
        return self::$conn;
    }

    public function check_connection() {
        if (self::$conn->connect_errno) {
            $message = "Database Connection Failed: ";
            $message .= self::$conn->connect_error;
            $message .= "[" . self::$conn->connect_errno . "];";
            exit($message);
        }
    }

    public function disconnect() {
        if (isset(self::$conn)) {
            self::$conn->close();
        }
    }
}