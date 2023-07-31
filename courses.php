<!DOCTYPE html>
<html>
<head>
    <style>
        * { font-family: Arial, Helvetica, sans-serif; }
        table { max-width: 900px; margin-left: auto; margin-right: auto; border-collapse: collapse; }
        td, th { border: 1px solid teal; padding: 4px; }
        th { background-color: teal; color: white; font-size: 1.1em; font-weight: bold; }
        table tr:first-child td { border: 0px; font-size: 1.2em; }
        select { font-size: 1.1em; }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>

  <a href="login.php">Login</a><br>
  <a href="schedule.php">Registration</a><br>
  <a href="courses.php">View courses</affirs><br>
    <a href="addclass.php">Add a Class</a><br>
    <a href="sections.php">View sections</a><br>
    <a href="addsection">Add a section</a><br>
    <a href="activities.php">Student Clubs</a><br>
    <a href="addactivity.php">Add a Student Club</a><br>
    <form action="courses.php" method="post"> 
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
$sql = "select * FROM courses";
$sortValue = '';
if (isset( $_GET['sortcourses'])){
  $sortValue = $_GET['sortcourses'];
  switch ($sortValue){
    case 'courseid':
      $sql = "SELECT * FROM courses order by course_id";
      break;
    case 'title':
      $sql = "SELECT * FROM courses order by title";
      break;
      case 'description':
        $sql = "SELECT * FROM courses order by description";
        break;
  }
}

$result = mysqli_query($conn, $sql);

?>
<form name="form1" method="post">
<table>
<tr>
<td colspan="2" align="left">
<a href="addcourse.php"><i class="fas fa-plus-circle"></i> Add Course</a>
</td>
<td colspan="2" align="right">
    Sort by 
    <select  name="sortcourses"  onchange="location.href='courses.php?sortcourses=' + this.value">
    <option value="courseid" <?php if($sortValue=='courseid') echo "selected"?>>
    Course Id</option>
    <option value="title"  <?php if($sortValue=='title') echo "selected"?>>Title</option>
    <option value="description"  <?php if($sortValue=='description') echo "selected"?>>Description</option>
    </select>
</td>
</tr>
<tr><th>Course Id</th><th>Title</th><th>Credit Hrs</th><th>Description</th></tr>
<?php

  $result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row["course_id"]. "</td><td>" . $row["title"]. "</td>" . 
         "<td>" . $row["credit_hrs"]. "</td><td>" . $row["description"]. "</td></tr>";
  }
} else {
  echo "0 results";
}
mysqli_close($conn);
?>
</form></body></html>