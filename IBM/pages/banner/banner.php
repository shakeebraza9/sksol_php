<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
if(isset($_POST['edit'])){
    if($_POST['token2'] === $_SESSION["csrfToken"]){
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Process the form data
        $title = $_POST['title'];
        $text = $_POST['text'];
        $com = $_POST['comment'];
        $status = 1; 
        $imgname = ''; 
        $id = $fun->customDecode($_POST['id'],"banner");
    
        // Check if an image file is provided
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $targetDir = $webUrl2."/uploades/banner/"; // Use absolute path
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $imgname = $_FILES["image"]["name"];
     
            
    
            // Move the uploaded file
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                // Error uploading file
                echo "Error uploading image file.";
                exit();
            }
        }
    
        // Check if an ID is provided for update
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
     
            // Update existing record
            $sql = "UPDATE banner SET title = ?, deatils = ?, text2 = ?, img = ?,publish=? WHERE id = ?";
            $stmt = $db->prepare($sql);
    
            // Check for a valid database connection
            if (!$stmt) {
                die("Error preparing statement: " . $db->error);
            }
    
            // Bind parameters
            $stmt->bind_param("sssssi", $title, $com, $text, $imgname,$status, $id);
    
            // Execute the statement
            if ($stmt->execute()) {
                $response = "Database: Record updated successfully!";
                
                echo '<script>alert("Database: Record inserted successfully!"); window.history.back(); window.history.back(); window.location.href = "login.php";</script>';
            } else {
                $response = "Database: Error updating record: " . $stmt->error;
            }
    
            // Close the statement
            $stmt->close();
        } else {
            
            // Insert new record
            $sql = "UPDATE banner SET title = ?, deatils = ?, text2 = ?,publish=? WHERE id = ?";
            $stmt = $db->prepare($sql);
            
            // Check for a valid database connection
            if (!$stmt) {
                die("Error preparing statement: " . $db->error);
            }
    
            // Bind parameters
            $stmt->bind_param("ssssi", $title,  $com, $text,$status, $id);
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
}else{
    return 0;
}
}else{
    if($_POST['token'] === $_SESSION["csrfToken"]){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process the form data
    $title = $_POST['title'];
    $text = $_POST['text'];
    $com = $_POST['comment'];
    $type = 'Menu'; // Create a variable to hold the value
    $status = 1; // Create a variable to hold the value


    // Handle image file
    if (isset($_FILES['image'])) {
        $targetDir = $webUrl2."/uploades/banner/"; // Use absolute path
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imgname=$_FILES["image"]["name"];
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // File uploaded successfully
                // Database insertion
    $sql = "INSERT INTO banner (title,text2,deatils,img,publish) VALUES (?, ?, ? , ?,?)";
    $stmt = $db->prepare($sql);

    // Check for a valid database connection
    if (!$stmt) {
        die("Error preparing statement: " . $db->error);
    }

    // Bind parameters, passing $type by reference
    $stmt->bind_param("sssss", $title, $text, $com,$imgname,$status);

    // Execute the statement
    if ($stmt->execute()) {
        $response = "Database: Form submitted successfully!";
    } else {
        $response = "Database: Error inserting data into the database: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();

            $response .= "\nImage: File uploaded successfully!";
        } else {
            // Error uploading file
            $response .= "\nImage: Error uploading file.";
        }
    } else {
            // Database insertion
    $sql = "INSERT INTO banner (title,text2,deatils,publish) VALUES (?, ?, ?,?)";
    $stmt = $db->prepare($sql);

    // Check for a valid database connection
    if (!$stmt) {
        die("Error preparing statement: " . $db->error);
    }

    // Bind parameters, passing $type by reference
    $stmt->bind_param("ssss", $title, $text, $com,$status);

    // Execute the statement
    if ($stmt->execute()) {
        $response = "Database: Form submitted successfully!";
    } else {
        $response = "Database: Error inserting data into the database: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();

        // No image file provided
        $response .= "\nImage: No image file provided.";
    }

    // Send the response back to the client
    echo $response;
} else {
    // Invalid request method
    echo "Invalid request.";
}
    }else{
        return 0;
    }
}
?>
