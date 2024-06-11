<?php
session_start();
include('global.php');
// var_dump($_SESSION["csrfToken"]);
// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: logout.php"); // Redirect to login page if not logged in
    exit();
}
$cookieCheck=$chklin->cookieSetorset();
if($cookieCheck ==1){
    header("Location: logout.php");
}
// Retrieve user's age from the session
$userAge = isset($_SESSION["user_age"]) ? $_SESSION["user_age"] : "N/A";
if(isset($_SESSION["username"])){
    $chklin->start_session_with_timeout();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Side Menu</title>
    <link rel="stylesheet" href="<?php echo $webUrl?>/pages/css/style.css">


    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .side-menu {
            width: 250px;
            height: 100vh;
            background-color: #333;
            color: #fff;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .menu-item {
            padding: 10px;
            margin: 5px;
            border-bottom: 1px solid #555;
            text-decoration: none;
            color: #fff;
            display: block;
            cursor: pointer;
        }

        .menu-item:hover {
            background-color: #555;
        }

        .content {
            flex: 1;
            padding: 20px;
        }
        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto;
            display: block;
            object-fit: cover;
            border: 2px solid #fff;
        }
        .h3, h3 {
                font-size: 24px;
                text-align: center;
        }

        

    </style>
</head>
<body>
    <div class="side-menu" id="sideMenu">
    <img src="devloperimage.png" alt="Profile Image" class="profile-image">
        <h3><?php echo $_SESSION["username"] ;?></h3>
<?php
$menuPermissionArray=$chklin->menuPermission();


if ($_SESSION["userStatus"] == 1 || isset($menuPermissionArray['menu'])) {
    echo '<a href="#" class="menu-item" onclick="changeContent(\'menu\')">Menu</a>';
}
if ($_SESSION["userStatus"] == 1 || isset($menuPermissionArray['banner'])) {
    echo '<a href="#" class="menu-item" onclick="changeContent(\'banner\')">Banner</a>';
}
if ($_SESSION["userStatus"] == 1 || isset($menuPermissionArray['page'])) {
    echo '<a href="#" class="menu-item" onclick="changeContent(\'page\')">Pages</a>';
}
if ($_SESSION["userStatus"] == 1 || isset($menuPermissionArray['homepage'])) {
    echo '<a href="#" class="menu-item" onclick="changeContent(\'homepage\')">Home Page</a>';
}
if ($_SESSION["userStatus"] == 1 || isset($menuPermissionArray['blog'])) {
    echo '<a href="#" class="menu-item" onclick="changeContent(\'blog\')">Blog</a>';
}
if ($_SESSION["userStatus"] == 1 || isset($menuPermissionArray['gallery'])) {
    echo '<a href="#" class="menu-item" onclick="changeContent(\'gallery\')">Gallery</a>';
}
if ($_SESSION["userStatus"] == 1 || isset($menuPermissionArray['setting'])) {
    echo '<a href="#" class="menu-item" onclick="changeContent(\'setting\')">Setting</a>';
}
?>
    <!-- <a href="#" class="menu-item" onclick="changeContent('menu')">Menu</a> -->
        <!-- <a href="#" class="menu-item" onclick="changeContent('banner')">Banner</a>
        <a href="#" class="menu-item" onclick="changeContent('page')">Pages</a> -->
        <!-- <a href="#" class="menu-item" onclick="changeContent('homepage')">Home Page</a>
        <a href="#" class="menu-item" onclick="changeContent('blog')">Blog</a>
        <a href="#" class="menu-item" onclick="changeContent('gallery')">Gallery</a>
        <a href="#" class="menu-item" onclick="changeContent('setting')">Setting</a> -->
        <?php if(isset($_SESSION["userStatus"])) {
            if($_SESSION["userStatus"] == 1){
                echo '
                <a href="pages/permission/index" class="menu-item">Permission</a>
                <a href="#" class="menu-item" onclick="changeContent(\'user\')">User IBM</a>
            ';
            }
        }
        ?>
       
        <a href="logout" class="menu-item">logout</a>






</div>
    <div class="content" id="mainContent">
        <h2>IBMS 1.0</h2>
        <p>This is the main content area. Click on a menu item to change the content.</p>
    </div>
    <script src='https://use.fontawesome.com/b2c0f76220.js'></script>
<script src='https://raw.githubusercontent.com/emmetio/textarea/master/emmet.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.5.0/highlight.min.js'></script>
   
    <script src="<?php echo $webUrl?>/js/ajax.js"></script>
    <script src="<?php echo $webUrl?>/js/textaera.js"></script>
    <script src="<?php echo $webUrl?>/js/script.js"></script>
    <script src="<?php echo $webUrl?>/js/user.js"></script>
    <script src="<?php echo $webUrl?>/js/drop.js"></script>
    <script>
           function toggleSubMenu(subMenuId) {
        var subMenu = document.getElementById(subMenuId);
        if (subMenu.style.display === 'none' || subMenu.style.display === '') {
            subMenu.style.display = 'contents';
        } else {
            subMenu.style.display = 'none';
        }
    }
    $(document).ready(function(){
    $("#multipleChosen").chosen({
        placeholder_text_multiple: "Select options",
        search_contains: true
    });
});
        function changeContent(page) {
            // Get the content div
            var contentDiv = document.getElementById('mainContent');

            // Fetch content from the corresponding file using AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    contentDiv.innerHTML = xhr.responseText;
                }
            };

            // Specify the file to load based on the page parameter
            xhr.open('GET', 'pages/'+page+'/index' + '.php', true);
            xhr.send();
        }
    </script>
</body>
</html>


