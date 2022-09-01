
<?php
session_start();
$aid= $_SESSION['aid'];


?>
<?php
$num2=$_SESSION['num2'];
if(isset($_POST[$num2-1])) {
    $cid = $_SESSION['cid'];
    $mm = 0;
    $db = new mysqli('localhost', 'root', '', 'happygrades');
    $result = $db->query("select * from  SCourses where `courseid`='" . $cid . "'  ");
    $aname="Assignment#".$_POST['assi'];
    $result3 = $db->query("select * from grades where `assignmentname`='" . $aname. "'  ");
    $row3 = $result3->fetch_assoc();
    $w=$row3['weight'];
    for ($i = 0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_assoc();
        $sid = $row['studentid'];
        $db = new mysqli('localhost', 'root', '', 'happygrades');
        $db->query("UPDATE `grades`  SET `grade`='" . $_POST[$mm] ."'  where `courseid`='" . $cid . "'and  `studentid`='" . $sid . "' and  `assignmentname`='" . $aname . "'");
        $mm=$mm+1;
    }

}
else{

}
?>
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

        <a href="assiestant.php" ><li ><img src="dashboard%20(2).png" alt="" >&nbsp; Dashboard</li></a>
       <!-- <li><img src="teacher2.png" alt="">&nbsp;<a style="color: white;" href="#Assignment">Assignment</a></li>
    -->  <li><img src="reading-book%20(1).png" alt="">&nbsp;Students</li>
        <li><img src="school.png" alt="">&nbsp;Events</li>

        <li><img src="help-web-button.png" alt="">&nbsp;Help</li>
        <li><img src="settings.png" alt="">&nbsp;Profile</li>
        <li>Log Out</li>
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
                  <form action='coursePage.php' method='post'>

                  <select name="assi" id="assi">

                      <?php

                      $link2=$_GET['id'];
                      $db =  new mysqli('localhost', 'root', '', 'happygrades');
                      $r=1;
                      $result=$db->query("select * from  assistantcourses where `assistantid`='" . $aid . "' and `courseID`='" . $link2 . "' ");
                      for($i=0;$i<$result->num_rows;$i++)
                      {
                          $row=$result->fetch_assoc();

                 echo"<option value='".$r."' name='n'>".$row['assignmentname']." ".'weight='.$row['weight']."</option>";
                          $r=$r+1;

                      }
                      ?>


                  </select>



              </div>
                <!----------table rows Start----------------------->

                <table>
                    <tr>
                        <th>Student Name</th>
                        <th>Mark</th>


                        <th>Save</th>
                    </tr>

<?php
$cid=$link2;
$num2=0;
$db = new mysqli('localhost', 'root', '', 'happygrades');
$result=$db->query("select * from  SCourses where `courseid`='" . $cid . "'  ");
$_SESSION['cid'] = $cid;

for($i=0;$i<$result->num_rows;$i++)
{
    $row=$result->fetch_assoc();
  echo"<tr>"  ;
    echo"<td>".$row['studentname']."</td>"  ;
    echo"<td><input name='".$num2."' ;style='width:50px;font-size: 18px' type='number'></td>" ;
$num2=$num2+1;

}

echo" <td><button type='submit' class='btn2'>Save</button></td>"  ;
echo"</tr>";
$_SESSION['num2']=$num2;
                   ?>





                </table>

</form>
                <!----------table rows Start----------------------->
            </div>

            <div class="chat">
                <div class="title">
                    <h3>Course Chat

                       </h3>
            </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>

