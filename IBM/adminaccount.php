<?php
include('global.php');
    // if ($chklin->isLoggedIn() != 1) {
    //     header("Location: ../../login");
    // }
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


            <input type="Email" id="emailInput" placeholder="Enter your Email" required>
            

            <br>
            <br>
            <input type="password" id="password" placeholder="Enter your Password" required>
            <input type="password" id="rePassword" placeholder="Retype Password" required>
            <button onclick="usercrt()">Submit</button>
        </div>
        

    </div>
    <Script>
        function usercrt() {
    // Get form data    
    var nameInput = document.getElementById('nameInput').value;
    var genderValue = "male";
    var permissionType = 1;
    var emailInput = document.getElementById('emailInput').value;
    var phoneInput = "00000000";
    var cityInput = "karachi";
    var counterInput = "Pakistan";
    var address = "Null ";
    var password = document.getElementById('password').value;
    var rePassword = document.getElementById('rePassword').value;
    
    if (
        nameInput.trim() === '' ||
        !genderValue ||
        emailInput.trim() === '' ||
        // permissionType.trim() === '' ||
        cityInput.trim() === '' ||
        counterInput.trim() === '' ||
        address.trim() === '' ||
        password.trim() === '' ||
        rePassword.trim() === ''
    ) {
        // Display an error message or perform any necessary actions
        alert('Please fill in all fields.');
    } else {
        // All fields are filled, continue with your code
    
        // Check if passwords match
        if (password == rePassword) {

            var formData = new FormData();
            formData.append('name', nameInput);
            formData.append('gender', genderValue);
            formData.append('permissionType', permissionType);
            formData.append('email', emailInput);
            formData.append('phone', phoneInput);
            formData.append('city', cityInput);
            formData.append('count', counterInput);
            formData.append('address', address);
            formData.append('pass', password);
            formData.append('repass', rePassword);
            
            // Create XMLHttpRequest object
            var xhr = new XMLHttpRequest();
            
            // Configure it: POST-request for the URL '/ibm/pages/user/user.php'
            xhr.open('POST', 'http://localhost/portfolio/ibm/admin.php', true);
            
            // Set up the callback
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        // Handle the success response
                        console.log(xhr.responseText);
                        
                        // Assuming the response contains '0' for error and '1' for success
                        if (xhr.responseText.trim() == '0') {
                            // Show error message
                            showError();
                        } else {
                            // Show success message
                            userAddsuc();
                        }
                    } else {
                        // Handle any errors here
                        console.error('Error:', xhr.status, xhr.statusText);
                    }
                }
            };
    
            // Send the request
            xhr.send(formData);
        } else {
            // Passwords don't match, show an error message
            PassNotMatch();
        }
    }
}
    </Script>
</body>
</html>
