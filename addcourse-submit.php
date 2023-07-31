<?php

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

$sql = "insert into courses (course_id,title,credit_hrs,description) values('".$_POST['courseid']."','".$_POST['title']."',".$_POST['credits'].",'".$_POST['desc']."')";
if (mysqli_query($conn, $sql)) {
    echo "New course created successfully.<br>";
    echo "<a href='//localhost/Lab11/addcourse.php'>Add another course</a><br>";
    echo "<a href='//localhost/Lab11/courses.php'>Back to courses list</a>";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  
  mysqli_close($conn);


?>