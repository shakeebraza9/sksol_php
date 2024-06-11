
<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
if (isset($_GET['edit'])) {
    $encodedId = $_GET['edit'];

    // Decode the ID
    $id = $fun->customDecode($encodedId,"permission");
    // var_dump($encodedId);

    // Assuming $db is your database connection

    // Use proper prepared statements to prevent SQL injection
    $stmt = $db->prepare("SELECT * FROM penel_premission WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Data found for the decoded ID
        $row = $result->fetch_assoc();
        $name=$row['penel_name'];
        $value=$row['value_name'];
        $csrfToken = $fun->generateCsrfToken2();
        

        // Use $row for further processing
    } else {
        // No data found for the decoded ID
        header("Location: ../../login.php");
        exit(); // Ensure no further code is executed
    }

    $stmt->close();
} else {
    // ID parameter not provided in the URL
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Menu</title>
    <link rel="stylesheet" href="<?php echo $webUrlfun?>/pages/permission/css/style.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
</head>
<body>
    <header>
        <nav>
            <ul>
            <li><a href="index">Back</a></li>
            </ul>
        </nav>
    </header>


    <div class="content">
    <form id="menuForm" action="permission.php" method="post" enctype="multipart/form-data">
        <div class="input-container">
            <input type="text" name="text" id="textInput" placeholder="Enter your text" value="<?php echo $name ?>" required>
            <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
            <input type="hidden" name="edit">
            <input type="hidden" name="id" value="<?php echo $encodedId?>">
            <h4>Chosen - Multiple Select</h4>
		<select name="menuType" id="menuType" class="multipleChosen" multiple="true">
        <option value="menu">Menu</option>
        <option value="banner">Banner</option>
        <option value="page">Page</option>
        <option value="homepage">Home Page</option>
        <option value="gallery">Gallery</option>
        <option value="setting">Setting</option>
		</select>
        <?php

        ?>

            <input type="submit" value="submit">
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
  //Chosen
  $(".multipleChosen").chosen({
      placeholder_text_multiple: "What's your rating" //placeholder
	});
})
</script>
</body>
</html>
