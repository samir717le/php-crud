<?php
include("./header.php");
include("./connect.php");

$sql = "SELECT id, firstname, lastname, email FROM users";
$result = $conn->query($sql);
?>

<a href="new.php" class="btn btn-primary">Add New</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<th scope="row">' . $row['id'] . '</th>';
        echo '<td>' . $row['firstname'] . '</td>';
        echo '<td>' . $row['lastname'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td> <a href="delete.php/?id=' . $row["id"] . '" class="btn btn-primary">Delete</a> <a href="edit.php/?id=' . $row["id"] . '" class="btn btn-primary">Edit</a> </td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="4">No results found</td></tr>';
}
$conn->close();
?>
  </tbody>
</table>