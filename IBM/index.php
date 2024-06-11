<?php

session_start();



// var_dump($_SESSION['last_activity']);
include('global.php');


if (isset($_SESSION['user_id'])) {
    // Redirect to the login page or another appropriate page
    header("Location: login");
    exit();
}

// $_SESSION['last_activity'] = time();


// $sessionExpirationTime = $_SESSION['last_activity'] + (1 * 60);


// $sessioncheck = $chklin->setTimeoutSession($sessionExpirationTime);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $passwordd = $_POST["password"];

    if (!empty($username) && !empty($passwordd)) {
        $chkUser = $chklin->validUser($username, $passwordd);

        if ($chkUser == 1) {
            header("Location: login");
            exit();
        } else {
            // Increment the login attempts
            $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? ($_SESSION['login_attempts'] + 1) : 1;
            // var_dump($_SESSION['login_attempts']);

            if ($_SESSION['login_attempts'] >= 3) {
                // Set a cookie for 10 minutes
                setcookie('login_attempts_exceeded', 'true', time() + 60, '/');
            }
            $error_message = $chkUser;
        }
    }
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="<?php echo $webUrl?>/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Add your CSS styles here -->
</head>
<body>
<div class="login-container">
        <h2>Login</h2>
        <p class="pPass">You can enter password only 4 times</p>
        <p class="pPass">You can reload page only 4 times</p>
<?php
$cookieCheck=$chklin->cookieSetorset();
if($cookieCheck == 1){
    $_SESSION['login_attempts']=0;
 echo '<p id="countdown">1:00</p>';   
}else{
?>

        <form id="loginForm" class="login-form" method="post">
            <input id="username" type="text" name="username" placeholder="Username" required>
            <input id="password" type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        
        <?php
        }
        echo '<p id="message"></p>';
         if (isset($error_message)) { ?>
            <p><?php echo $error_message; ?></p>
        <?php } else{
            echo '<p>Login admin penal</p>';
        }?>
    </div>


<script>
// // Set the session timeout duration in seconds (e.g., 1 minute)
// var sessionTimeout = 60;

// // Check session expiration periodically



// function checkSession() {
//     $.ajax({
//         url: 'ajax_fun.php?page=chksession', // Create a separate PHP file for checking session
//         success: function(response) {
//             if (response === 'expired') {
//                 // Session expired, redirect to login page
//                 window.location.href = 'login.php';
//             }
//         }
//     });
// }

// checkSession();


document.addEventListener('DOMContentLoaded', function () {
      var passwordInput = document.getElementById('password');
      var message = document.getElementById('message');

      setTimeout(function () {
        passwordInput.disabled = true;
        passwordInput.setAttribute('placeholder', 'Expired');
        message.innerHTML = 'Session has expired please reload the page';
      }, 60000); // 60 seconds
    });

    function countdown(elementName, minutes, seconds) {
	var element, endTime, hours, mins, msLeft, time;

	function twoDigits(n) {
		return (n <= 9 ? "0" + n : n);
	}

	function updateTimer() {
		msLeft = endTime - (+new Date);
		if (msLeft < 1000) {
			element.innerHTML = "LETS GO!";
		} else {
			time = new Date(msLeft);
			hours = time.getUTCHours();
			mins = time.getUTCMinutes();
			element.innerHTML = (hours ? hours + ':' + twoDigits(mins) : mins) + ':' + twoDigits(time
																																													 .getUTCSeconds());
			setTimeout(updateTimer, time.getUTCMilliseconds() + 500);
		}
	}

	element = document.getElementById(elementName);
	endTime = (+new Date) + 1000 * (60 * minutes + seconds) + 500;
	updateTimer();
}
//CHANGE TIME (Minutes, Seconds)
countdown("countdown", 1, 00);
</script>
</body>
</html>
