<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
if(isset($_POST['edit'])){
    if($_POST['token'] === $_SESSION["csrfToken"]){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $text = serialize($_POST['text']);
            $deatils= serialize($_POST['deatils']);
            $date = $_POST['date'];
            $imgname = ''; // Initialize the variable for the image name
            $id = $fun->customDecode($_POST['id'],"blog");
        
            // Check if an image file is provided
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $targetDir = $webUrl2."/uploades/blog/";
                $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                $imgname = serialize($_FILES["image"]["name"]);
        
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
                $sql = "UPDATE blog SET title = ?,description =?, date=? , image = ? WHERE id = ?";
                $stmt = $db->prepare($sql);
        
                // Check for a valid database connection
                if (!$stmt) {
                    die("Error preparing statement: " . $db->error);
                }
        
                // Bind parameters
                $stmt->bind_param("ssssi", $text,$deatils,$date, $imgname, $id);
        
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
                $sql = "UPDATE blog SET title = ?,description =?, date=?  WHERE id = ?";
                $stmt = $db->prepare($sql);
                
                // Check for a valid database connection
                if (!$stmt) {
                    die("Error preparing statement: " . $db->error);
                }
        
                // Bind parameters
                $stmt->bind_param("sssi", $text,$deatils,$date, $id);
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
    if($_POST['token'] === $_SESSION["csrfToken"]){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Process the form data
        
            $text = serialize($_POST['text']);
            $deatils= serialize($_POST['deatils']);
            $date = $_POST['date'];
            $status = 1; 


            if (isset($_FILES['image']['name'])) {


                $targetDir = $webUrl2."/uploades/blog/"; // Use absolute path
                $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                $imgname=serialize($_FILES["image"]["name"]);
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    // File uploaded successfully
                        // Database insertion
            $sql = "INSERT INTO blog (title, description, image,date,publish) VALUES (?, ?, ? , ?,?)";
            $stmt = $db->prepare($sql);

            // Check for a valid database connection
            if (!$stmt) {
                die("Error preparing statement: " . $db->error);
            }
            
            // Bind parameters, passing $type by reference
            $stmt->bind_param("sssss", $text,$deatils,$imgname,$date,$status);

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
            $sql = "INSERT INTO blog (title, description,date,publish) VALUES (?, ?, ?,?)";
            $stmt = $db->prepare($sql);

            // Check for a valid database connection
            if (!$stmt) {
                die("Error preparing statement: " . $db->error);
            }
            // Bind parameters, passing $type by reference
            $stmt->bind_param("sssss", $text,$deatils,$date,$status);

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
