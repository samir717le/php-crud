<?php 
include("./header.php");
include("./connect.php");

// Ensure the 'id' parameter exists and is a valid number
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("Invalid ID");
}

$id = $_GET["id"];

// Use a prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$result) {
    die("User not found");
}

if (isset($_POST["submit"])) {
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $email = $_POST["email"];

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE `users` SET `firstname`=? ,`lastname`=? ,`email`= ? WHERE id = $id");
    $stmt->bind_param("sss", $fname, $lname, $email);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Edit Successful</div>';
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
    <input type="text" class="form-control" id="fname" name="firstname" value="<?php echo htmlspecialchars($result['firstname'], ENT_QUOTES, 'UTF-8'); ?>">
  </div>
  
  <div class="mb-3">
    <label for="lastname" class="form-label">Last Name: </label>
    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($result['lastname'], ENT_QUOTES, 'UTF-8'); ?>">
  </div>
  
  <div class="mb-3">
    <label for="email" class="form-label">Email: </label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($result['email'], ENT_QUOTES, 'UTF-8'); ?>">
  </div>
  
  <input type="submit" class="btn btn-primary" name="submit" value="submit">
</form>
<a href="/" class="btn btn-primary">Go Back</a>