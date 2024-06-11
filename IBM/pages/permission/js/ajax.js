var currentUrl = window.location.href;
var webUrl = currentUrl.replace(/\/index(#|$)/, '');
function submitForm() {
    var textValue = document.getElementById('textInput').value;
    var csrf_token = document.getElementById('csrf_token').value;
    var menuTypeSelect = document.getElementById('menuType');
    var selectedMenuTypes = Array.from(menuTypeSelect.selectedOptions).map(option => option.value);


    console.log("textValue:", textValue);
    console.log("selectedMenuTypes:", selectedMenuTypes);

    var formData = new FormData();
    formData.append('text', textValue);
    formData.append('csrfToken', csrf_token);

    formData.append('menuTypes', JSON.stringify(selectedMenuTypes));

    var xhr = new XMLHttpRequest();
    xhr.open('POST', webUrl + '/permission.php', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // showSuccessMessage();
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

function deleteRecordPermission(id) {
    var confirmDelete = confirm("Are you sure you want to delete this record?");
    
    if (confirmDelete) {
        $.ajax({
            type: "POST",
            url: "delete_record.php", // Replace with your endpoint to delete a record
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
function showCSRFMessage() {
    // Update the HTML to show the success message
    var successMessage = document.createElement('div');
    successMessage.textContent = 'CSRF Token Invalid.....';
    successMessage.style.color = 'red'; // Customize the color if needed

    // Insert the success message after the form
    var contentDiv = document.querySelector('.content');
    contentDiv.appendChild(successMessage);
}
function showSuccessMessage() {
    // Update the HTML to show the success message
    var successMessage = document.createElement('div');
    successMessage.textContent = 'Permission added successfully!';
    successMessage.style.color = 'green'; // Customize the color if needed

    // Insert the success message after the form
    var contentDiv = document.querySelector('.content');
    contentDiv.appendChild(successMessage);
}