<?php
include('../../global.php');
// Assuming you have the $id variable containing the ID of the record you want to delete
$id = $_POST['id']; // You might get this from the URL or another source

// Perform the delete query
$sql = "DELETE FROM menu WHERE id = $id";

if ($db->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $mysqli->error;
}

// Close the database connection
$db->close();



?>