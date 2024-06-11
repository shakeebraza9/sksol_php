<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
// is funcation ma abhi kam krna ha 
$Urlsec = $chklin->urlSecurity();
// var_dump($Urlsec);
if($Urlsec !=0){
$pagesPermission=$chklin->pagesPermissionChk("menu");
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
.input-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h3 {
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input,
    select,
    button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
            <li><a href="#" onclick="showAllMenu()">All Menu</a></li>
                <li><a href="#" onclick="addMenu()">Add menu </a></li>
            </ul>
        </nav>
    </header>


    <div class="content">
        <div class="input-container">
        <h3>Menu IBMS 1.0</h3>
            <input type="url" id="linkInput" placeholder="Enter your link" required>
            <input type="text" id="textInput" placeholder="Enter your text" required>
            <input type="hidden" id="token" value="<?php echo $_SESSION['csrfToken']?>">
            <?php
            $datamenuRoot="menurootmenu";
            $menuRoot =$fun->devloperSettingChk($datamenuRoot);
            if($menuRoot == 1){
            ?>
            <label for="menuType">Select menu type:</label>
            <select id="menuType" name="menuType">
                <option value="1">Root Menu</option>
                <?php
                $whereMenu="under = 1 AND publish = 1";
                $menutypes=$dbf->getRows("menu",$whereMenu);
                if(isset($menutypes)){
                foreach($menutypes as $key=>$val){
                    echo "<option value='".$val['id']."'>".$val['menu_name']."</option>";
                  
                }
            }
        }
                ?>
                <!-- Add more options as needed -->
            </select>
            <?php
                $datamenu="menuimage";
                $menuImage =$fun->devloperSettingChk($datamenu);
                if($menuImage == 1){
                        echo '
                        <label for="img">Select image:</label>
                        <input type="file" id="imgInput" name="img" accept="image/*">
                        
                        ';
                }
          
            ?>
        
            <button onclick="submitForm(<?php echo ($menuRoot == 1) ? 'true' : 'false'; ?>, <?php echo ($menuImage == 1) ? 'true' : 'false'; ?>)"
>Submit</button>
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
                            <th>Under</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT link, menu_name,id FROM menu WHERE under=1 AND publish=1";
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
                            $whereCluse="under=".$id." AND publish=1";
                            $underCheck=$dbf->getRows("menu",$whereCluse);
                            // Encode the ID
                            $encodedId = $fun->customEncode($id,"menu");
                            if($underCheck){
                                echo"
                                <tr>
                                <td>".$i."</td>
                                <td>".$row['menu_name']."</td>
                                <td>".$row['link']."</td>
                                <td>No under Menu</td>
                                <td>
                                <a href='pages/menu/edit.php?Token={$encodedId}&type=menu' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
                                    <a href='#' class='delete' title='Delete' data-toggle='tooltip' onclick=\"deleteRecord({$id},'menu')\" data-id='{$encodedId}'><i class='material-icons'>&#xE872;</i></a>
                                </td>
                            </tr>
                                ";
                                foreach($underCheck as $key=> $val){
                                    $m_Id=$val['id'];
                                    // $encodedId2=base64_encode($m_Id);
                                    $encodedId2 = $fun->customEncode($m_Id,"menu");
                                    echo "
                                    <tr>
                                        <td>".++$i."</td>
                                        <td>".$val['menu_name']."</td>
                                        <td>".$val['link']."</td>
                                        ";
                                        $whereCluse2="id=".$val['under']."";
                                        $undername=$dbf->getRows("menu",$whereCluse2);
                                        echo"
                                        <td>".$undername[0]['menu_name']."</td>
                                        <td>
                                        <a href='pages/menu/edit.php?Token={$encodedId2}&type=menu' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
                                            <a href='#' class='delete' title='Delete' data-toggle='tooltip' onclick=\"deleteRecord({$id},'menu')\" data-id='{$encodedId2}'><i class='material-icons'>&#xE872;</i></a>
                                        </td>
                                    </tr>
                                ";     
                                }
                            }else{
                            echo "
                            <tr>
                                <td>".$i."</td>
                                <td>".$row['menu_name']."</td>
                                <td>".$row['link']."</td>
                                <td>No under Menu</td>
                                <td>
                                <a href='pages/menu/edit.php?Token={$encodedId}&type=menu' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
                                    <a href='#' class='delete' title='Delete' data-toggle='tooltip' onclick=\"deleteRecord({$id},'menu')\" data-id='{$encodedId}'><i class='material-icons'>&#xE872;</i></a>
                                </td>
                            </tr>
                        ";
                            }
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