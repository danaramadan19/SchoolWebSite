
<?php
session_start();
$tid= $_SESSION['tid'];

?>
<?php if(isset($_GET['id'])) $id = $_GET['id'];?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Comptible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="style3.css">


    <title>course
    </title>



    <?php


    ?>


</head>

<!----------Side menu start----------------------->
<div class="side-menu">
    <div class = "HappyGrade">
        <h1>HappyGrade</h1>
    </div>
    <ul>
        <a href="teacherPage.php" >   <li><img src="dashboard%20(2).png" alt="">&nbsp; Dashboard</li></a>
        <li><img src="teacher2.png" alt="">&nbsp;<a style="color: white;" href="assignment.php">Assignment</a></li>
        <li><img src="reading-book%20(1).png" alt="">&nbsp;Students</li>
        <li><img src="school.png" alt="">&nbsp;Events</li>

        <li><img src="help-web-button.png" alt="">&nbsp;Help</li>
        <li><img src="settings.png" alt="">&nbsp;Profile</li>
        <li> <a     <?php  if(isset($_GET['id'])){if($id==88997); {?> href="Group_chat.php" <?php }}?>
                <?php if(isset($_GET['id'])){if($id==99221); {?> href="Group_chat1.php" <?php }}?>>CHAT</a></li>
        <li >Log Out</li>
    </ul>
</div>
<!----------Side menu end----------------------->

<!----------Header Bar: i suggest uo to make it as a news bar,,,just to remember------------------->
<div class="container">
    <div class="header">
        <div class="nav">
            <div class="search">
                <input type="text" placeholder="Search..">
            </div>
            <div class="user">
                <h4>Welcome to course dashboard</h4>
            </div>
        </div>
    </div>
    <!----------End header card----------------------->

    <div class="content">
        <div class="cards">
            <div class="card">
                <div class="box">
                    <img src="books.png">
                </div>
            </div>

            <!----------Clock card start----------------------->
            <div class="card">
                <div class="box">
                    <body onload="initClock()">
                    <!--digital clock start-->
                    <div class="datetime">
                        <div class="date">
                            <span id="dayname">Day</span>,
                            <span id="month">Month</span>
                            <span id="daynum">00</span>,
                            <span id="year">Year</span>
                        </div>
                        <div class="time">
                            <span id="hour">00</span>:
                            <span id="minutes">00</span>:
                            <span id="seconds">00</span>
                            <span id="period">AM</span>
                        </div>

                    </div> <!--digital clock end-->

                    <script type="text/javascript">
                        function updateClock(){
                            var now = new Date();
                            var dname = now.getDay(),
                                mo = now.getMonth(),
                                dnum = now.getDate(),
                                yr = now.getFullYear(),
                                hou = now.getHours(),
                                min = now.getMinutes(),
                                sec = now.getSeconds(),
                                pe = "AM";

                            if(hou >= 12){
                                pe = "PM";
                            }
                            if(hou == 0){
                                hou = 12;
                            }
                            if(hou > 12){
                                hou = hou - 12;
                            }

                            Number.prototype.pad = function(digits){
                                for(var n = this.toString(); n.length < digits; n = 0 + n);
                                return n;
                            }

                            var months = ["January", "February", "March", "April", "May", "June", "July", "Augest", "September", "October", "November", "December"];
                            var week = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                            var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
                            var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
                            for(var i = 0; i < ids.length; i++)
                                document.getElementById(ids[i]).firstChild.nodeValue = values[i];
                        }

                        function initClock(){
                            updateClock();
                            window.setInterval("updateClock()", 1);
                        }
                    </script>
                    </body>
                </div>
            </div>
            <!----------Clock card End----------------------->
            <div class="card">
                <div class="box">
                    <img src="graduated.png">
                </div>
            </div>

        </div>

        <div class="content-2">
            <div class="marks">
                <div class="title">
                    <h3>Students Marks</h3>
                    <label >  ||||  </label>
                    <Strong for="assi"> Choose the assignment:</Strong>
                    <form action='teachergrade.php' method='post'>
                        <select name="assi" id="assi">
                            <?php
