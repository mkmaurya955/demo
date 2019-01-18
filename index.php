<!DOCTYPE html>
<html>
<head>
	<title>Sending SMS using PHP</title>
</head>
<body>

<form method="post">
	<label>Mobile Number</label>
	<input type="text" name="num">
	<br><br>
	<label>Country Code</label>
	<select name="Code">
		<option value="">SELECT Here...</option>
		<option value="91">India - +91</option>
		<option value="1">USA - +1</option>
	</select>
	<br><br>
	<label>Enter Message</label>
	<input type="text" name="message">

	<input type="submit" name="submit">

</form>

</body>
</html>

<?php

	if (isset($_POST["submit"])) {
		
	
	// Authorisation details.
	$username = "mkmaurya955@gmail.com";
	$hash = "8fd952315bfab4d8f83b37356f301444da4431873c9411b908629234730f03e9";

	// Config variables. Consult http://api.textlocal.in/docs for more info.
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = "TXTLCL"; // This is who the message appears to be from.
	$numbers = $_POST["Code"] . $_POST["num"]; // A single number or a comma-seperated list of numbers
	$message = $_POST["message"];
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	curl_close($ch);

	if (!$result) {
		?>
		<script>alert('message not sent!')</script>
	<?php
}
else{
	#print the final result
	echo $result;
?>
<script>alert('message sent!')</script>
<?php
}
}
?>



