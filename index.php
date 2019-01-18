<!DOCTYPE html>
<html>
<head>
	<title>Sending SMS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<table border="1px solid black" width="" align="center">
	<tr><td colspan="2" style="text-align: center;background-color: lightgreen"><h1>Message</h1></td></tr>
<form method="post">
	<tr>
		<td style="padding: 10px;padding-top: 20px;"><label>Mobile Number:</label></td>
		<td style="padding: 10px;padding-top: 20px;"><input type="text" name="num" placeholder="Enter your Mobile Number "></td>
		<br><br>
	</tr>
	<tr>
		<td style="padding: 10px;"><label>Country Code:</label></td>
	    <td style="padding: 10px;"><select name="Code">
		<option value="">SELECT Here...</option>
		<option value="91">India - +91</option>
		<option value="1">USA - +1</option>
		</select></td>
	
	<br><br>
	</tr>
	<tr><td style="padding: 10px;"><label>Enter Message:</label></td>
	<td style="padding: 10px;"><textarea type="text" name="message" cols="40" rows="5" placeholder="Enter your Message"></textarea> </td>
</tr> 
<tr>
<td></td>
<td style="padding: 10px;text-align: right" >
	<button type="button" name="submit" class="btn btn-success btn-md">Send</button>
	</td>
</tr>
</form>
</table>
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



