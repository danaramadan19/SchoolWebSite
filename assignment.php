

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="homework.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">


    <script type="text/javascript">
        $(document).ready(function()
        {
            // Activate tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Select/Deselect checkboxes
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function()
            {
                if(this.checked){
                    checkbox.each(function()
                    {
                        this.checked = true;
                    });
                }
                else
                {
                    checkbox.each(function()
                    {
                        this.checked = false;
                    });
                }
            });
            checkbox.click(function()
            {
                if(!this.checked)
                {
                    $("#selectAll").prop("checked", false);
                }
            });
        });
    </script>
</head>
<body>


<header>

    <div id="menu" class="fas fa-bars"></div>

    <a href="#" class="happyGrade"><i class="fas fa-user-graduate"></i>HappyGrade</a>

    <nav class="navbar">
        <ul>
            <li><a class="active" href="#home">Assigment Adder </a></li>
            <li><a href="teacherPage.php">Go Back</a></li>
        </ul>
    </nav>

</header>


<section>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Assignments</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Assignment</span></a>

                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>

                    <th>Assignment Number</th>
                    <th>Assignment File</th>
                    <th>Weight</th>
                    <th>
                    <span class="custom-checkbox">
        <input type="checkbox" id="selectAll">
        <label for="selectAll"></label>
       </span> By Assistant?</th>
                    <th>Actions</th>
                </tr>
                </thead>


                    <?php
                    session_start();
                    $tid= $_SESSION['tid'];
                    $link2=$_SESSION['cid'];
                    $db =  new mysqli('localhost', 'root', '', 'happygrades');
                    $result=$db->query("select * from  assistantcourses where `courseID`='" . $link2 . "' and `teacherid`='" . $tid . "' ");
                    for($i=0;$i<$result->num_rows;$i++)
                    {
                        echo" <tbody>";
                        echo"  <tr>";
                        $row=$result->fetch_assoc();

                        echo"<td>".$row['assignmentname']."</td>";
                           echo"  <td>file</td>";
                        echo"<td>".$row['weight']."</td>";
                        echo"  <td>  <span class='custom-checkbox'>";
                        echo"  <input type='checkbox' checked id='checkbox1'name='options[]' value='1'>";
                        echo"   
        <label for='checkbox1'></label>";

echo"  </span></td>";
echo"<td>";
     echo"    <a href='#editEmployeeModal' class='edit' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>";
   echo" <a href='#deleteEmployeeModal' class='delete' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>";
                echo"    </td>";
                        echo"  </tr>";
                    }
                    ?>

            </table>

        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="assignment.php" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Assignment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Assignment Number</label>
                            <input type="text"name="Anum" class="form-control" placeholder="Assignment#" required>
                        </div>
                        <div class="form-group">
                            <label>Assignment File</label>
                            <input type="url" name="link"class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Weight</label>
                            <select name="weignt"  class="form-control" >
                                <option  value="5">5</option>
                                <option  value="10">10</option>
                                <option  value="15">15</option>
                                <option  value="20">20</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>By Assistant?</label>
                            <input type="text"  name="aid">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Assignment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Records?</p>
                        <!-- <p class="text-warning"><small>This action cannot be undone.</small></p>-->
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>
<?php
if(isset($_POST['Anum'])){
    $anum=$_POST['Anum'];

$weight=$_POST['weignt'];
    $aid=$_POST['aid'];
    $l=$_POST['link'];
    $result3=$db->query("select * from  tcourses where `CID`='" . $link2 . "'  ");
    $row2=$result3->fetch_assoc();
    $cname=$row2['CName'];
    mysqli_query($db, "INSERT INTO `assistantcourses`(`assistantid`, `weight`, `courseName`, `courseID`, `assignmentname`, `teacherid`,`link`) VALUES (
    '$aid', ' $weight', '$cname', '$link2', '$anum', '$tid','$l')");
    $result4=$db->query("select * from  scourses where `courseid`='" . $link2 . "'  ");
$g=0;
    for($i=0;$i<$result4->num_rows;$i++)
    {    $row3=$result4->fetch_assoc();
        $studentname=$row3['studentname'];
        $studentid=$row3['studentid'];
        mysqli_query($db, "  INSERT INTO `grades`(`assignmentname`, `courseid`, `studentid`, `studentname`, `grade`, `weight`) VALUES (
    '$anum', ' $link2', '$studentid', '$studentname', '$g','$weight')");

    }

}