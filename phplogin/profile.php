<?php

/* retrieve the user's account details from SQL database
and display details with PHP and HTML */

session_start();

# If the user is not logged in redirect to the login page.
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
# retrieve personal info from accounts database
$stmt = $con->prepare('SELECT password, email, firstName, lastName, LNum FROM accounts WHERE id = ?');
# Use the account ID to get the account info
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email, $firstName, $lastName, $LNum);
$stmt->fetch();
$stmt->close();

?>

<?php echo file_get_contents("html/nav.html"); ?>
<link href="css/contentStyle.css" rel="stylesheet" type="text/css">
	<h2>Profile</h2>
	<p>Your account details are below:</p>
		<table>
			<tr>
				<td>Name:</td>
				<td><?=$firstName, " ", $lastName?></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><?=$email?></td>
			</tr>
			<tr>
				<td>L Number:</td>
				<td>
					<?php
					if ($LNum == NULL) {
						$LNum = "Not available";
					}
					echo $LNum;
					?>
				</td>
			</tr>
			<tr>
				<td>Username:</td>
				<td><?=$_SESSION['name']?></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><?=$password?></td>
			</tr>
		</table>

</div>
</body>
</html>
