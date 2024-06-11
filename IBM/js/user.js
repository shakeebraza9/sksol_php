function PassNotMatch() {
    // Update the HTML to show the success message
    var successMessage = document.createElement('div');
    successMessage.textContent = 'Password Not Match';
    successMessage.style.color = 'Red'; // Customize the color if needed

    // Insert the success message after the form
    var contentDiv = document.querySelector('.content');
    contentDiv.appendChild(successMessage);
}
function userAddsuc() {
    // Update the HTML to show the success message
    var successMessage = document.createElement('div');
    successMessage.textContent = 'User added successfully!';
    successMessage.style.color = 'green'; // Customize the color if needed

    // Insert the success message after the form
    var contentDiv = document.querySelector('.content');
    contentDiv.appendChild(successMessage);
}
function showError() {
    // Display error message
    alert('Error: user already exists');
}



// function chkUser() {
//     // Get form data    
//     var nameInput = document.getElementById('nameInput').value;
//     var genderValue = document.getElementById('option-1').value;
//     var emailInput = document.getElementById('emailInput').value;
//     var phoneInput = document.getElementById('phoneInput').value;
//     var cityInput = document.getElementById('cityInput').value;
//     var counterInput = document.getElementById('counterInput').value;
//     var address = document.getElementById('address').value;
//     var password = document.getElementById('password').value;
//     var rePassword = document.getElementById('rePassword').value;
    
//     if (
//         nameInput.trim() === '' ||
//         !genderValue ||
//         emailInput.trim() === '' ||
//         cityInput.trim() === '' ||
//         counterInput.trim() === '' ||
//         address.trim() === '' ||
//         password.trim() === '' ||
//         rePassword.trim() === ''
//     ) {
//         // Display an error message or perform any necessary actions
//         alert('Please fill in all fields.');
//     } else {
//         // All fields are filled, continue with your code
//         // ...
    
//     // Create FormData object to send form data
//     var formData = new FormData();
//     formData.append('name', nameInput);
//     formData.append('gender', genderValue);
//     formData.append('email', emailInput);
//     formData.append('phone', phoneInput);
//     formData.append('city', cityInput);
//     formData.append('count', counterInput);
//     formData.append('address', address);
//     formData.append('pass', password);
//     formData.append('repass', rePassword);
 
    
//     // Create XMLHttpRequest object
//     var xhr = new XMLHttpRequest();
//     if(password == rePassword){
//     // Configure it: POST-request for the URL '/submit'
//     xhr.open('POST', '/ibm/pages/user/user.php', true);
    
//     // Set up the callback
//     xhr.onreadystatechange = function () {
//         if (xhr.readyState == 4) {
//             if (xhr.status == 200) {
//                 // Handle the success response
//                 console.log(xhr.responseText);
//                 console.log(xhr.status);
                
//                 userAddsuc();
//             } else {
//                 // Handle any errors here
//                 console.error('Error:', xhr.status, xhr.statusText);
//             }
//         }
//     };

//     // Send the request
//     xhr.send(formData);
// }else{
//     PassNotMatch();
// }
//     }
// }
var currentUrl = window.location.href;

// Remove the "login" part from the URL
var webUrl = currentUrl.replace(/\/login(#|$)/, '');
function chkUser() {
    // Get form data    
    var nameInput = document.getElementById('nameInput').value;
    var genderValue = document.getElementById('option-1').value;
    var permissionType = document.getElementById('permissionType').value;
    var emailInput = document.getElementById('emailInput').value;
    var phoneInput = document.getElementById('phoneInput').value;
    var cityInput = document.getElementById('cityInput').value;
    var counterInput = document.getElementById('counterInput').value;
    var address = document.getElementById('address').value;
    var password = document.getElementById('password').value;
    var rePassword = document.getElementById('rePassword').value;
    
    if (
        nameInput.trim() === '' ||
        !genderValue ||
        emailInput.trim() === '' ||
        permissionType.trim() === '' ||
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
            // Create FormData object to send form data
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
            // xhr.open('POST', webUrl+'/pages/user/user.php', true);
            xhr.open('POST','http://localhost/portfolio/ibm/pages/user/user.php', true);
            
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




