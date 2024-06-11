// function submitForm() {
//     var username = document.getElementById("username").value;
//     var password = document.getElementById("password").value;

//     // You can add additional validation here

//     // Send data to the server using AJAX or fetch API
//     console.log("Username: " + username + ", Password: " + password);
//     // Here, you would typically send the data to the server for authentication
// }

function showAllMenu() {
    // Hide the input form
    document.querySelector('.input-container').style.display = 'none';
    
    // Show the div containing all menu items
    document.getElementById('allMenu').style.display = 'block';
}
function addMenu() {
    // Hide the input form
    document.querySelector('.input-container').style.display = 'block';
    
    // Show the div containing all menu items
    document.getElementById('allMenu').style.display = 'none';
}

$('input[name="Edit"]').click(function(){
    console.log("hhhh");
    $(this)
    .val(function(i,v){
        return v === 'Edit' ? 'Finished' : 'Edit';
    })
    .prev('textarea[required]')
    .prop('readonly',function(i,r){
        return !r;
    });
});




$(document).ready(function(){
    $(".multipleChosen").chosen({
        placeholder_text_multiple: "Select options",
        search_contains: true
    });
});
//  $(document).ready(function(){
//         // alert("jQuery is working!");
//     });
