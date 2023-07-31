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
    <form action="schedule.php" method="post"> 
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
  
  //start session and DB connection
    $userName = "";
    if (isset($_SESSION['user_name']))
      $userName = $_SESSION['user_name'];
    echo "<h1>welcome ".$userName."</h1>";
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
<form name="form1" action="addclass.php" method="GET">
    <table>
    <tr>
        <td colspan="4" align="left">
         <a href="addcourse.php"><i class="fas fa-plus-circle"></i> Add Course</a>
        </td>
         <td colspan="2" align="right">
             <select  name="semester"  ONCHANGE="location = 'schedule.php?semester=' + this.options[this.selectedIndex].value;"'>

             <option value=""> select semester  </option>
             <?php
             // get all semesters from DB and display in select
              $sql = "select distinct semester from sections ";
              $result = mysqli_query($conn, $sql); 
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                echo "<option value=".$row['semester'];
                //mark selected option as selected
                if (isset($_GET['semester'])){
                  if ($_GET['semester']==$row['semester'])
                  echo " selected ";
                }
               echo  ">".$row['semester']."</option>";
              }   
            }
            ?>
            </select>      
         </td>
    </tr>
    <tr>
        <th>CRN</th><th>Course ID</th><th>Title</th><th>Credit Hrs</th><th>Room</th><th>Days</th><th>Times</th><th>Register</th>
    </tr>
    <?php
        try{
        if($userName != ""){
        // display user's registered classes
        $sql = "select reg.crn as crnid,sec.course_id,title,credit_hrs,room,days,times 
                FROM sections as sec 
                join registrations as reg
                on sec.crn = reg.crn 
                join courses as c
                on sec.course_id = c.course_id where user_id ='".$userName."'";        
   
        $result = mysqli_query($conn, $sql);
         if (mysqli_num_rows($result) > 0) {
           while($row = mysqli_fetch_assoc($result)) {
             echo "<tr><td>" . $row["crnid"]. "</td><td>" . $row["course_id"]. "</td><td>" . $row["title"]."</td><td>". 
             $row["credit_hrs"]."</td><td>" . $row["room"]. "</td><td>" . $row["days"]. "</td><td>". $row["times"]."</td><td>registered</td></tr>";
           }
         } 
         else {// display message when no records for classes found.
          if (!isset($_GET['semester']))
          echo "<tr><td>No Registered Classes Found.</td></tr>";
         }
         
         //display courses for the selected semester
         if (isset($_GET['semester'])){
              $semester = $_GET['semester'];
              $allSemCoursesSQL = "select sec.crn as crnid, c.course_id as course_id,title,credit_hrs,
              room,days,times from sections as sec join courses as c on 
              sec.course_id = c.course_id where semester='".$semester."'";
              $allSemCoursesResult= mysqli_query($conn,$allSemCoursesSQL);
              while($row = mysqli_fetch_assoc($allSemCoursesResult)) {
                $crn = $row['crnid'];
                echo "<input type=\"hidden\" id=\"crn\" name=\"crn\" value=".$crn.">";

                echo "<tr><td>".$crn."</td><td>".$row["course_id"]."</td><td>".$row["title"]."<td>".$row["credit_hrs"]."</td>
                <td>".$row["room"]. "</td><td>" . $row["days"]. "</td><td>" . $row["times"]. "</td>";
                //add register button
                echo "<td><input type=\"submit\" value =\"Register\"/></td></tr>";
              }
            }
        }
      else {
        echo "<tr><td colspan='3'> Login requested: <a href='login.php'>Login </td></tr>";

      }
         mysqli_close($conn);
        }
        catch (Exception $e){ echo $sql."<br> error message: ". $e->getMessage();}
         ?>
         </form>
</body>
</html>