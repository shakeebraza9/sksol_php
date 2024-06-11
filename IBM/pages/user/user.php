<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}

if(isset($_POST['edit'])){
  
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // var_dump($_POST);
        // exit();
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $count = $_POST['count'];
        $address = $_POST['address'];
        $pass = $_POST['pass'];
        $repass = $_POST['repass'];
        $status=0;

      

    

    
        // Check if an ID is provided for update
        if (!empty($pass) && !empty($repass)) {
            
            $hashedPass = md5($pass);
            $hashedRepass = md5($repass);
            $PassDe = md5($hashedPass);
            $RepassDe = md5($hashedRepass);
            
            
            $id = base64_decode($_POST['id']);
     
            // Update existing record
            $sql = "UPDATE users SET username = ?, password = ?, email = ?, phone = ?, gender=?, city=?, country=?, address=? WHERE id = ?";
            $stmt = $db->prepare($sql);
            
            // Check for a valid database connection
            if (!$stmt) {
                die("Error preparing statement: " . $db->error);
            }
            
            // Bind parameters
            $stmt->bind_param("ssssssssi", $name, $PassDe, $email, $phone, $gender, $city, $country, $address, $id);
            
    
            // Execute the statement
            if ($stmt->execute()) {
                // $response = "Database: Record updated successfully!";
                echo '<script>alert("Database: Shakeeb Record inserted successfully!"); window.history.back(); window.history.back(); window.location.href = "login.php";</script>';
            } else {
                $response = "Database: Error updating record: " . $stmt->error;
            }
    
            // Close the statement
            $stmt->close();
        } 
    
        // Send the response back to the client
        echo $response;
    } else {
        // Invalid request method
        echo "Invalid request.";
    }
    
}


else{
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process the form data
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $permissionType = $_POST['permissionType'];
    $preId=$fun->customDecode($permissionType,"permission");
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $count = $_POST['count'];
    $address = $_POST['address'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];
    $hashedPass = md5($pass);
    $hashedRepass = md5($repass);
    $status=0;
    $PassDe = md5($hashedPass);
    $RepassDe = md5($hashedRepass);
 

  
// Assuming chkusername is a static method in Funcation


    
    if($PassDe == $RepassDe){



    $sql = "INSERT INTO users (username ,password,email,phone,gender,city,country,address,status,permission_type,per_id) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $db->prepare($sql);

    // Check for a valid database connection
    if (!$stmt) {
        die("Error preparing statement: " . $db->error);
    }
  
   
    // Bind parameters, passing $type by reference
    $stmt->bind_param("sssssssssss",$name, $PassDe, $email, $phone,$gender,$city,$count,$address,$status,$permissionType,$preId);

    // Execute the statement
    if ($stmt->execute()) {
        $response = "Database: Form submitted successfully!";
    } else {
        $response = "Database: Error inserting data into the database: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    
    }
}
    // Send the response back to the client
    // echo $response;

} 
?>
