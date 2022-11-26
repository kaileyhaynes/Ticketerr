<?php

/* retrieve the all users' account details from SQL database
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

?>


<?php echo file_get_contents("html/nav.html"); ?>
<link href="css/contentStyle.css" rel="stylesheet" type="text/css">
    <h2>Agents</h2>
    <p>All ITS employee details are below:</p>
	<?php
	# retrieve personal info from accounts database, first entry
	$stmt = "SELECT id, email, firstName, lastName, LNum FROM accounts";
	$result = $con->query($stmt);
		#query through each row
		while ($row = $result->fetch_assoc()) {
				echo "<table>";
				//output a row here
				echo "<tr>";
				echo "<td> Name: </td>";
				echo "<td>", $row["firstName"], " ", $row["lastName"],"</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>Email:</td>";
					echo "<td>", $row["email"], "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>L Number:</td>";
					echo "<td>";
						if ($row["LNum"] == NULL) {
							$row["LNum"] = "Not available";
						}
						echo $row["LNum"];
					echo "</td>";
				echo "</tr>";
				echo "</table>";
			echo "<br>";
		}
	?>
</div>
</body>
</html>