<?php

include_once("global.php");

class chkLenienceWeb{
    public $db;
    public $dbf;
    public $fun;

    function __construct(){
        $this->db = Database::connectDB();
        $this->fun = new Funcation();
        $this->dbf = new dbFuncation();
    }

    public function validUser($username="", $passwordd=""){
       
        if(!empty($username) && !empty($passwordd)){
            $hashedPass = md5($passwordd);
            $password = md5($hashedPass);

            // Establish a database connection using the static method
            // $db = Database::connectDB(); // Adjust this based on your actual connection method

            // Use prepared statements to protect against SQL injection
            $query = "SELECT * FROM users WHERE username = ? AND password = ?";

            // Use $this->db instead of $db to reference the class property
            $stmt = $this->db->prepare($query);

            if ($stmt) {
                // Bind parameters
                $stmt->bind_param("ss", $username, $password); // Assuming both are strings

                // Execute the statement
                if ($stmt->execute()) {
                    // Get the result
                    $result = $stmt->get_result();

                    // Check if there is a matching user
                    if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();

                        // Verify the password
                        if ($password == $row['password']) {
                            // Authentication successful
                            $csrfToken=$this->fun->getCsrfToken();

                            $user_id = $row['id'];
                            $_SESSION["username"] = $username;
                            $_SESSION["csrfToken"]=$csrfToken;
                            $_SESSION["userStatus"] = $row['status'];
                            $_SESSION["userStatus"] = $row['status'];
                            $_SESSION["premissionEnyId"] = $row['permission_type'];
                            $_SESSION["premissionId"] = $row['per_id'];
                            $_SESSION['user_id'] = $user_id;
                            $_SESSION["age"] = 18;
                            return 1;
                        } else {
                            // Incorrect password
                            $error_message = "Invalid password.";
                        }
                    } else {
                        // User not found
                        $error_message = "User not found.";
                    }

                    // Close the result set
                    $result->close();
                } else {
                    // Handle the error if execution fails
                    die("Error executing statement: " . $stmt->error);
                }

                // Close the statement
                $stmt->close();
            } else {
                // Handle the error if preparing the statement fails
                die("Error preparing statement: " . $this->db->error);
            }
        } else {
            $error_message = "empty Email or password.";
        }
        return $error_message;
    }
    function isLoggedIn() {
        session_start();
        if(isset($_SESSION['user_id'])){
            return 1;
        }else{
            return 0;
        }
        
    }
    public function menuPermission() {
        $id=$_SESSION["premissionEnyId"];
        $stringId=$this->fun->customDecode($id,"permission");
        $mId = intval($stringId);
        if(isset($mId) && !empty($mId)){
            $DataReturn=$this->fun->menuDatafinder($mId);  
            $arrayValues = explode(',', $DataReturn);
            $associativeArray = array();
            foreach ($arrayValues as $value) {
                $associativeArray[$value] = $value;
            }
            return $associativeArray;
            
        }
        
    }
    public function pagesPermissionChk($type) {
        if ($_SESSION["userStatus"] != 1){
        $menuchk=$this->menuPermission();
        if(isset($menuchk[$type])){
            return 1;
            
        }else{
            return 0;
            
        }
        }else{
            return 1;
        }
    }
    public function urlSecurity() {
        $url = $_SERVER['REQUEST_URI'];
                    // Find the position of "/ibm/pages/" in the URL
            $position = strpos($url, "/ibm/pages/");

            if ($position !== false) {
                // Extract the part of the URL that comes after "/ibm/pages/"
                $extractedPath = substr($url, $position + strlen("/ibm/"));

                // Find the next "/" in the extracted path
                $nextSlashPosition = strpos($extractedPath, '/');

                if ($nextSlashPosition !== false) {
                    // Extract the part of the path up to the next "/"
                    $finalResult = substr($extractedPath, 0, $nextSlashPosition);

                    if($finalResult == "pages"){
                        return 1;
                    }
                } else {
                    echo "No additional pages found in the URL";
                }
            } else {
                echo "The URL does not contain '/ibm/pages/'";
            }

    }
    public function setTimeoutSession($timeuser) {

    
        $nowTime = time();

    
        $sessionTimeout = 60; // Set your session timeout in seconds
    
        if (time() - $timeuser > $sessionTimeout) {
  
        } else {
   
        }
    }
    public function cookieSetorset() {
        if (isset($_COOKIE['login_attempts_exceeded'])) {
            return 1;
        } 
    }
    public function projectCHk($key){
        $result=$this->fun->checkproductapi($key);
        if($result == 1){
            return $result;
        }
    }
    public function apiKeyProject(){
     $key=1;
     $result =$this->projectCHk($key);
     if($result == 1){
        return $result;
    }else{
        return 0;
        
    }
    }
    function start_session_with_timeout($timeout_minutes = 30) {
        // Check if a session is active
        if (session_status() == PHP_SESSION_NONE) {
            // Set session timeout to specified minutes (in seconds)
            $sessionTimeout = $timeout_minutes * 60;
    
            // Set session cookie parameters
            session_set_cookie_params($sessionTimeout);
    
            // Set the maximum session lifetime
            ini_set('session.gc_maxlifetime', $sessionTimeout);
    
            // Start the session
            session_start();
    
            // Regenerate the session ID to help prevent session fixation attacks
            session_regenerate_id(true);
        }
    }

    function badmabanoga($timeout_minutes = 30) {

    }

}


?>