<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
if(isset($_POST['edit'])){
    if($_POST['token'] === $_SESSION["csrfToken"]){ 
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $text = $_POST['text'];
    
            $imgname = ''; 
            $id = $fun->customDecode($_POST['id'],"gallery");
        
            // Check if an image file is provided
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $targetDir = $webUrl2."/uploades/gallery/";
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
                $sql = "UPDATE gallery SET title = ?, img = ? WHERE id = ?";
                $stmt = $db->prepare($sql);
        
                // Check for a valid database connection
                if (!$stmt) {
                    die("Error preparing statement: " . $db->error);
                }
        
                // Bind parameters
                $stmt->bind_param("ssi", $text, $imgname, $id);
        
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
                $sql = "UPDATE gallery SET title = ? WHERE id = ?";
                $stmt = $db->prepare($sql);
                
                // Check for a valid database connection
                if (!$stmt) {
                    die("Error preparing statement: " . $db->error);
                }
        
                // Bind parameters
                $stmt->bind_param("si", $text, $id);
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
}
else{
    // var_dump($_SESSION["csrfToken"]);
    // var_dump($_POST['token']);
    if($_POST['token'] === $_SESSION["csrfToken"]){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Process the form data
            $text = $_POST['text'];
            $status = 1; // Create a variable to hold the value


            if (isset($_FILES['image']['name'])) {


                $targetDir = $webUrl2."/uploades/gallery/"; // Use absolute path
                $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                $imgname=$_FILES["image"]["name"];
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    // File uploaded successfully
                        // Database insertion
            $sql = "INSERT INTO gallery (title, img, img_url,status) VALUES (?, ?, ? , ?)";
            $stmt = $db->prepare($sql);

            // Check for a valid database connection
            if (!$stmt) {
                die("Error preparing statement: " . $db->error);
            }
            
            // Bind parameters, passing $type by reference
            $stmt->bind_param("ssss", $text, $imgname, $targetDir,$status);

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
            $sql = "INSERT INTO gallery (title,status) VALUES (? , ?)";
            $stmt = $db->prepare($sql);

            // Check for a valid database connection
            if (!$stmt) {
                die("Error preparing statement: " . $db->error);
            }
            // Bind parameters, passing $type by reference
            $stmt->bind_param("ss", $text,$status);

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
