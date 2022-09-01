<?php
session_start();

$tid= $_SESSION['tid'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Page</title>

    <!-- google fonts cdn link  -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style2.css">

</head>
<body>


<!-- header section starts  -->

<header>

    <div id="menu" class="fas fa-bars"></div>

    <a href="#" class="happyGrade"><i class="fas fa-user-graduate"></i>happyGrade</a>

    <nav class="navbar">
        <ul>
            <li><a class="active" href="#home">home</a></li>

            <li><a href="#course">course</a></li>

            <li><a href="#contact">contact</a></li>

            <li><a href="index.html">LogOut</a></li>
        </ul>
    </nav>

</header>



<!-- home section starts  -->

<section class="home" id="home">
    <h1>Welcome Professor
        <?php if ($tid==1239){?>
        Shatha Ajaj <?php  } ?>  </h1>

    <p>Here you can see the courses that you will give during the semester, the information of the students you are studying in addition to adding tests and homework marks</p>
    <!-- <a href="#"><button class="btn">get started</button></a>-->

    <div class="shape"></div>

</section>

<!-- home section ends -->

<section class="course" id="course">

    <h1 class="heading">Courses</h1>
    <div class='box-container'>
    <?php
    $db =  new mysqli('localhost', 'root', '', 'happygrades');

    $result=$db->query("select * from  tcourses where `TID`='" . $tid . "'");

     for($i=0;$i<$result->num_rows;$i++)
    {
        $row=$result->fetch_assoc();
      
        echo " <div class='box'>" ;
        echo"    <img src='course-1.svg' alt=''> ";
        echo "<h3>".$row['CName']."</h3>";
    echo " <a href='teachergrade.php'  name='<?php echo".$row['CID']."; ?> ' onclick='fun(this)' class='btn'> Go to the course> </a>";
      echo"</div>"  ;
    }
    ?>
</section>


<!-- contact section starts  -->

<section class="contact" id="contact">

    <h1 class="heading">contact us</h1>
    <h3>If you are having any problem, please don't hesitate to contact us</h3>
    <div class="row">

        <form action="">
            <input type="text" placeholder="full name" class="box">
            <input type="email" placeholder="your email" class="box">
            <input type="password" placeholder="your password" class="box">
            <input type="number" placeholder="your number" class="box">
            <textarea name="" id="" cols="30" rows="10" class="box address" placeholder="your address"></textarea>
            <input type="submit" class="btn" value="send now">
        </form>

        <div class="image">
            <img src="contact-img.svg" alt="">
        </div>

    </div>

</section>

<!-- contact section ends -->







<!-- jquery cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- custom js file link  -->
<script src="script2.js"></script>

</body>
<script>
    function fun(t1){
        let str=t1.name;

        let myArray = str.split("o");
        let myArray2 = myArray[1].split(";");
        t1.href="teachergrade.php?id="+myArray2[0];


    }
</script>
</html>
