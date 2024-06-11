<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
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
            <li>Pages Management</li>
            </ul>
        </nav>
    </header>


        <div id="allMenu">
        <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Manage <b> Home Page Content</b></h2></div>
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
                            <th>title <i class="fa fa-sort"></i></th>
                            <th>link Text</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM box WHERE publish = 1";
                        $result = $db->query($sql);
                        
                        $menuItems = array();
                        while ($row = $result->fetch_assoc()) {
                            $menuItems[] = $row;
                        }
                        
                        $i=1;
                        foreach($menuItems as $row){
                            // var_dump($row);
                            $id = $row['id'];

                            // Encode the ID
                            $encodedId = base64_encode($id);
                            echo "
                            <tr>
                                <td>".$i."</td>
                                <td>".unserialize($row['heading'])."</td>
                                <td>".unserialize($row['linktext'])."</td>
                                <td>
                                    <a href='pages/homepage/edit.php?id={$encodedId}' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
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


</body>
</html>
