<?php
include("./connect.php");


if (isset($_GET["id"])) {
    $id = $_GET['id'];
    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM `users` WHERE id = $id");

    if ($stmt->execute()) {
        
      header('location: /');
        
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>