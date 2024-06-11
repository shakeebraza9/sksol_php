
<?php
include('../../global.php');
if ($chklin->isLoggedIn() != 1) {
  header("Location: ../../login");
}


if (isset($_GET['Token']) && isset($_GET['type'])) {
    $encodedId = $_GET['Token'];

    // Decode the ID
    $id = $fun->customDecode($encodedId,'page');
    $type=$_GET['type'];
    $pagesPermission=$chklin->pagesPermissionChk($type);
 
    if($pagesPermission == 1){
    // Assuming $db is your database connection

    // Use proper prepared statements to prevent SQL injection
    $stmt = $db->prepare("SELECT * FROM pages WHERE pg_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Data found for the decoded ID
        $row = $result->fetch_assoc();
        $name=$row['title'];
        $link=$row['slug'];
        $dsc=$row['dsc'];
        $decodedHtmlContent = html_entity_decode($dsc);

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
            overflow: scroll;
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


        /* style for textaera */
        .editor-holder {
  width: 800px;
  height: 500px;
  margin-top: 50px;
  border-radius: 3px;
  position: relative;
  top: 0;
  margin: 15px auto;
  background: #1f1f1f !important;
  overflow: auto;
  box-shadow: 5px 5px 10px 0px rgba(0, 0, 0, 0.4);
  transition: all 0.5s ease-in-out;
}
.editor-holder.fullscreen {
  width: 100%;
  height: 100%;
  margin: 0;
  left: 0;
}
.editor-holder .toolbar {
  width: 100%;
  list-style: none;
  position: absolute;
  top: -2px;
  margin: 0;
  left: 0;
  z-index: 3;
  padding: 8px;
  background: #afafaf;
}
.editor-holder .toolbar li {
  display: inline-block;
}
.editor-holder .toolbar a {
  line-height: 20px;
  background: rgba(144, 144, 144, 0.6);
  color: grey;
  box-shadow: inset -1px -1px 1px 0px rgba(0, 0, 0, 0.28);
  display: block;
  border-radius: 3px;
  cursor: pointer;
}
.editor-holder .toolbar a:hover {
  background: rgba(144, 144, 144, 0.8);
}
.editor-holder .toolbar a.active {
  background: rgba(144, 144, 144, 0.8);
  box-shadow: none;
}
.editor-holder .toolbar i {
  color: #565656;
  padding: 8px;
}
.editor-holder textarea, .editor-holder code {
  width: 100%;
  height: auto;
  min-height: 450px;
  font-size: 14px;
  border: 0;
  margin: 0;
  top: 46px;
  left: 0;
  padding: 20px !important;
  line-height: 21px;
  position: absolute;
  font-family: Consolas, Liberation Mono, Courier, monospace;
  overflow: visible;
  transition: all 0.5s ease-in-out;
}
.editor-holder textarea {
  background: transparent !important;
  z-index: 2;
  height: auto;
  resize: none;
  color: #fff;
  text-shadow: 0px 0px 0px rgba(0, 0, 0, 0);
  text-fill-color: transparent;
  -webkit-text-fill-color: transparent;
}
.editor-holder textarea::-webkit-input-placeholder {
  color: white;
}
.editor-holder textarea:focus {
  outline: 0;
  border: 0;
  box-shadow: none;
}
.editor-holder code {
  z-index: 1;
}

pre {
  white-space: pre-wrap;
  white-space: -moz-pre-wrap;
  white-space: -pre-wrap;
  white-space: -o-pre-wrap;
  word-wrap: break-word;
}
pre code {
  background: #1f1f1f !important;
  color: #adadad;
}
pre code .hljs {
  color: #a9b7c6;
  background: #282b2e;
  display: block;
  overflow-x: auto;
  padding: 0.5em;
}
pre code .hljs-number,
pre code .hljs-literal,
pre code .hljs-symbol,
pre code .hljs-bullet {
  color: #6897BB;
}
pre code .hljs-keyword,
pre code .hljs-selector-tag,
pre code .hljs-deletion {
  color: #cc7832;
}
pre code .hljs-variable,
pre code .hljs-template-variable,
pre code .hljs-link {
  color: #629755;
}
pre code .hljs-comment,
pre code .hljs-quote {
  color: #808080;
}
pre code .hljs-meta {
  color: #bbb529;
}
pre code .hljs-string,
pre code .hljs-attribute,
pre code .hljs-addition {
  color: #6A8759;
}
pre code .hljs-section,
pre code .hljs-title,
pre code .hljs-type {
  color: #ffc66d;
}
pre code .hljs-name,
pre code .hljs-selector-id,
pre code .hljs-selector-class {
  color: #e8bf6a;
}
pre code .hljs-emphasis {
  font-style: italic;
}
pre code .hljs-strong {
  font-weight: bold;
}
@import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
@import url('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
*{ margin: 0; padding: 0;}
*, *::before, *::after {
  margin: 0;
  padding: 0;
  box-sizing: inherit;
}

body{
  min-height: 100vh;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  align-content: flex-start;
    
  font-family: 'Roboto', sans-serif;
  font-style: normal;
  font-weight: 300;
  font-smoothing: antialiased;
-webkit-font-smoothing: antialiased;
-moz-osx-font-smoothing: grayscale;
  font-size: 15px;
  background: #eee;
}
.cd__intro{
   padding: 60px 30px;
   margin-bottom: 15px;
        flex-direction: column;

}
.cd__intro,
.cd__credit{
    display: flex;
    width: 100%;
    justify-content: center;
    align-items: center;
    background: #fff;
    color: #333;
    line-height: 1.5;
    text-align: center;
}

.cd__intro h1 {
   font-size: 18pt;
   padding-bottom: 15px;

}
.cd__intro p{
   font-size: 14px;
}

.cd__action{
   text-align: center;
   display: block;
   margin-top: 20px;
}

.cd__action a.cd__btn {
  text-decoration: none;
  color: #666;
   border: 2px solid #666;
   padding: 10px 15px;
   display: inline-block;
   margin-left: 5px;
}
.cd__action a.cd__btn:hover{
   background: #666;
   color: #fff;
    transition: .3s;
-webkit-transition: .3s;
}
.cd__action .cd__btn:before{
  font-family: FontAwesome;
  font-weight: normal;
  margin-right: 10px;
}
.down:before{content: "\f019"}
.back:before{content:"\f112"}

.cd__credit{
    padding: 12px;
    font-size: 9pt;
    margin-top: 40px;

}
.cd__credit span:before{
   font-family: FontAwesome;
   color: #e41b17;
   content: "\f004";


}
.cd__credit a{
   color: #333;
   text-decoration: none;
}
.cd__credit a:hover{
   color: #1DBF73; 
}
.cd__credit a:hover:after{
    font-family: FontAwesome;
    content: "\f08e";
    font-size: 9pt;
    position: absolute;
    margin: 3px;
}
.cd__main{
  background: #fff;
  padding: 20px;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
  
}
.cd__main{
    display: flex;
    width: 100%;
}

@media only screen and (min-width: 1360px){
    .cd__main{
      max-width: 1280px;
      margin-left: auto;
      margin-right: auto; 
      padding: 24px;
    }
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
    <form id="menuForm" action="page.php" method="post" enctype="multipart/form-data">
        <div class="input-container">
            <input type="text" name="text" id="textInput" placeholder="Enter your text" value="<?php echo $name ?>" required>
            <input type="url" name="link" id="linkInput" placeholder="Enter your link" value="<?php echo $link ?>" required>
            <input type="hidden" name="edit">
            <input type="hidden" name="id" value="<?php echo $encodedId?>">
            <input type="hidden" name="token" value="<?php echo $_SESSION["csrfToken"]?>">
            <main class="cd__main">
         <!-- Start DEMO HTML (Use the following code into your project)-->
         <div class="editor-holder">
	<ul class="toolbar">
		<li><a href="#" id="indent" title="Toggle tabs or spaces"><i class="fa fa-indent"></i></a></li>
		<li><a href="#" id="fullscreen" title="Toggle fullscreen mode"><i class="fa fa-expand"></i></a></li>
	</ul>
	<div class="scroller">
		<textarea name ="pagetext" class="editor allow-tabs pagetext">
        <?php
           echo htmlspecialchars($decodedHtmlContent);
            ?>
 </textarea>
		<pre><code class="syntax-highight html pagetext">
            <?php
        //    echo htmlspecialchars($decodedHtmlContent);
            ?>
        </code></pre>
	</div>
</div>
         <!-- END EDMO HTML (Happy Coding!)-->
      </main>
            <input type="submit" value="submit">
        </div>
    </form>
</div>





<script src="https://localhost/ibmspro/ibm/js/textaera.js"></script>

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