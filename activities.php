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
    <a href="courses.php">View courses</a><br>

    <a href="addclass.php">Add a Class</a><br>
    <a href="sections.php">View sections</a><br>
    <a href="addsection.php">Add a section</a><br>
    <a href="activities.php">Student Clubs</a><br>
    <a href="addactivity.php">Add a Student Club</a><br> 
    <form action="activities.php" method="post"> 
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

    //start DB connection
    $userName = "";
    if (isset($_SESSION['user_name'])){
        $userName = $_SESSION['user_name'];
        echo "<h1>welcome ".$userName."</h1>";
    }   else{
        "Login Required.";
    }
    $servername = "localhost";
    $connusername = "root";
    $password = "";
    $dbname = "it1150";

    $conn = mysqli_connect($servername, $connusername, $password, $dbname);
    // Check connection
    if (!$conn) {
         die("Connection failed: " . mysqli_connect_error());
    }     
?>
<table>
<tr>
<td colspan="2" align="left">
<a href="addactivity.php"><i class="fas fa-plus-circle"></i> Add club</a>
</td>
</tr>
<tr><th>Clubs</tr>
    <?php
             // get all activities from DB and display in select
             try{
              $sql = "select * from clubmembers join clubs on clubmembers.club_id = clubs.club_id
                        where user_id ='".$userName."'";
              $result = mysqli_query($conn, $sql); 
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) { 
                    echo "<tr><td>" . $row["title"]. "</td></tr>";
                } 
                }
              else{
                    echo ("No clubs found.");
                }
            }
            catch (Exception $e){
                echo "Exception Error: ". $e->getMessage();
            }
            ?>
     
</table>
</body>
</html>