if(isset($_GET['id'])){
    $link2=$_GET['id'];
    $_SESSION['cid']=$link2;
}
else{
    $link2= $_SESSION['cid'];
}

                            $db =  new mysqli('localhost', 'root', '', 'happygrades');
                            $r=1;
                            $result=$db->query("select * from  assistantcourses where `courseID`='" . $link2 . "' and `teacherid`='" . $tid . "' ");
                            for($i=0;$i<$result->num_rows;$i++)
                            {
                                $row=$result->fetch_assoc();

                                echo"<option value='".$r."' name='n'>".$row['assignmentname']." ".'weight='.$row['weight']."</option>";
                                $r=$r+1;

                            }
                            ?>


                        </select>
                   <td><button type='submit' class='btn2'>choose</button></td>


                </div>
                <!----------table rows Start----------------------->

                <table>
                    <tr>
                        <th>Student Name</th>
                        <th>Mark</th>



                        <th>Total Average%</th>
                        <th>Total Weight</th>
                    </tr>

                    <?php
               
            //   $num = 0;
             //      $num = $_SESSION['num'];
                
                    if (isset($_POST['e'])) {

                        $cid = $_SESSION['cid'];

                        $m = 0;
                        $db = new mysqli('localhost', 'root', '', 'happygrades');
                        $result = $db->query("select * from  SCourses where `courseid`='" . $cid . "'  ");
                        $aname = "Assignment#" . $_POST['e'];
                        for ($i = 0; $i < $result->num_rows; $i++) {
                            $row = $result->fetch_assoc();
                            $sid = $row['studentid'];
                            $db = new mysqli('localhost', 'root', '', 'happygrades');
                            $db->query("UPDATE `grades`  SET `grade`='" . $_POST[$m] . "'  where `courseid`='" . $cid . "'and  `studentid`='" . $sid . "' and  `assignmentname`='" . $aname . "'");
                            $m = $m + 1;
                        }
                    }


                   else if(isset($_POST['assi'])) {

                      $cid= $_SESSION['cid'] ;
                        $db = new mysqli('localhost', 'root', '', 'happygrades');
                        $result = $db->query("select * from  SCourses where `courseid`='" . $cid . "'  ");

                        $num = 0;
                        $aname = "Assignment#" . $_POST['assi'];
                        $result2 = $db->query("select * from  grades where `courseid`='" . $cid . "' and  `assignmentname`='" . $aname . "'");

                            for ($i = 0; $i < $result->num_rows; $i++) {
                                $w=0;
                                $row2 = $result2->fetch_assoc();
                                $row = $result->fetch_assoc();
                                $avg=0;
                                echo "<tr>";
                                echo "<td>" . $row['studentname'] . "</td>";
                                $resultavg = $db->query("select * from  grades where `courseid`='" . $cid . "' and  `studentname`='" .$row['studentname']. "'");
                                for ($j = 0; $j< $resultavg->num_rows; $j++) {

                                    $rowavg = $resultavg->fetch_assoc();
                                    $w=$w+$rowavg['weight'];
                                    $avg=  $avg+$rowavg['grade'];
                                }
                                echo "<td>
<input name='1'; value='" . $row2['grade'] . "'; style='width:50px;font-size: 18px' type='number'>
</td>
<td>
<input  value='" .     $avg . "'; style='width:50px;font-size: 18px' type='number'>

</td>
<td>
<input  value='" .     $w . "'; style='width:50px;font-size: 18px' type='number'>
</td>";



                            //    $num = $num + 1;


                            }

                       echo "   <td><button  value='" . $_POST['assi'] . "';  name='e' type='submit' class='btn2'>Edit</button></td>";
                        echo "</tr>";
                   //     $_SESSION['num'] = $num;
                    }
                    ?>




                </form>

                </table>

                <!----------table rows Start----------------------->
            </div>


        </div>

    </div>
</div>

</body>
</html>

