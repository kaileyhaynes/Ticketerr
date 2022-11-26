<!-- pop up form after clicking 'New Ticket' inside home.php -->
<?php echo file_get_contents("html/nav.html"); ?>


<!DOCTYPE html>
<html>

<head>
		<meta charset="utf-8">
		<link href="css/newTicketStyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class = "containerSignUp">
  <div class = "ticket">
    <h1>New Request Ticket Form</h1>
    <!-- the newTicket form -->
    <form action = "newTicketAuthen.php" method = "post">
      <label for="firstName"></label>
      <input type="text" id="firstName" name="firstName" placeholder="Your first name" required>

      <label for="lastName"></label>
      <input type="text" id="lastName" name="lastName" placeholder="Your last name" required>

      <label for="affiliation"></label>
      <select id="affiliation" name="affiliation" placeholder="Choose your affiliation:" required>
        <option value="student">Student</option>
        <option value="staff">Staff</option>
        <option value="faculty">Faculty</option>
      </select>

      <label for="phone"></label>
      <input type="text" id="phone" name="phone" placeholder="Your phone number" required>

      <label for="room"></label>
      <input type="text" id="room" name="room" placeholder="Your office number" required>

      <label for="issue"></label>
      <input type="text" id="issue" name="issue" placeholder="Issue" required>

      <label for="description"></label>
      <input type="text" id="description" name="description" placeholder="Short issue description" required>

      <label for="department"></label>
      <select id="department" name="department" required>
        <option value="unsorted">Unsorted</option>
        <option value="TRACS">TRACS</option>
        <option value="repair">Repair</option>
        <option value="techServices">Technical Services</option>
        <option value="infoServices">Informational Services</option>
        <option value="network">Network</option>
        <option value="systemAdmin">System Administration</option>
        <option value="blackboard">Blackboard</option>
        <option value="programmer">Programmer</option>
        <option value="training">Training/Quick Set-up</option>
      </select>

      <div class = "btn-group">
        <input type="button" onclick="cancel()" value = "Cancel">
        <input type="submit" value="Submit">
      </div>
    </form>
</div>
</div>

<script>
  function cancel() {
    window.location = "home.php";
  }
</script>

</body>
</html>
