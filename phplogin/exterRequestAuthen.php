
<?php

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

# Validate if the data from the external request form was submitted, isset() will check if the data exists
if ( !isset($_POST['firstName'], $_POST['lastName'])) {
    exit("Please fill both your first and last name!");
} else if ( !isset($_POST['affiliation'])) {
    exit("Please fill in your affiliation!");
} else if ( !isset($_POST['phoneNum'])) {
    exit("Please add your phone number!");
} else if ( !isset($_POST['roomNum'])) {
    exit("Please add your room number!");
} else if ( !isset($_POST['issue'])) {
    exit("Please add the issue!");
} else if ( !isset($_POST['description'])) {
    exit("Please add the issue description!");
}

#VALIDATIONS
# Validate phone to remove any char that are not digits
$str = $_POST['phoneNum'];
$chars = str_split($str);
 
foreach ($chars as $char) {
    if(!is_numeric($char)) {
        #echo $char." is not number";
        $str = str_replace($char, '', $str);
    }
}

#phoneNum (str) is now only 10 digits long
if(strlen($str) != 10) {
    exit("Please add a valid phone number");
}

# Validate office has 2 letters for first two; digits for last three
$officeNum = $_POST['room'];
$firstTwo = array( 'LC', 'JL',
      'LL' , 'SC', 'CC');
      
if(!in_array(substr($officeNum, 0, 2), $firstTwo)) {
    exit("Please enter a valid office number");
}
if (!is_numeric(substr($officeNum, 3)) || strlen($officeNum) != 5) {
    exit("Please enter a valid office number");
}

#~~~~~~

#prepare and bind
$stmt = $con->prepare("INSERT INTO opentickets (callerFirstName, callerLastName, affiliation, phoneNumber, officeNumber, issueName, issueDescription, time, creator) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $firstName, $lastName, $affiliation, $phoneNum, $officeNum, $issueName, $issueDescr, $time, $creator);

#set parameters
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$affiliation = $_POST["affiliation"];
$phoneNum = $str;
$officeNum = $_POST["roomNum"];
$issueName = $_POST["issue"];
$issueDescr = $_POST["description"];
$time = date("Y-m-d H:i:s");
$creator = "EXTERNAL";
    
$stmt->execute();

header('Location: index.html');

$stmt->close();

?>

</body>
</html>