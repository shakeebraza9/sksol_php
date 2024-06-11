<?php
// db.php

class Database {
    public static function connectDB() {
        $dbHost = "localhost";
        $dbUser = "root";
        $dbPassword = "";
        $dbName = "usersdb";

        $db = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        return $db;
    }
}


// class YourDatabaseClass {
//     private $db;

//     // Constructor to initialize the database connection
//     public function __construct() {
//         // Replace these with your actual database credentials
//         $dbHost = "localhost";
//         $dbUser = "your_username";
//         $dbPassword = "your_password";
//         $dbName = "your_database";

//         // Create a new PDO connection
//         $this->db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
//         $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     }

//     // Function to check if a transaction is in progress
//     public function isTransactionInProgress() {
//         return $this->db->inTransaction();
//     }

//     // ... other database-related functions ...
// }

?>
