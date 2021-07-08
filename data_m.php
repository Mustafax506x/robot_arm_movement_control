<?php
$id = 0;
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "db1";
$conn = new mysqli ($servername, $username, $password, $dbname);
$sql = "SELECT direction FROM base WHERE id = $id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo $row["direction"]. "<br>";
    }
} else {
    echo "0 results";
}
mysqli_close($conn);
?>