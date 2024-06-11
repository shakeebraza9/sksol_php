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

.input-container {
        /* max-width: 400px; */
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
            <li><a href="#" onclick="showAllMenu()">All User,s</a></li>
                <li><a href="#" onclick="addMenu()">Add User </a></li>
            </ul>
        </nav>
    </header>



    <div class="content">
        <div class="input-container">
            <h3>IBMS Admin User IBMS 1.0</h3>
            <input type="text" id="nameInput" placeholder="Enter your Name" required>
            <div class="wrapper">
 <input type="radio" name="gender" value ="Male" id="option-1" checked>
 <input type="radio" name="gender" value ="Female" id="option-2">
   <label for="option-1" class="option option-1">
     <div class="dot"></div>
      <span>Male</span>
      </label>
   <label for="option-2" class="option option-2">
     <div class="dot"></div>
      <span>Female</span>
   </label>
</div>
<label for="permissionType">User permission type type:</label>
            <select id="permissionType" name="permissionType">
                <option value="0">No any Permission</option>
                <?php
                $whereMenu="publish=1";
                $menutypes=$dbf->getRows("penel_premission",$whereMenu);
                if(isset($menutypes)){
                foreach($menutypes as $key=>$val){
                    $valId=$fun->customEncode($val['id'],"permission");
                    echo "<option value='".$valId."'>".$val['penel_name']."</option>";
                  
                }
            }
            ?>

            <input type="Email" id="emailInput" placeholder="Enter your Email" required>
            <input type="text" id="phoneInput" placeholder="Enter your Phone" required>
            <input type="text" id="cityInput" placeholder="Enter your City" required>
            <input type="text" id="counterInput" placeholder="Enter your Counter" required>
            <textarea name="Details" id="address" placeholder="Enter Address" cols="30" rows="10"></textarea>

            <br>
            <br>
            <input type="password" id="password" placeholder="Enter your Password" required>
            <input type="password" id="rePassword" placeholder="Retype Password" required>
            <button onclick="chkUser()">Submit</button>
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
                            <th>Username <i class="fa fa-sort"></i></th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM users";
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
                            $encodedId = base64_encode($id);
                            echo "
                            <tr>
                                <td>".$i."</td>
                                <td>".$row['username']."</td>
                                <td>".$row['email']."</td>
                                <td>
                                    <a href='pages/user/edit.php?id={$encodedId}' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
                                    <a href='#' class='delete' title='Delete' data-toggle='tooltip' onclick=\"deleteRecordUser({$id},'user')\" data-id='{$encodedId}'><i class='material-icons'>&#xE872;</i></a>
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
