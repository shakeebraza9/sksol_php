<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
if($_POST['csrfToken'] === $_SESSION["csrfToken"]){
if(isset($_POST['tokken'])){
    foreach ($_POST as $key => $value) {
        $status=1;
        // Ensure key and value are not empty (you may need additional validation)
        if (!empty($key) && !empty($value)) {
            // Prepare the SQL statement
            $stmt = $db->prepare("UPDATE ibms_setting SET value = ?,status=? WHERE name = ?");
    
            // Bind parameters
            $stmt->bind_param('sss', $value,$status, $key);
    
            // Execute the statement
            $stmt->execute();
        }
    }
    
    // Redirect back to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
    
}else{


foreach ($_POST as $key => $value) {
    // Ensure key and value are not empty (you may need additional validation)
    if (!empty($key) && !empty($value)) {
        // Prepare the SQL statement
        $stmt = $db->prepare("INSERT INTO ibms_setting (name, value,status) VALUES (?, ?,?)");

        // Bind parameters
        $stmt->bind_param('sss', $key, $value,$status);

        // Execute the statement
        $stmt->execute();
    }
}

// Redirect back to the previous page
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
}
}
?>
