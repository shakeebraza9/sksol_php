
<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
if (isset($_GET['Token']) && isset($_GET['type'])) {
    $encodedId = $_GET['Token'];

    // Decode the ID
    $id = $fun->customDecode($encodedId,'banner');
    $type=$_GET['type'];
    $pagesPermission=$chklin->pagesPermissionChk($type);
 
    if($pagesPermission == 1){

    // Assuming $db is your database connection

    // Use proper prepared statements to prevent SQL injection
    $stmt = $db->prepare("SELECT * FROM banner WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Data found for the decoded ID
        $row = $result->fetch_assoc();
        $name=$row['title'];
        $details =$row['deatils'];
        $text2=$row['text2'];
        $image=$row['img'];
        

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
    body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .content {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .input-container {
            text-align: center;
        }

        h3 {
            color: #333;
        }

        input,
        textarea,
        button {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
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
<form id="menuForm" action="banner.php" method="post" enctype="multipart/form-data">
        <div class="input-container">
            <h3>Banners IBMS 1.0</h3>
            <input name="title" type="text" id="titleInput"  value="<?php echo $name ?>" placeholder="Enter your Title" required>
            <input name="text" type="text" id="textInput"  value="<?php echo $text2 ?>" placeholder="Enter your Text" required>
            <input type="hidden" name="edit">
            <input type="hidden" name="id" value="<?php echo $encodedId?>">
            <input type="hidden" name="token2" value="<?php echo $_SESSION["csrfToken"]?>">
            <textarea name="comment" id="comment" placeholder="Enter Comment" cols="30" rows="10"><?php 
            if(isset($details) && !empty($details)){
                echo $details ;
            }
            ?></textarea>
            <label for="img">Select image:</label>
            <input type="file" id="imgInput" name="image" accept="image/*">
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
} else {
echo "<script>
alert('without token and type not access this page');
window.location.href = '../../login.php'; // Replace 'logout.php' with the actual URL of your logout page
</script>";
}

?>