
<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
if (isset($_GET['Token']) && isset($_GET['type'])) {
    $encodedId = $_GET['Token'];

    // Decode the ID
    $id = $fun->customDecode($encodedId,'blog');
    $type=$_GET['type'];
    $pagesPermission=$chklin->pagesPermissionChk($type);
    // var_dump($id);
    // exit();
    if($pagesPermission == 1){

    // Use proper prepared statements to prevent SQL injection
    $stmt = $db->prepare("SELECT * FROM blog WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Data found for the decoded ID
        $row = $result->fetch_assoc();
        $name=unserialize($row['title']);
        $date=$row['date'];
        $description=unserialize($row['description']);
        $image=unserialize($row['image']);
        

        // Use $row for further processing
    } else {
        // No data found for the decoded ID
        header("Location: ../../login.php");
        exit(); // Ensure no further code is executed
    }

    $stmt->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Menu</title>
    <style>
         body {
        color: #566787;
        background: #f5f5f5;
		font-family: 'Roboto', sans-serif;
	}
    .table-responsive {
        margin: 30px 0;
    }
	.table-wrapper {
		min-width: 100%;
        background: #fff;
        padding: 20px;        
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .container {
    width: 100%;
}
	.table-title {
        padding-bottom: 10px;
        margin: 0 0 10px;
    }
    .table-title h2 {
        margin: 8px 0 0;
        font-size: 22px;
    }
    .search-box {
        position: relative;        
        float: right;
    }
    .search-box input {
        height: 34px;
        border-radius: 20px;
        padding-left: 35px;
        border-color: #ddd;
        box-shadow: none;
    }
	.search-box input:focus {
		border-color: #3FBAE4;
	}
    .search-box i {
        color: #a0a5b1;
        position: absolute;
        font-size: 19px;
        top: 8px;
        left: 10px;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
    }
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table td:last-child {
        width: 130px;
    }
    table.table td a {
        color: #a0a5b1;
        display: inline-block;
        margin: 0 5px;
    }
	table.table td a.view {
        color: #03A9F4;
    }
    table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #E34724;
    }
    table.table td i {
        font-size: 19px;
    }    
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 95%;
        width: 30px;
        height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 30px !important;
        text-align: center;
        padding: 0;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 6px;
        font-size: 95%;
    }    
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4; /* Add a background color to the body */
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center; /* Center the text in the header */
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center; /* Center the list items in the navigation */
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold; /* Make the text bold */
            transition: color 0.3s; /* Add a smooth color transition on hover */
        }

        nav ul li a:hover {
            color: #3498db; /* Change the color on hover */
        }

        .content {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .input-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input, button {
            margin-bottom: 15px;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }

        button {
            background-color: #3498db;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }
        #allMenu {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }

        #allMenu h2 {
            color: #333;
        }

        #allMenu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #allMenu li {
            margin-bottom: 10px;
        }
        table.table.table-striped.table-hover.table-bordered {
    width: 100%;
    text-align: center;
}
#textAreaContainer {
            text-align: center;
        }

        #scoringTextArea {
            width: 80%;
            height: 100px;
            margin: 10px;
        }

        .uploadOuter {
    text-align: center;
    padding: 20px;
    strong {
      padding: 0 10px
    }
  }
  .dragBox {
    width: 250px;
    height: 100px;
    margin: 0 auto;
    position: relative;
    text-align: center;
    font-weight: bold;
    line-height: 95px;
    color: #999;
    border: 2px dashed #ccc;
    display: inline-block;
    transition: transform 0.3s;
    input[type="file"] {
      position: absolute;
      height: 100%;
      width: 100%;
      opacity: 0;
      top: 0;
      left: 0;
    }
  }
  .draging {
    transform: scale(1.1);
  }
  #preview {
    text-align: center;
    img {
        border-radius: 20px;
        max-width: 81px;
        margin-block-end: 20px;
        max-height: 151px;
        border: 3px solid #3498db;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }
    img:hover{
        transform: rotate(10deg);
    }
  }
  textarea#deatils {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
    padding: 10px;
    width: 100%;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    margin-bottom: 10px;
}

    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
            <li><a href="../../login">Home</a></li>
            </ul>
        </nav>
    </header>


    <div class="content">
    <form id="menuForm" action="blog.php" method="post" enctype="multipart/form-data">
        <div class="input-container">
            <input type="text" name="text" id="textInput" placeholder="Enter your text" value="<?php echo $name ?>" required>
            <input type="hidden" name="edit">
            <input type="hidden" name="id" value="<?php echo $encodedId?>">
            <input type="hidden" name="token" value="<?php echo $_SESSION["csrfToken"]?>">
            <input name="date" type="date" id="dateInput" value="<?php echo $date ?>" placeholder="Enter your date" required>
            <textarea name="deatils" id="deatils" placeholder="Enter Deatils" cols="30" rows="10">
                <?php
                if(isset($description)){
                    echo $description;
                }
                ?>
            </textarea>
            
            <label for="uploadFile" class="btn btn-primary">Upload Image</label>
  <strong>OR</strong>
<span class="dragBox" >
  Darg and Drop image here
<input type="file" onChange="dragNdrop(event)" name="image"  ondragover="drag()" ondrop="drop()" id="uploadFile"  />
</span>
</div>
<div id="preview">
<?php
if(!empty($image)){
   echo ' <img src="'.$webUrlfun.'/uploades/blog/'.$image.'"> ';   
}

?>

</div>
            <input type="submit" value="submit">
        </div>
    </form>
</div>



<script src="../../js/drop.js"></script>


</body>
</html>
<?php
    }else{
        echo "<script>
              alert('Cannot access page without proper permission.');
              window.location.href = '../../login.php'; // Replace 'logout.php' with the actual URL of your logout page
            </script>";
      }
  } else {
    echo "<script>
    alert('without token and type not access this page');
    window.location.href = '../../login.php'; // Replace 'logout.php' with the actual URL of your logout page
  </script>";
  }
  ?>