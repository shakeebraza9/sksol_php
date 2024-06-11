<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
$Urlsec = $chklin->urlSecurity();
if($Urlsec !=0){
    $pagesPermission=$chklin->pagesPermissionChk("blog");
    if($pagesPermission == 1){
$namesToSearch = ['sitename', 'email', 'phone', 'location', 'locationtext', 'facebook', 'twitter', 'linkedin', 'instagram'];


$stmt = $db->prepare("SELECT * FROM ibms_setting WHERE name LIKE ? OR name LIKE ? OR name LIKE ? OR name LIKE ? OR name LIKE ? OR name LIKE ? OR name LIKE ? OR name LIKE ? OR name LIKE ?");

if ($stmt) {

    $paramString = str_repeat('s', count($namesToSearch));


    $likeArray = array_map(function ($name) {
        return "%$name%";
    }, $namesToSearch);

    $params = array_merge([$paramString], $likeArray);


    $refs = [];
    foreach ($params as $key => $value) {
        $refs[$key] = &$params[$key];
    }
    call_user_func_array([$stmt, 'bind_param'], $refs);

    $stmt->execute();

    $result = $stmt->get_result();

    // var_dump($result);


    $rowsArray = [];

    while ($row = $result->fetch_assoc()) {

        $rowsArray[$row['name']] = $row['value']; 
    }

                $name = isset($rowsArray['sitename']) ? $rowsArray['sitename'] : '';
                // var_dump($row['sitename']);
                $email = isset($rowsArray['email']) ? $rowsArray['email'] : '';
                $phone = isset($rowsArray['phone']) ? $rowsArray['phone'] : '';
                $location = isset($rowsArray['location']) ? $rowsArray['location'] : '';
                $locationtext = isset($rowsArray['locationtext']) ? $rowsArray['locationtext'] : '';
                $facebook = isset($rowsArray['facebook']) ? $rowsArray['facebook'] : '';
                $twitter = isset($rowsArray['twitter']) ? $rowsArray['twitter'] : '';
                $linkedin = isset($rowsArray['linkedin']) ? $rowsArray['linkedin'] : '';
                $instagram = isset($rowsArray['instagram']) ? $rowsArray['instagram'] : '';



    $stmt->close();
} else {
    die('Error preparing the SQL statement: ' . $db->error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Menu</title>
    <style>
.container {
width: 100%;
}
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
            <!-- <li><a href="#" onclick="showAllMenu()">All User,s</a></li> -->
                <li><a href="#" onclick="addMenu()">Add User </a></li>
            </ul>
        </nav>
    </header>




    <div class="content">
        <form id="menuForm" action="pages/setting/ibms.php" method="post" enctype="multipart/form-data">
        <div class="input-container">
            <h3>Site information IBMS 1.0</h3>
            <input type="text" name="sitename" id="sitename" value="<?php echo $name ?>" placeholder="Enter your Site Name" required>
            <?php
            
            if(!empty($name) || !empty($email) || !empty($phone) || !empty($location) || !empty($locationtext) || !empty($facebook) || !empty($twitter) || !empty($linkedin) || !empty($instagram)){
                       // Usage example
              
                       $randomPin = $fun->generateRandomPin();
                    //    echo $randomPin;
                   echo' <input type="hidden" name="tokken" value="'.$randomPin.'">';


                }

                
         
            ?>
            <input type="Email" name="email" id="email" value="<?php echo $email ?>" placeholder="Enter your Email" required>
            <input type="text" name="phone" id="phoneInput" value="<?php echo $phone ?>" placeholder="Enter your Mobile" required>
            <input type="text" name="locationtext" id="locationtext" value="<?php echo $locationtext ?>" placeholder="Enter your Location Text" required>
            <input type="url" name="location" id="location" value="<?php echo $location ?>" placeholder="Enter your Location Url" required>
            <input type="csrfToken" id="token" value="<?php echo $_SESSION['csrfToken']?>">
            <h3>Socal Links</h3>
            <input type="text" name="facebook" id="facebook" value="<?php echo $facebook ?>" placeholder="Facebook Link" required>
            <input type="text" name="twitter" id="twitter" value="<?php echo $twitter ?>" placeholder="Twitter Link" required>
            <input type="text" name="linkedin" id="linkedin" value="<?php echo $linkedin ?>" placeholder="LinkedIn Link" required>
            <input type="text" name="instagram" id="instagram" value="<?php echo $instagram ?>" placeholder="Instagram Link" required>

           <input type="submit" value="submit">
            </form>
        </div>
        </div>

</body>
</html>
<?php
}else{
    echo "<script>
            alert('Cannot access page without proper permission.');
            window.location.href = '../../login.php'; // Replace 'logout.php' with the actual URL of your logout page
          </script>";
}
}else{
    echo "<script>
            alert('Cannot access this page directly.');
            window.location.href = '../../login.php'; // Replace 'logout.php' with the actual URL of your logout page
          </script>";
}