<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
$Urlsec = $chklin->urlSecurity();
// var_dump($Urlsec);
if($Urlsec !=0){
$pagesPermission=$chklin->pagesPermissionChk("blog");
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
            <li><a href="#" onclick="showAllMenu()">Show Blog,s</a></li>
                <li><a href="#" onclick="addMenu()">Add Blog </a></li>
            </ul>
        </nav>
    </header>

    <div class="content">
        <div class="input-container">
        <h3>Gallery IBMS 1.0</h3>
            <input name="text" type="text" id="textInput" placeholder="Enter your Title" required>
            <input name="date" type="date" id="dateInput" placeholder="Enter your date" required>
            <input type="hidden" id="token" value="<?php echo $_SESSION['csrfToken']?>">
            <textarea name="deatils" id="deatils" placeholder="Enter Deatils" cols="30" rows="10"></textarea>
            <div class="uploadOuter">
            <label for="uploadFile" class="btn btn-primary">Upload Image</label>
            <strong>OR</strong>
            <span class="dragBox" >
            Darg and Drop image here
            <input type="file" onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()" id="uploadFile"  />
            </span>
            </div>
            <div id="preview"></div>

            <button onclick="submitFormBlog()">Submit</button>
        </div>
        
        <!-- Display area for all menu items -->
        <div id="allMenu" style="display: none;">
        <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Main <b>Gallery </b></h2></div>
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
                            <th>image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM blog WHERE `publish` = 1";
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
                            $image = unserialize($row['image']);

                            // Encode the ID
                            $encodedId = $fun->customEncode($id,"blog");
                            echo "
                            <tr>
                                <td>".$i."</td>
                                <td>".unserialize($row['title'])."</td>
                                <td><img src='".$webUrlfun."/uploades/blog/".$image."' width='100' height='100'></td>
                                <td>
                                <a href='pages/blog/edit.php?Token={$encodedId}&type=blog' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
                                    <a href='#' class='delete' title='Delete' data-toggle='tooltip' onclick=\"deleteRecordblog({$id},'blog')\" data-id='{$encodedId}'><i class='material-icons'>&#xE872;</i></a>
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
<script>

</script>
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