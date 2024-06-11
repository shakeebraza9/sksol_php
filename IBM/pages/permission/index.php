<?php
include('../../global.php');

if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
if($_SESSION["userStatus"] == 0){
    echo "<h1>This Page only access Admin go to home page</h1>";
    echo '<li><a href="../../login">Home</a></li>';
    exit();
}else{
    $csrfToken = $fun->generateCsrfToken2();
    // var_dump($_SESSION['csrf_token_Permission']);
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
            <li><a href="../../login">Home</a></li>
            <li><a href="#" onclick="showAllMenu()">All Menu</a></li>
                <li><a href="#" onclick="addMenu()">Add menu </a></li>
            </ul>
        </nav>
    </header>


    <div class="content">
        <div class="input-container">
        <h3>Menu IBMS 1.0</h3>
            <input type="text" id="textInput" placeholder="Enter your text" required>
            <input type="hidden" id="csrf_token" value="<?php echo $csrfToken; ?>">
            <h4>Chosen - Multiple Select</h4>
		<select name="menuType" id="menuType" class="multipleChosen" multiple="true">
        <option value="menu">Menu</option>
        <option value="banner">Banner</option>
        <option value="page">Page</option>
        <option value="homepage">Home Page</option>
        <option value="gallery">Gallery</option>
        <option value="setting">Setting</option>
		</select>	
            <button class="submit" onclick="submitForm()">Submit</button>
        </div>
        
        <!-- Display area for all menu items -->
        <div id="allMenu" style="display: none;">
        <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>penel <b>premission</b></h2></div>
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
                            <th>Page permission</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM penel_premission WHERE publish=1";
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
                            $encodedId = $fun->customEncode($id,"permission");
                      
                                echo"
                                <tr>
                                <td>".$i."</td>
                                <td>".$row['penel_name']."</td>
                                <td>".$row['value_name']."</td>
                                <td>
                                    <a href='edit?edit={$encodedId}' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
                                    <a href='#' class='delete' title='Delete' data-toggle='tooltip' onclick=\"deleteRecordPermission('$encodedId');
                                    \" data-id='{$encodedId}'><i class='material-icons'>&#xE872;</i></a>
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
    <script src='https://use.fontawesome.com/b2c0f76220.js'></script>
<script src='https://raw.githubusercontent.com/emmetio/textarea/master/emmet.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.5.0/highlight.min.js'></script>

    <script src="https://localhost/ibmspro/ibm/js/script.js"></script>
    <script src="https://localhost/ibmspro/ibm/pages/permission/js/ajax.js"></script>
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
