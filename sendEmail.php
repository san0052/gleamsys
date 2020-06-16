<?php 
if($_SERVER['REQUEST_METHOD']=="POST"){
	$user_Email = $_POST['email'];
	$mailto ="sangita.d@encoders.co.in,".$user_Email." ";
	$subject = 'Appointment for training from website';
	$message_body = '
	<html>
	<head>
	</head>
	<body>
		<p> Training and Career </p>
		<table width=100% border=1 cellspacing=2 cellpadding=2 bordercolordark=#CCCCCC bordercolorlight=#CCCCCC>
			<tr>
				<td width=40% bgcolor=#CCCCCC>First Name :</td><td width=60% >' . $_POST['name'] . '</td>
			</tr>
			
			<tr>
				<td>Email id :</td><td>' . $_POST['email'] . '</td>
			</tr>
				<td>Phone Number  :</td><td>' . $_POST['mobile'] . '</td>
			</tr>
			<tr>
				<td>Query :</td><td>' . $_POST['query'] . '</td>
			</tr>
			<tr>
				<td>Packages  :</td><td>' . $_POST['package'] . '</td>
			</tr>
		</table>
	</body>
	</html>';

	$headers= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: <info@gleamsys.com>' . "\r\n";

	$send = mail($mailto, $subject, $message_body,$headers);
	if (!$send) {
		echo '<script type="text/javascript">
		alert(" Please try again")
		window.location.replace ("index.html");
		</script>';
	} else {
		echo '<script type="text/javascript">
		alert("Thank you for contacting us.");
		window.location.replace ("index.html");
		</script>';
	}
}