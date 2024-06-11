<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
$Urlsec = $chklin->urlSecurity();
if($Urlsec !=0){
$pagesPermission=$chklin->pagesPermissionChk("banner");
// var_dump($pagesPermission);
if($pagesPermission == 1){
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
            <li><a href="#" onclick="showAllMenu()">All Banners</a></li>
                <li><a href="#" onclick="addMenu()">Add Banner </a></li>
            </ul>
        </nav>
    </header>



    <div class="content">
        <div class="input-container">
            <h3>Banners IBMS 1.0</h3>
            <input type="text" id="titleInput" placeholder="Enter your Title" required>
            <input type="text" id="textInput" placeholder="Enter your Text" required>
            <input type="hidden" id="token" value="<?php echo $_SESSION['csrfToken']?>">
            <textarea name="Details" id="comment" placeholder="Enter Comment" cols="30" rows="10"></textarea>
            <?php
                $dataBanner="bannerimage";
                $bannerImage =$fun->devloperSettingChk($dataBanner);
                if($bannerImage == 1){
                        echo '
                        <label for="img">Select image:</label>
                        <input type="file" id="imgInput" name="img" accept="image/*">
                        
                        ';
                }
          
            ?>
            
            
            <button onclick="submitFormBanner()">Submit</button>
        </div>
        
        <!-- Display area for all menu items -->
        <div id="allMenu" style="display: none;">
        <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Main <b>Menu</b></h2></div>
                        <div class="col-sm-4">
                            <div class="search-box">
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" class="form-control" placeholder="Search&hellip;">
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                     
                        <tr>
                            <th>#</th>
                            <th>Name <i class="fa fa-sort"></i></th>
                            <th>link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM banner";
                        $result = $db->query($sql);
                        
                        $menuItems = array();
                        while ($row = $result->fetch_assoc()) {
                            $menuItems[] = $row;
                        }
                        
                        // Return the menu items as JSON
                        // echo json_encode($menuItems);
                        $i=1;
                        foreach($menuItems as $row){
                            // var_dump($row);
                            $id = $row['id'];

                            // Encode the ID
                            $encodedId = $fun->customEncode($id,'banner');
                            echo "
                            <tr>
                                <td>".$i."</td>
                                <td>".$row['title']."</td>
                                <td>".$row['deatils']."</td>
                                <td>
                                    <a href='pages/banner/edit.php?Token={$encodedId}&type=banner' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
                                    <a href='#' class='delete' title='Delete' data-toggle='tooltip' onclick=\"deleteRecordBanner({$id},'banner')\" data-id='{$encodedId}'><i class='material-icons'>&#xE872;</i></a>
                                </td>
                            </tr>
                        ";
                        
                        $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>        
    </div>     
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
?>