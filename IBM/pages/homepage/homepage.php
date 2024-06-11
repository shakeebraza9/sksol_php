<?php
include('../../global.php');


if(isset($_POST['edit'])){
  
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $title = serialize($_POST['heading']);
        $sub_heading = serialize($_POST['sub_heading']);
        $linktext = serialize($_POST['linktext']);
        $link = serialize($_POST['link']);
        $Details = serialize($_POST['Details']);
        $id = base64_decode($_POST['id']);
        $imgname = ''; // Initialize the variable for the image name
    
        // Check if an image file is provided
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $targetDir = "C:/xampp/htdocs/Ibmspro/IBM/uploades/homepage/"; // Use absolute path
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $imgname = $_FILES["image"]["name"];
            $img=serialize($imgname);
            // Move the uploaded file
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                // Error uploading file
                echo "Error uploading image file.";
                exit();
            }
        }
    
        // Check if an ID is provided for update
        
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            // var_dump($img);
            // exit();
            // Update existing record
            $sql = "UPDATE box SET heading = ?, sub_heading = ?, short_desc = ?, linktext = ?,redirect=?,`image` = ? WHERE id = ?";

            $stmt = $db->prepare($sql);
    
            // Check for a valid database connection
            if (!$stmt) {
                die("Error preparing statement: " . $db->error);
            }
            // Bind parameters
            $stmt->bind_param("ssssssi", $title, $sub_heading, $Details, $linktext, $link, $imgname, $id);

    
            // Execute the statement
            if ($stmt->execute()) {
                // $response = "Database: Record updated successfully!";
                echo '<script>alert("Database: Record inserted successfully!"); window.history.back(); window.history.back(); window.location.href = "login.php";</script>';
            } else {
                $response = "Database: Error updating record: " . $stmt->error;
            }
    
            // Close the statement
            $stmt->close();
        } else {
            // Insert new record
            $sql = "UPDATE box SET heading = ?, sub_heading = ?, short_desc = ?, linktext = ?,redirect=? WHERE id = ?";
            $stmt = $db->prepare($sql);
            
            // Check for a valid database connection
            if (!$stmt) {
                die("Error preparing statement: " . $db->error);
            }
    
            // Bind parameters
            $stmt->bind_param("sssssi", $title, $sub_heading, $Details, $linktext,$link, $id);
            // var_dump($stmt);
            // var_dump($_POST);
            // exit();
            // Execute the statement
            if ($stmt->execute()) {
                // $response = "Database: Record updated successfully!";
                echo '<script>alert("Database: Record inserted successfully!"); window.history.back(); window.history.back(); window.location.href = "login.php";</script>';
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
?>
