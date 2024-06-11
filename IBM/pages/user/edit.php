
<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
    header("Location: ../../login");
}
if (isset($_GET['id'])) {
    $encodedId = $_GET['id'];

    // Decode the ID
    $id = base64_decode($encodedId);

    // Assuming $db is your database connection

    // Use proper prepared statements to prevent SQL injection
    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Data found for the decoded ID
        $row = $result->fetch_assoc();
        $name=$row['username'];
        $email =$row['email'];
        $phone=$row['phone'];
        $gender=$row['gender'];
        $city=$row['city'];
        $country=$row['country'];
        $address=$row['address'];

        

        // Use $row for further processing
    } else {
        // No data found for the decoded ID
        header("Location: ../../login.php");
        exit(); // Ensure no further code is executed
    }

    $stmt->close();
} else {
    // ID parameter not provided in the URL
}
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
@import url('https://fonts.googleapis.com/css?family=Lato:400,500,600,700&display=swap');

.wrapper{
  display: inline-flex;
  background: #fff;
  height: 80%;
  width: 100%;
  align-items: center;
  justify-content: space-evenly;
  border-radius: 5px;
  padding: 20px 15px;
  box-shadow: 5px 5px 30px rgba(0,0,0,0.2);
}
.wrapper .option{
  background: #fff;
  height: 98%;
  width: 56%;
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  margin: -14px 78px;
  border-radius: 5px;
  cursor: pointer;
  padding: 0 10px;
  border: 2px solid lightgrey;
  transition: all 0.3s ease;
}
.wrapper .option .dot{
  height: 20px;
  width: 20px;
  background: #d9d9d9;
  border-radius: 50%;
  position: relative;
}
.wrapper .option .dot::before{
  position: absolute;
  content: "";
  top: 4px;
  left: 4px;
  width: 12px;
  height: 12px;
  background: #0069d9;
  border-radius: 50%;
  opacity: 0;
  transform: scale(1.5);
  transition: all 0.3s ease;
}
input[type="radio"]{
  display: none;
}
#option-1:checked:checked ~ .option-1,
#option-2:checked:checked ~ .option-2{
  border-color: #0069d9;
  background: #0069d9;
}
#option-1:checked:checked ~ .option-1 .dot,
#option-2:checked:checked ~ .option-2 .dot{
  background: #fff;
}
#option-1:checked:checked ~ .option-1 .dot::before,
#option-2:checked:checked ~ .option-2 .dot::before{
  opacity: 1;
  transform: scale(1);
}
.wrapper .option span{
  font-size: 20px;
  color: #808080;
}
#option-1:checked:checked ~ .option-1 span,
#option-2:checked:checked ~ .option-2 span{
  color: #fff;
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
        <form id="menuForm" action="user.php" method="post" enctype="multipart/form-data">
        <div class="input-container">
            <h3>IBMS Admin User IBMS 1.0</h3>
            <input type="text" name="name" id="nameInput" value="<?php echo $name ?>" placeholder="Enter your Name" required>
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

            <input type="hidden" name="edit">
            <input type="hidden" name="id" value="<?php echo $encodedId?>">
            <input type="Email" name="email" id="emailInput" value="<?php echo $email ?>" placeholder="Enter your Email" required>
            <input type="text" name="phone" id="phoneInput" value="<?php echo $phone ?>" placeholder="Enter your Phone" required>
            <input type="text" name="city" id="cityInput" value="<?php echo $city ?>" placeholder="Enter your City" required>
            <input type="text" name="count" id="counterInput" value="<?php echo $country ?>" placeholder="Enter your Counter" required>
            <textarea name="address" id="address"  placeholder="Enter Address" cols="30" rows="10"><?php 
            if(isset($address) && !empty($address)){
                echo $address ;
            }
            ?></textarea>

            <br>
            <br>
            <input type="password" name="pass" id="password" placeholder="Enter your Password" >
            <input type="password" name="repass" id="rePassword" placeholder="Retype Password" >
            <input type="submit" value="submit">
            </form>
        </div>


</body>
</html>
