<!DOCTYPE html>
<html>
<body>
<a href="login.php">Login</a><br>
    <a href="schedule.php">Registration</a><br>
    <a href="courses.php">View courses</a><br>

    <a href="addclass.php">Add a Class</a><br>
    <a href="sections.php">View sections</a><br>
    <a href="addsection.php">Add a section</a><br>
    <a href="activities.php">Student Clubs</a><br>
    <a href="addactivity.php">Add a Student Club</a><br> 
    <form action="addclass.php" method="post"> 
    <input type="submit" name="logout" value="logout" /> 
    </form>
<?php
    session_start();

if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  header("Location:index.html");
  exit;
}

try{

if (isset($_GET['crn']))    $crn=$_GET['crn'];
if (isset($_GET['semester']))    $semester= $_GET['semester'];
$userid = $_SESSION['user_name'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "it1150";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "insert into registrations (user_id,crn,semester) values('".$userid."','".$crn."','".$semester."')";

if (mysqli_query($conn, $sql)) {
    echo "<h3>New class regestration successful.</h3><br><br>";
    echo "<a href='index.php'>Back to main page.</a><br>";

  } else {
    echo "SQL Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
catch(Exception $e){
 echo "Exception: ". $e->getMessage();
}
  mysqli_close($conn);
?>
</body>
</html>