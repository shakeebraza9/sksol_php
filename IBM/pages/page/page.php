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
            $pagetext = htmlentities($_POST['pagetext']);
            $type = 'page'; // Create a variable to hold the value
            $sta = 1; // Create a variable to hold the value
            $imgname = ''; // Initialize the variable for the image name

        
            
                $id = $fun->customDecode($_POST['id'],"page");
                // Insert new record
                $sql = "UPDATE pages SET title = ?, slug = ?, dsc = ?,status=? WHERE pg_id  = ?";
                $stmt = $db->prepare($sql);

                if (!$stmt) {
                    die("Error preparing statement: " . $db->error);
                }
    
                $stmt->bind_param("ssssi", $text, $link, $pagetext,$sta, $id);
    
                if ($stmt->execute()) {

                    echo '<script>alert("Database: Record inserted successfully!"); window.history.back(); window.history.back(); window.location.href = "login.php";</script>';
                } else {
                    $response = "Database: Error updating record: " . $stmt->error;
                }
        
                // Close the statement
                $stmt->close();

        
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
            $pgtext = $_POST['pagetext'];
            $pagetext=htmlentities($pgtext);
            $page = $_POST['page'];
            $sta=1;

                    // Database insertion
            $sql = "INSERT INTO pages (title,slug,dsc,status) VALUES (?,?, ?, ?)";
            $stmt = $db->prepare($sql);

            // Check for a valid database connection
            if (!$stmt) {
                die("Error preparing statement: " . $db->error);
            }

            // Bind parameters, passing $type by reference
            $stmt->bind_param("ssss", $link, $text, $pagetext,$sta);

            // Execute the statement
            if ($stmt->execute()) {
                $response = "Database: Form submitted successfully!";
            } else {
                $response = "Database: Error inserting data into the database: " . $stmt->error;
            }

            $stmt->close();

            echo $response;
        } else {

            echo "Invalid request.";
        }
    }else{
        return 0;
    }
}
?>
