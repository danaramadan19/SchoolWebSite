
<?php
//require "index.html";
$db = new mysqli('localhost', 'root', '', 'happygrades');

if(!$db){
    die("Error: Failed to connect to database!");
}
$password=$_POST['password'];
$id=$_POST['id'];
/*
mysqli_query($db, "INSERT INTO `person`(`Name`, `ID`, `email`, `password`, `state`) VALUES(
    '$name', '$id', '$email', '$password', '$name')");*/
//SQL Query
$query = mysqli_query($db,"SELECT * FROM student WHERE 
     ID='$id' AND password ='$password'");
$query2 = mysqli_query($db,"SELECT * FROM teacher WHERE 
     ID='$id' AND password ='$password'");
$query2 = mysqli_query($db,"SELECT * FROM teacher WHERE 
     ID='$id' AND password ='$password'");
$numrows= mysqli_num_rows($query);

$numrows2= mysqli_num_rows($query2);
$query3 = mysqli_query($db,"SELECT * FROM assistant WHERE 
     ID='$id' AND password ='$password'");
$numrows3= mysqli_num_rows($query3);
if($numrows>0)
{
    header("Location: student.php");

    session_start();

    $_SESSION['sid'] = $id;

}
elseif($numrows3>0)//مساعد
{
    header("Location: assiestant.php");

    session_start();

    $_SESSION['aid'] = $id;

}
elseif ($numrows2>0)//معلم
{
    header("Location: teacherPage.php");
    session_start();

    $_SESSION['tid'] = $id;

}
else{
    //http://localhost/SP/index.html

    header("Location: index.html");

}


$db->close();
?>









