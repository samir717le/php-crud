<?php
include("connect.php");
include("./header.php");

if (isset($_POST["submit"])) {
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $email = $_POST["email"];

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO `users`(`firstname`, `lastname`, `email`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fname, $lname, $email);

    if ($stmt->execute()) {
        
        echo '<div class="alert alert-success">Added Successful</div>';
        
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<form method="post">
  <div class="mb-3">
    <label for="firstname" class="form-label">First Name: </label>
    <input type="text" class="form-control" id="fname" aria-describedby="emailHelp" name="firstname">
  </div>
  
  <div class="mb-3">
    <label for="lastname" class="form-label">Last Name: </label>
    <input type="text" class="form-control" id="lastname" name="lastname">
  </div>
  
  <div class="mb-3">
    <label for="email" class="form-label">Email: </label></label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  
  <input type="submit" class="btn btn-primary" name="submit" value="submit">
</form>
<a href="/" class="btn btn-primary">Go Back</a>