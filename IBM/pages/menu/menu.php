<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
if(isset($_POST['edit'])){
    if($_POST['token'] === $_SESSION["csrfToken"]){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Process the form data
            $link = $_POST['link'];
            $text = $_POST['text'];
            $type = 'Menu'; // Create a variable to hold the value
            $imgname = ''; // Initialize the variable for the image name
            $id = $fun->customDecode($_POST['id'],"menu");
        
            // Check if an image file is provided
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $targetDir = $webUrl2."/uploades/menu/"; // Use absolute path
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
                $sql = "UPDATE menu SET link = ?, menu_name = ?, type = ?, img = ? WHERE id = ?";
                $stmt = $db->prepare($sql);
        
                // Check for a valid database connection
                if (!$stmt) {
                    die("Error preparing statement: " . $db->error);
                }
        
                // Bind parameters
                $stmt->bind_param("ssssi", $link, $text, $type, $imgname, $id);
        
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
                $sql = "UPDATE menu SET link = ?, menu_name = ?, type = ? WHERE id = ?";
                $stmt = $db->prepare($sql);
                
                // Check for a valid database connection
                if (!$stmt) {
                    die("Error preparing statement: " . $db->error);
                }
        
                // Bind parameters
                $stmt->bind_param("sssi", $link, $text, $type, $id);
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
            $link = $_POST['link'];
            $text = $_POST['text'];
            $menuType = isset($_POST['menuType']) ? $_POST['menuType'] : 1;
            $pub = 1;
            $type = 'Menu'; // Create a variable to hold the value


            // Handle image file
            if (isset($_FILES['image'])) {
                $targetDir = $webUrl2."/uploades/menu/"; // Use absolute path
                $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                $imgname=$_FILES["image"]["name"];
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    // File uploaded successfully
                        // Database insertion
            $sql = "INSERT INTO menu (link, menu_name, type,img,under,publish) VALUES (?, ?, ? , ?,?,?)";
            $stmt = $db->prepare($sql);

            // Check for a valid database connection
            if (!$stmt) {
                die("Error preparing statement: " . $db->error);
            }

            // Bind parameters, passing $type by reference
            $stmt->bind_param("ssssss", $link, $text, $type,$imgname,$menuType,$pub);

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
            $sql = "INSERT INTO menu (link, menu_name, type,under,publish) VALUES (?, ?, ?,?,?)";
            $stmt = $db->prepare($sql);

            // Check for a valid database connection
            if (!$stmt) {
                die("Error preparing statement: " . $db->error);
            }

            // Bind parameters, passing $type by reference
            $stmt->bind_param("sssss", $link, $text, $type,$menuType,$pub);

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
