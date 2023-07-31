<html>
<?php
session_start();

if (isset($_SESSION['first_name']) && isset($_SESSION['last_name']) && isset($_SESSION['user_name'])){
echo "<h2>Welcome ".$_SESSION['first_name']." ".$_SESSION['last_name']."!</h2><br>";
echo "username: ".$_SESSION['user_name']."<br><br>";

}


?>

<body>
<a href="login.php">Login</a><br>
    <a href="schedule.php">Registration</a><br>
    <a href="courses.php">View courses</a><br>
    <a href="addclass.php">Add a Class</a><br>
    <a href="sections.php">View sections</a><br>
    <a href="addsection.php">Add a section</a><br>
    <a href="activities.php">Student Clubs</a><br>
    <a href="addactivity.php">Add a Student Club</a><br>
    <form action="index.php" method="post"> 
    <input type="submit" name="logout" value="logout" /> 
    </form>
<?php
if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  header("Location:index.html");
  exit;
}
?>

</body>
</html>
