<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Chosen CSS and JS files -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<style>
    .multipleChosen, .multipleSelect2{
  width: 300px;
}
</style>
<body>
<h4>Chosen - Multiple Select</h4>
		<select id="sdjkaklsdjaldj"class="multipleChosen" multiple="true">
        <option value="1">Excellent</option>
        <option value="2">Very Good</option>
        <option value="3">Good</option>
        <option value="4">Not Bad</option>
        <option value="5">Bad</option>
        <option value="6">Very Bad</option>
		</select>	

<script>
    $(document).ready(function(){
  //Chosen
  $(".multipleChosen").chosen({
      placeholder_text_multiple: "What's your rating" //placeholder
	});
})
</script>
</body>
</html>