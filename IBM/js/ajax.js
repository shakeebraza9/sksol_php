
var currentUrl = window.location.href;

// Remove the "login" part from the URL
var webUrl = currentUrl.replace(/\/login(#|$)/, '');


function submitForm(selection=false,menuImageSel =false) {
    // Get form data
    var linkValue = document.getElementById('linkInput').value;
    var textValue = document.getElementById('textInput').value;
    var token = document.getElementById('token').value;
    var imgInput = document.getElementById('imgInput');
    var menuTypeSelect  = document.getElementById('menuType');
    if(selection == true){
    var selectedMenuType = menuTypeSelect.options[menuTypeSelect.selectedIndex].value;
    }
    if(menuImageSel == true){
    var imageData = imgInput.files[0];
    }
    // Create FormData object to send form data
    var formData = new FormData();
    formData.append('link', linkValue);
    formData.append('text', textValue);
    formData.append('token', token);
    if(selection == true){
        formData.append('image', imageData);
    }
    if(menuImageSel == true){
    formData.append('menuType', selectedMenuType);
    }
    formData.append('menu', 'menu');

    // Create XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure it: POST-request for the URL '/submit'
    xhr.open('POST', webUrl+'/pages/menu/menu.php', true);

    // Set up the callback
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                if(xhr.responseText !=0){
                    // console.log(xhr.responseText);
                    showSuccessMessage("Menu");
                }else{
                    showCSRFMessage();
                }
                // showSuccessMessage("Menu");
            } else {
                // Handle any errors here
                console.error('Error:', xhr.status, xhr.statusText);
            }
        }
    };

    // Send the request
    xhr.send(formData);
}
function submitFormBanner(menuImageSel=true) {
    // Get form data    
    var titleValue = document.getElementById('titleInput').value;
    var textValue = document.getElementById('textInput').value;
    var csrfToken = document.getElementById('token').value;
    var comValue = document.getElementById('comment').value;
    var imgInput = document.getElementById('imgInput');
    // var imageData = imgInput.files[0];
    if(menuImageSel == true){
        var imageData = imgInput.files[0];
        }
    console.log(imgInput);

    // Create FormData object to send form data
    var formData = new FormData();
    formData.append('title', titleValue);
    formData.append('comment', comValue);
    formData.append('token', csrfToken);
    formData.append('text', textValue);
    // formData.append('image', imageData);
    if(menuImageSel == true){
        formData.append('image', imageData);
    }
    formData.append('menu', 'menu');
    
    // Create XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    
    // Configure it: POST-request for the URL '/submit'
    xhr.open('POST', webUrl+'/pages/banner/banner.php', true);
    
    // Set up the callback
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                if(xhr.responseText !=0){
                    // console.log(xhr.responseText);
                    showSuccessMessage("Banner");
                }else{
                    showCSRFMessage();
                }
            } else {
                // Handle any errors here
                console.error('Error:', xhr.status, xhr.statusText);
            }
        }
    };

    // Send the request
    xhr.send(formData);
}
function submitPages() {
    // Get form data
    var linkValue = document.getElementById('linkInput').value;
    var textValue = document.getElementById('textInput').value;
    var tokenValue = document.getElementById('token').value;
    var pageInput = document.querySelector('.pagetext').value;

    // Create FormData object to send form data
    var formData = new FormData();
    formData.append('link', linkValue);
    formData.append('text', textValue);
    formData.append('token', tokenValue);
    formData.append('pagetext', pageInput);
    formData.append('page', 'page');
    console.log(webUrl);
    // Create XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure it: POST-request for the URL '/submit'
    xhr.open('POST', webUrl+'/pages/page/page.php', true);

    // Set up the callback
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                if(xhr.responseText !=0){
                    showSuccessMessage("Pages");
                }else{
                    showCSRFMessage();
                }
            } else {
                // Handle any errors here
                console.error('Error:', xhr.status, xhr.statusText);
            }
        }
    };

    // Send the request
    xhr.send(formData);
}

function submitFormGallery() {
    // Get form data
    console.log(webUrl);
    var textValue = document.getElementById('textInput').value;
    var imgInput = document.getElementById('uploadFile');
    var token = document.getElementById('token').value;
    var imageData = imgInput.files[0];
    console.log(token);
    // Create FormData object to send form data
    var formData = new FormData();
    formData.append('text', textValue);
    formData.append('image', imageData);
    formData.append('token', token);
    formData.append('gallery', 'gallery');

    // Create XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure it: POST-request for the URL '/submit'
    xhr.open('POST', webUrl + '/pages/gallery/gallery.php', true);

    // Set up the callback
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Handle the success response
                // console.log(xhr.responseText);
                // showSuccessMessage("Gallery");
                if(xhr.responseText !=0){
                    showSuccessMessage("Gallery");
                }else{
                    showCSRFMessage();
                }
            } else {
                // Handle any errors here
                console.error('Error:', xhr.status, xhr.statusText);
            }
        }
    };

    // Send the request
    xhr.send(formData);
}
function submitFormBlog() {
    // Get form data
    console.log(webUrl);
    var textValue = document.getElementById('textInput').value;
    var dateValue = document.getElementById('dateInput').value;
    var token = document.getElementById('token').value;
    var deatilsValue = document.getElementById('deatils').value;
    var imgInput = document.getElementById('uploadFile');
    var imageData = imgInput.files[0];
    // console.log(imageData);
    // Create FormData object to send form data
    var formData = new FormData();
    formData.append('text', textValue);
    formData.append('date', dateValue);
    formData.append('token', token);
    formData.append('deatils', deatilsValue);
    formData.append('image', imageData);
    formData.append('gallery', 'gallery');

    // Create XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure it: POST-request for the URL '/submit'
    xhr.open('POST', webUrl + '/pages/blog/blog.php', true);

    // Set up the callback
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Handle the success response
                // console.log(xhr.responseText);
                if(xhr.responseText !=0){
                    showSuccessMessage("Blog");
                }else{
                    showCSRFMessage();
                }
            } else {
                // Handle any errors here
                console.error('Error:', xhr.status, xhr.statusText);
            }
        }
    };

    // Send the request
    xhr.send(formData);
}

