


<?php

#echo file_get_contents("signUpForm.html");


#signup verification

session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';

# Try to connect
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	# If there is an error with the connection, stop the script and display the error
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

# Validate if the data from the login form was submitted, isset() will check if the data exists
if ( !isset($_POST['username'], $_POST['password']) ) {
	exit("Please fill both the username and password fields!");
} else if ( !isset($_POST['firstName'], $_POST['lastName'])) {
    exit("Please fill both your first and last name!");
} else if ( !isset($_POST['email'])) {
    exit("Please fill the email field!");
} else if ( !isset($_POST['LNum'])) {
    exit("Please add your L number!");
}


#VALIDATIONS
#email @lander.edu
$length = strlen($_POST['email']);
$emailpos = strpos($_POST['email'], "@lander.edu");
if($emailpos === false) {
    echo '<script type="text/javascript">';
    echo 'alert("Wrong email bro")';
        #signUpError("Please enter a valid Lander University email address");
    echo '</script>';
    #exit("Please enter a valid Lander University email address");
}
#make sure it's the last part of email
else if($emailpos == 0 || substr($_POST['email'], $length - 1) != "u") {
    $error = "Make sure that your email address is formatted properly \n EX) kailey.haynes@lander.edu";
    exit($error);
}

#LNum
if(strlen($_POST['LNum']) != 8 || !is_numeric($_POST['LNum'])) {
    exit("Your L number must be only 8 digits");
}

#CHECK DATABASE FOR IDENTICAL INFO
$stmt = "SELECT username, password, email, LNum FROM accounts";
$result = $con->query($stmt);
while ($row = $result->fetch_assoc()) {
    #search for idential username
    if($row["username"] == $_POST["username"]) {
        exit("That username is already taken. Create a new username.");
        sleep(5);
        header('signUpForm.html');
    }
    #search for idential password
    if(password_verify($_POST['password'], $row["password"])) {
        exit("That password is already taken. Create a new password.");
    }
    #search for idential email
    if($row["email"] == $_POST["email"]) {
        exit("That email address is already used. Please use a different email address.");
    }
    #search for idential LNum
    if($row["LNum"] == $_POST["LNum"]) {
        exit("That L number is already used. Please enter your L Number.");
    }
}

#prepare and bind
$stmt = $con->prepare("INSERT INTO accounts (username, password, email, firstName, lastName, LNum) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssi", $username, $password, $email, $firstName, $lastName, $LNum);

#set parameters
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$username = $_POST["username"];
$LNum = $_POST["LNum"];

if ($LNum == NULL) {
    $LNum = NULL;
}

#make and store the hash of a password
$password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    
#first and last name capitalization
$firstName = ucfirst($firstName);
$lastName = ucfirst($lastname);
    
$stmt->execute();

#echo "Account successfully made!";
header('Location: index.html');

$stmt->close();

?>

</body>
</html>