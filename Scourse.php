<?php

session_start();
$sid = $_SESSION['sid'];

?>
<?php $id = $_GET['id'];?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Comptible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="cssCourse.css">


    <title>course</title>

</head>
<body>

<div class="side-menu">
    <div class = "HappyGrade">
        <h1>HappyGrade</h1>
    </div>
    <ul>


        <li><img src="home.png" alt="">&nbsp; Home</li>
        <li><img src="dashboard.png" alt="">&nbsp; Dashboard</li>
        <li><img src="calendar.png" alt="">&nbsp; Calendar</li>
        <li><img src="online-course.png" alt="">
            My Course</li>
        <li><img src="user.png" alt="">&nbsp;Profile</li>
        <li> <a     <?php if ($id==88997) {?> href="Group_chat.php" <?php }?>
                <?php if ($id==99221) {?> href="Group_chat1.php" <?php }?>>CHAT</a></li>


    </ul>
</div>
<div class="container">
    <div class="header">
        <div class="nav">
            <div class="search">
                <!--  <img src="search.png" alt="">-->
                <input type="text" placeholder="Search...">

            </div>
            <div class="user">


                <h4 style="color:White;"> <i> Welcome to the course </i> </h4>


            </div>
        </div>
    </div>
</div>

<div class="w3-container">
    <h1  style="padding-top: 150px" >  Course Name</h1>
    <p style="color:#85929E" >  Material  </p>
</div>

<div class="w3-container w3-red">
    <h1 style="padding-top: 20px"> Assignments </h1>
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "happygrades";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT `link` FROM `assistantcourses` WHERE `courseID`=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "Link: " . $row["link"] ." <br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();


    ?>


</div>
<div class="w3-container w3-red">

    <h1 style="padding-top: 20px" > Grades </h1>
    <title>Table with database</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            color: #588c7e;
            font-family: monospace;
            font-size: 25px;
            text-align: left;
        }
        th {
            background-color: #588c7e;
            color: white;
        }
        tr:nth-child(even) {background-color: #f2f2f2}
    </style>
    </head>
    <body>
    <table>
        <tr>
            <th>Assigment_Name</th>
            <th>Grade</th>
            <th>Weight</th>
        </tr>
        <?php
        $db = mysqli_connect("localhost", "root", "", "happygrades");

        $records = mysqli_query($db,"select * from grades where  `courseid`='" . $id . "' and `studentid`='" . $sid . "' "); // fetch data from database

        while($data = mysqli_fetch_array($records))
        {
            ?>
            <tr>

                <td><?php echo $data['assignmentname']; ?></td>
                <td><?php echo $data['grade']; ?></td>
                <td><?php echo $data['weight']; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>

    <?php mysqli_close($db); // Close connection ?>


</div>



<p></p>
</body>
</html>

