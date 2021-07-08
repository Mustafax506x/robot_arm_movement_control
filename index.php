<html>
    <head>
        <title>Robot Controller</title>
        <script src="jQuery"></script>
        <script src="javascript.js"></script>
        <link rel="stylesheet" href="style.css">  
    </head>
    <body>
    <h1>Controller</h1>
        <form class="arm" method="POST">
            <div class = sliders>
                <p>Engine1:</p>
            <input type="range" min="0" max="180" value="90" class="slider" id="Range1" name= "Range1">
        <p class= value>Value: <span class= "v"id ="value1"></span>°</p>
                <p>Engine2:</p>
            <input type="range" min="0" max="180" value="90" class="slider" id="Range2" name= "Range2">
        <p class= value>Value: <span class= "v"id ="value2"></span>°</p>
                <p>Engine3:</p>
            <input type="range" min="0" max="180" value="90" class="slider" id="Range3" name= "Range3">
        <p class= value>Value: <span class= "v"id ="value3"></span>°</p>
                <p>Engine4:</p>
            <input type="range" min="0" max="180" value="90" class="slider" id="Range4" name= "Range4">
        <p class= value>Value: <span class= "v"id ="value4"></span>°</p>
                <p>Engine5:</p>
            <input type="range" min="0" max="180" value="90" class="slider" id="Range5" name= "Range5">
        <p class= value>Value: <span class= "v"id ="value5"></span>°</p>
            <div class=buttons>
        <input type="radio" id="status" name="status" value="1" checked>
        <label for="status"> Run </label><br>
        <input type="radio" id="status" name="status" value="0">
        <label for="vehicle2"> Stop </label><br>
        <input class= "button" type="submit" value="Save" name="submit">
    </div>
    </div>
    <script src="projectjs.js"></script>

<?php
if (isset($_POST['submit'])) {
$id = 1;
$degree1     = $_POST["Range1"];
$degree2     = $_POST["Range2"];
$degree3     = $_POST["Range3"];
$degree4     = $_POST["Range4"];
$degree5     = $_POST["Range5"];
$status = $_POST["status"];
$degree      = array ($degree1, $degree2, $degree3, $degree4, $degree5);
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "db1";
for($i = 0; $i < 5 ; $i++){
$conn = new mysqli ($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die ("Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE `arm` SET `degree`='$degree[$i]',`status`='$status' WHERE id = $id";
if ($conn -> query($sql) === true){
}    else{
        echo"Error: ". $sql . "<br>" . $conn->error;
    }
$conn->close();
$id++;
}
    echo "<h3>Submit seccess <br><br> The new instructions are:<br> <br>Engine1 :  <span>$degree1&#176</span><br>Engine2 :  <span>$degree2&#176</span><br>Engine3 :  <span>$degree3&#176</span><br>Engine4 :  <span>$degree4&#176</span><br>Engine5 :  <span>$degree5&#176</span><h3>";
}
?>

        </form>
        <h1>Motion Control</h1>
        <form class="base"method="POST" id= "my-form">
        <div>
        <input class= "button" type="submit" id="Forward" value="Forward" name="Forward" ></input>
        <br>
        <input class= "button" type="submit" id="Right" value="  Right  " name="Right"></input>
        <input class= "button" type="submit" id="Stop" value="   Stop   " name="Stop"></input>
        <input class= "button" type="submit" id="Left" value="  Left  " name="Left"></input>
        <br>
        <input class= "button" type="submit" id="Backward" value="Backward" name="Backward"></input>
        </div>
    </form>
    </body>
    <script>
        function ajaxgo(){
var xhr = new XMLHttpRequest();
xhr.open ("POST", "action.php")
xhr.onload = function(){
    console.log(this.response);
};
xhr.send(data);
return false;
}
    </script>
</html>

<?php
if (isset($_POST['Forward'])||isset($_POST['Right'])||isset($_POST['Stop'])||isset($_POST['Left'])||isset($_POST['Backward'])) {
$id=0;
$direction = '';
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "db1";
$conn = new mysqli ($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die ("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['Forward'])) {
    $direction='f';
    echo "<h2>Moving: <span>Forward</span></h2>";
}
elseif (isset($_POST['Right'])) {
    $direction='r';
    echo "<h2>Moving: <span>Right</span></h2>";
}
elseif (isset($_POST['Stop'])) {
    $direction='s';
    echo "<h2><span>Stop</span></h2>";
}
elseif (isset($_POST['Left'])) {
    $direction='l';
    echo "<h2>Moving: <span>Left</span></h2>";
}
elseif (isset($_POST['Backward'])) {
    $direction='b';
    echo "<h2>Moving: <span>Backwardward</span></h2>";

}
$sql = "UPDATE `base` SET `direction`='$direction' WHERE id = $id";
if ($conn -> query($sql) === true){
}    else{
        echo"Error: ". $sql . "<br>" . $conn->error;
    }
$conn->close();
}
?>