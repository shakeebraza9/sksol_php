<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
// is funcation ma abhi kam krna ha 
$Urlsec = $chklin->urlSecurity();
// var_dump($Urlsec);
if($Urlsec !=0){
$pagesPermission=$chklin->pagesPermissionChk("page");
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
            <li><a href="#" onclick="showAllMenu()">All pages</a></li>
                <li><a href="#" onclick="addMenu()">Add paes </a></li>
            </ul>
        </nav>
    </header>


    <div class="content">
        <div class="input-container">
        <h3>Pages IBMS 1.0</h3>
            <input type="text" id="textInput" placeholder="Enter your text" required>
            <input type="url" id="linkInput" placeholder="Enter your url" required>
            <input type="hidden" id="token" value="<?php echo $_SESSION['csrfToken']?>">
            <main class="cd__main">
         <!-- Start DEMO HTML (Use the following code into your project)-->
         <div class="editor-holder">
	<ul class="toolbar">
		<li><a href="#" id="indent" title="Toggle tabs or spaces"><i class="fa fa-indent"></i></a></li>
		<li><a href="#" id="fullscreen" title="Toggle fullscreen mode"><i class="fa fa-expand"></i></a></li>
	</ul>
	<div class="scroller">
		<textarea class="editor allow-tabs pagetext">
 </textarea>
		<pre><code class="syntax-highight html pagetext"></code></pre>
	</div>
</div>
         <!-- END EDMO HTML (Happy Coding!)-->
      </main>
            <button onclick="submitPages()">Submit</button>
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
                            <th>Page Title <i class="fa fa-sort"></i></th>
                            <th>slug</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM pages";
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
                            $id = $row['pg_id'];

                            // Encode the ID
                            $encodedId = $fun->customEncode($id,'page');
                            // $decodedHtmlContent = html_entity_decode($row['dsc']);
                            
                            echo "
                            <tr>
                                <td>".$i."</td>
                                <td>".$row['title']."</td>
                                <td>".$row['slug']."</td>
                                <td>
                                <a href='pages/page/edit.php?Token={$encodedId}&type=page' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
                                    <a href='#' class='delete' title='Delete' data-toggle='tooltip' onclick=\"deleteRecordPage({$id},'page')\" data-id='{$encodedId}'><i class='material-icons'>&#xE872;</i></a>
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