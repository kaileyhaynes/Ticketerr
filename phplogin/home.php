<?php


session_start();
// If the user is not logged in redirect to the login page
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

?>

<?php echo file_get_contents("html/nav.html"); ?>
<link href="css/contentStyle.css" rel="stylesheet" type="text/css">
	<h2> Dashboard </h2>
	<p>This is the home page; default dashboard blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah</p>
</div>
</body>
</html>