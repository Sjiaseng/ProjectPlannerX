<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <link rel="stylesheet" href="certificate.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <a href="admin_report.php" ><div id="goback"><i class='bx bx-chevrons-left' id="icon"></i>Back</div></a>
    <span id="progtitle">Please Provide a Student Name: </span>

    <form action="certificate.php" method="GET">
        <select required id="studentselection" name="student">
            <option value="none">none</option>
            <?php
                include("conn.php");
                include("session.php");

                $result = mysqli_query($con, "SELECT * FROM student");
                while ($row = mysqli_fetch_array($result)){
                    echo '<option value="'.$row["student_firstname"].' '.$row["student_lastname"].'">'.$row["student_firstname"].' '.$row["student_lastname"].'</option>';
                }
            ?>
        </select>

        <button type="submit" class="submitbutton">Submit</button>
    </form>

    <?php 
        $mydate = date("Y-m-d");
        $studentname = null;
        $studentID= null;
        $student = null;

    if (isset($_GET["student"]) == True && $_GET["student"] != "none") {
        $student = $_GET["student"];

        $result3 = mysqli_query($con, "SELECT student_ID FROM student WHERE CONCAT(student_firstname, ' ', student_lastname) = '$student'");
        while ($row = mysqli_fetch_array($result3)){
           $studentID = $row["student_ID"];
        }
    } else{
        $studentname = null;
        $studentID= null;
    }
    ?>


    <div id="print" onclick="window.print()"><i class='bx bx-printer'></i></div>



    <div id="myreportbg">
    <?php
        if ($studentname == null && $studentID == null){
        echo '
            <img src="http://localhost/admin/image/Logo2.png" id="logo">
            <span id="subreport">CERTIFICATE</span>
            <span id="subreport2">This Certificate is Awarded to</span>


            <span id="studname"></span>
            <hr id="div">

            <span id="complete">For Archieving</span>

            <span id="gradename"></span>
            <hr id="div2">

            <span id="fyp">In Final Year Project</span>

            <span id="sign">Signature:</span>
            <hr id="signdiv">
            <span id="bracket">Name:</span>

            <span id="date">Date:</span>
            <hr id="datediv">
            <span id="mydate"></span>';
        } else{

            $result4 = mysqli_query($con,"SELECT student.student_firstname, student.student_lastname,
            project.project_grade FROM student
            JOIN project ON student.project_ID = project.project_ID
            WHERE student.student_ID = $studentID");

            while ($row = mysqli_fetch_array($result4)){

                if ($row["project_grade"] >= 80){
                    echo '<span id="gradename"> Distinction </span>';
                }else if ($row["project_grade"] >= 75 && $row["project_grade"] <= 79){
                    echo '<span id="gradename"> Distinction </span>';
                }else if ($row["project_grade"] >= 70 && $row["project_grade"] <= 74){
                    echo '<span id="gradename"> Credit </span>';
                }else if ($row["project_grade"] >= 65 && $row["project_grade"] <= 69){
                    echo '<span id="gradename"> Credit </span>';
                }else if ($row["project_grade"] >= 60 && $row["project_grade"] <= 64){
                    echo '<span id="gradename"> Pass </span>';
                }else if ($row["project_grade"] >= 55 && $row["project_grade"] <= 59){
                    echo '<span id="gradename"> Pass </span>';
                }else if ($row["project_grade"] >= 50 && $row["project_grade"] <= 54){
                    echo '<span id="gradename"> Pass </span>';
                } else if($row["project_grade"] >= 0 && $row["project_grade"] >= 49){
                    echo "<script> alert('Student failed! Unable to Generate Certificate');</script>";
                } else if(!$row["project_grade"] || $row["project_grade"] == null ||$row["project_grade"] ==""){
                    echo "<script> alert('Student is not graded!');</script>";
                }

            echo '
                <img src="http://localhost/admin/image/Logo2.png" id="logo">
                <span id="subreport">CERTIFICATE</span>
                <span id="subreport2">This Certificate is Awarded to</span>
        
        
                <span id="studname">'.$student.'</span>
                <hr id="div">
        
                <span id="complete">For Archieving</span>
    
                <hr id="div2">
    
                <span id="fyp">In Final Year Project</span>
        
                <span id="sign">Signature:</span>
                <hr id="signdiv">
                <span id="bracket">Name:</span>
    
                <span id="date">Date:</span>
                <hr id="datediv">
                <span id="mydate">'.$mydate.'</span>';

            }
        }
    
    ?>
    </div>

    <hr class="divider">


</body>
</html>