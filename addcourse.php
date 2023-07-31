<!DOCTYPE html>
<html>
<head>
<style>
    * { font-family: Arial, Helvetica, sans-serif; }
    table { max-width: 900px; margin-left: auto; margin-right: auto; border-collapse: collapse; }
    td, th { border: 1px solid teal; padding: 4px; }
    th { background-color: teal; color: white; font-size: 1.1em; font-weight: bold; }
    table tr:first-child td { border: 0px; }
</style>
</head>
<body>
<a href="login.php">Login</a><br>
    <a href="schedule.php">Registration</a><br>
    <a href="courses.php">View courses</a><br>
    <a href="addclass.php">Add a Class</a><br>
    <a href="sections.php">View sections</a><br>
    <a href="addsection.php">Add a section</a><br>
    <a href="activities.php">Student Clubs</a><br>
    <a href="addactivity.php">Add a Student Club</a><br> 
    <form action="addcourse.php" method="post"> 
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
?>
<form action="addcourse-submit.php" method="post">
<p>
Course Id<br>
<input type="text" name="courseid" id="courseid">
</p>
<p>
Title<br>
<input type="text" name="title" id="title">
</p>
<p>
Credit Hrs<br>
<input type="text" name="credits" id="credits">
</p>
<p>
Description<br>
<input type="text" name="desc" id="desc">
</p>
<p>
Prerequisites<br>
<input type="text" name="prereq" id="prereq">
</p>
<p>
    <input type="submit" >

</p>
</form>
</body>
</html>