function showSuccessMessage(name="Menu") {
    // Update the HTML to show the success message
    var successMessage = document.createElement('div');
    successMessage.textContent = name +' added successfully!';
    successMessage.style.color = 'green'; // Customize the color if needed

    // Insert the success message after the form
    var contentDiv = document.querySelector('.content');
    contentDiv.appendChild(successMessage);
}
function showCSRFMessage() {
    // Update the HTML to show the success message
    var successMessage = document.createElement('div');
    successMessage.textContent = 'CSRF Token Invalid.....';
    successMessage.style.color = 'red'; // Customize the color if needed

    // Insert the success message after the form
    var contentDiv = document.querySelector('.content');
    contentDiv.appendChild(successMessage);
}

function deleteRecord(id,page) {
    var confirmDelete = confirm("Are you sure you want to delete this record?");
    
    if (confirmDelete) {
        $.ajax({
            type: "POST",
            url: "pages/"+page+"/delete_record.php", // Replace with your endpoint to delete a record
            data: { id: id },
            dataType: "json", // Adjust data type based on your server response
            success: function(response) {
                if (response.success) {
                    // Optionally, you can update the UI or show a message
                    alert("Record deleted successfully!");
                } else {
                    alert("Error deleting record: " + response.message);
                }
            },
            error: function() {
                // alert("Error deleting record. Please try again.");
                location.reload();
            }
        });
    }
}
function deleteRecordPage(id,page) {
    var confirmDelete = confirm("Are you sure you want to delete this record?");
    
    if (confirmDelete) {
        $.ajax({
            type: "POST",
            url: "pages/"+page+"/delete_record.php", // Replace with your endpoint to delete a record
            data: { id: id },
            dataType: "json", // Adjust data type based on your server response
            success: function(response) {
                if (response.success) {
                    // Optionally, you can update the UI or show a message
                    alert("Record deleted successfully!");
                } else {
                    alert("Error deleting record: " + response.message);
                }
            },
            error: function() {
                // alert("Error deleting record. Please try again.");
                location.reload();
            }
        });
    }
}
function deleteRecordGallery(id,page) {
    var confirmDelete = confirm("Are you sure you want to delete this record?");
    
    if (confirmDelete) {
        $.ajax({
            type: "POST",
            url: "pages/"+page+"/delete_record.php", // Replace with your endpoint to delete a record
            data: { id: id },
            dataType: "json", // Adjust data type based on your server response
            success: function(response) {
                if (response.success) {
                    // Optionally, you can update the UI or show a message
                    alert("Record deleted successfully!");
                } else {
                    alert("Error deleting record: " + response.message);
                }
            },
            error: function() {
                // alert("Error deleting record. Please try again.");
                location.reload();
            }
        });
    }
}
function deleteRecordblog(id,page) {
    var confirmDelete = confirm("Are you sure you want to delete this record?");
    
    if (confirmDelete) {
        $.ajax({
            type: "POST",
            url: "pages/"+page+"/delete_record.php", // Replace with your endpoint to delete a record
            data: { id: id },
            dataType: "json", // Adjust data type based on your server response
            success: function(response) {
                if (response.success) {
                    // Optionally, you can update the UI or show a message
                    alert("Record deleted successfully!");
                } else {
                    alert("Error deleting record: " + response.message);
                }
            },
            error: function() {
                // alert("Error deleting record. Please try again.");
                location.reload();
            }
        });
    }
}


function deleteRecordBanner(id,page) {
    var confirmDelete = confirm("Are you sure you want to delete this record?");
    
    if (confirmDelete) {
        $.ajax({
            type: "POST",
            url: "pages/"+page+"/delete_record.php", // Replace with your endpoint to delete a record
            data: { id: id },
            dataType: "json", // Adjust data type based on your server response
            success: function(response) {
                if (response.success) {
                    // Optionally, you can update the UI or show a message
                    alert("Record deleted successfully!");
                    
                } else {
                    alert("Error deleting record: " + response.message);
                }
            },
            
            error: function() {
                location.reload();
            }
        });
    }
}
function deleteRecordUser(id,page) {
    var confirmDelete = confirm("Are you sure you want to delete this record?");
    
    if (confirmDelete) {
        $.ajax({
            type: "POST",
            url: "pages/"+page+"/delete_record.php", // Replace with your endpoint to delete a record
            data: { id: id },
            dataType: "json", // Adjust data type based on your server response
            success: function(response) {
                if (response.success) {
                    // Optionally, you can update the UI or show a message
                    alert("Record deleted successfully!");
                    
                } else {
                    alert("Error deleting record: " + response.message);
                }
            },
            
            error: function() {
                location.reload();
            }
        });
    }
}