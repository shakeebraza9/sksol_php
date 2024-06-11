<?php
include_once("dbcon.php");
class dbFuncation {
    public $db;

    function __construct(){
        $this->db = Database::connectDB();
    }
    // Function to get all rows from a table
    public function getRow($tableName) {
        $rows = array();

        $sql = "SELECT * FROM $tableName";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }

        return $rows;
    }
    public function getRoww($tableName, $whereClause = "", $params = array()) {
        $rows = array();
    
        // Construct the base SQL query
        $sql = "SELECT * FROM $tableName";
        
        // Add the WHERE clause if provided
        if (!empty($whereClause)) {
            $sql .= " WHERE " . $whereClause;
        }
        // var_dump($sql);
    
        // Prepare the statement
        $stmt = $this->db->prepare($sql);
        
        // Check if the statement was prepared successfully
        if ($stmt === false) {
            // Log the error or handle it as necessary
            error_log('MySQL prepare error: ' . $this->db->error);
            return $rows; // Return an empty array or handle as needed
        }
    
        // Bind parameters if any
        if (!empty($params)) {
            // Determine the types dynamically
            $types = ''; 
            foreach ($params as $param) {
                $types .= is_int($param) ? 'i' : (is_double($param) ? 'd' : 's');
            }
            
            $stmt->bind_param($types, ...$params);
        }
    
        // Execute the statement
        if (!$stmt->execute()) {
            // Log the error or handle it as necessary
            error_log('MySQL execute error: ' . $stmt->error);
            $stmt->close();
            return $rows; // Return an empty array or handle as needed
        }
    
        // Get the result
        $result = $stmt->get_result();
        
        // Check if the result is valid
        if ($result === false) {
            // Log the error or handle it as necessary
            error_log('MySQL get_result error: ' . $stmt->error);
            $stmt->close();
            return $rows; // Return an empty array or handle as needed
        }
    
        // Fetch results
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
    
        // Close the statement
        $stmt->close();
    
        return $rows;
    }
    
    
    
    public function getRows($tableName, $whereClause = "") {
        $rows = array();

        $sql = "SELECT * FROM $tableName";

        // Add WHERE clause if provided
        if (!empty($whereClause)) {
            $sql .= " WHERE $whereClause";
        }
        // var_dump($sql);
        // exit();
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        if(isset($rows)){
            
            return $rows;
        }
        return 0;
    }

    function findValueByName($dataArray, $searchName) {
        foreach ($dataArray as $item) {
            if ($item['name'] === $searchName) {
                return $item['value'];
            }
        }
    
        // Return null if the name is not found
        return null;
    }
}
?>
