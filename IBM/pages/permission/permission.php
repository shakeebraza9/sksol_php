<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
if(isset($_POST['edit']) && isset($_POST['csrf_token'])){
    $submittedToken = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : null;
    if ($fun->verifyCsrfToken($submittedToken)) { 
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Process the form data
            $textValue = $_POST['text'];
            $id = $fun->customDecode($_POST['id'],"permission");
            $menuTypes = $_POST['menuType'];
        
            $array = json_decode($menuTypes, true);
        
        // Check if decoding was successful
        if (is_array($array)) {
            // Remove extra quotes and brackets from each element
            $cleanedValues = array_map(function($value) {
                return trim($value, '["]');
            }, $array);
        
            // Implode the cleaned values into a single string
            $resultString = implode(',', $cleanedValues);
        
        } else {
            // Handle the case where decoding failed
            echo "Failed to decode JSON string.";
        }
        
            $publish=1; 
    

                // Insert new record
                $sql = "UPDATE penel_premission SET penel_name = ?, value_name = ?, publish = ? WHERE id = ?";
                $stmt = $db->prepare($sql);

                if (!$stmt) {
                    die("Error preparing statement: " . $db->error);
                }
    
                $stmt->bind_param("sssi", $textValue, $resultString, $publish, $id);
            
                if ($stmt->execute()) {

                    // echo '<script>alert("Database: Record inserted successfully!"); window.history.back(); window.history.back(); window.location.href = "login.php";</script>';
                } else {
                    $response = "Database: Error updating record: " . $stmt->error;
                }

                $stmt->close();
        } else {

            echo "Invalid request.";
        }
    }else{
        return 0;
    }
}else{
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $textValue = $_POST['text'];
        $menuTypes = $_POST['menuTypes'];
        $submittedToken = isset($_POST['csrfToken']) ? $_POST['csrfToken'] : null;
        $array = json_decode($menuTypes, true);
        // var_dump($fun->verifyCsrfToken($submittedToken));
        if ($fun->verifyCsrfToken($submittedToken)) {


            if (is_array($array)) {
                // Remove extra quotes and brackets from each element
                $cleanedValues = array_map(function($value) {
                    return trim($value, '["]');
                }, $array);

                // Implode the cleaned values into a single string
                $resultString = implode(',', $cleanedValues);

            } else {
                // Handle the case where decoding failed
                echo "Failed to decode JSON string.";
            }

                $publish=1; 

                $sql = "INSERT INTO penel_premission (penel_name, value_name, publish) VALUES (?,?,?)";
                $stmt = $db->prepare($sql);


                if (!$stmt) {
                    die("Error preparing statement: " . $db->error);
                }


                $stmt->bind_param("sss", $textValue, $resultString, $publish);


                if ($stmt->execute()) {
                    $response = "Database: Form submitted successfully!";
                } else {
                    $response = "Database: Error inserting data into the database: " . $stmt->error;
                }


                $stmt->close();

            
                    $response .= "\nImage: No image file provided.";
                


                echo $response;
}else{
    return 0;
}
} else {

    echo "Invalid request.";
}
}
?>
