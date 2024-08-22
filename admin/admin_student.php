<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="admin_student.css">
</head>
<body>
    <?php
        include("admin_navigator.php");
        include("conn.php");

        if (isset($_GET["searchuser"]) == True){
            $search = $_GET["searchuser"];
        }
        else{
            $search = null;
        }

        $count = mysqli_query($con,"SELECT * FROM student WHERE student_ID LIKE '%$search%' OR student_firstname LIKE '%$search%'  OR student_lastname LIKE '%$search%'");
        $mycount = mysqli_num_rows($count);
    ?>

    <a href="admin_student_addnew.php"><div id="addnewuser">Add New Student</div></a>
    
    <form action="admin_student.php" method="GET">
        <span id="result"><?php echo $mycount?> results found!</span>
        <div class="searchinguser">
            <button type="submit" id="searchbutton"><i class='bx bx-search-alt-2'></i></button>
            <input type="text" name="searchuser" placeholder="Search here" id="searchbox" value=<?php echo $search ?>>
        </div>
    </form>

    <div class="contentbackground">
        <div class="contentbox">
            <span id="Title1">Student ID</span>
            <span id="Title2">Name</span>
            <span id="Title3">Contacts</span>
            <span id="Title4">Date Registered</span>
            <span id="Title5">Status</span>
            <span id="Title6">Actions</span>
        </div>

        <?php
        if (isset($search) == False){
            $result = mysqli_query($con,"SELECT * FROM student");
            while ($row = mysqli_fetch_array($result)){
                if($row["is_active"]== 1){
                    echo'
                        <div class="infobox">
                            <span id="info1">'.$row['student_ID'].'</span>
                            <span id="info2">'.$row['student_firstname'].' '.$row['student_lastname'].'</span>
                            <span id="info31">'.$row['student_mobilenum'].'</span>
                            <span id="info32">'.$row['student_email'].'</span>
                            <span id="info4">'.$row['student_register_date'].'</span>
                            <span id="info5">Active <div id="activelogo"></div></span>
                            <a href="admin_student_edit.php?id='.$row["student_ID"].'"><span id="info6"><i class="bx bxs-edit" ></i></span></a>
                            <a onclick="return confirm(\'Delete this record?\')" href="admin_student_delete.php?id='.$row["student_ID"].'""><span id="info7"><i class="bx bx-trash"></i></span></a>
                        </div>';
                }

                else{
                    echo'
                    <div class="infobox">
                        <span id="info1">'.$row['student_ID'].'</span>
                        <span id="info2">'.$row['student_firstname'].' '.$row['student_lastname'].'</span>
                        <span id="info31">'.$row['student_mobilenum'].'</span>
                        <span id="info32">'.$row['student_email'].'</span>
                        <span id="info4">'.$row['student_register_date'].'</span>
                        <span id="info5">Inactive <div id="inactivelogo"></div></span>
                        <a href="admin_student_edit.php?id='.$row["student_ID"].'"><span id="info6"><i class="bx bxs-edit" ></i></span></a>
                        <a onclick="return confirm(\'Delete this record?\')" href="admin_student_delete.php?id='.$row["student_ID"].'"><span id="info7"><i class="bx bx-trash"></i></span></a>
                    </div>';
                }
            }
        } else {
            $result = mysqli_query($con,"SELECT * FROM student WHERE student_ID LIKE '%$search%' OR student_firstname LIKE '%$search%'  OR student_lastname LIKE '%$search%'");
            while ($row = mysqli_fetch_array($result)){
                if($row["is_active"]== 1){
                    echo'
                        <div class="infobox">
                            <span id="info1">'.$row['student_ID'].'</span>
                            <span id="info2">'.$row['student_firstname'].' '.$row['student_lastname'].'</span>
                            <span id="info31">'.$row['student_mobilenum'].'</span>
                            <span id="info32">'.$row['student_email'].'</span>
                            <span id="info4">'.$row['student_register_date'].'</span>
                            <span id="info5">Active <div id="activelogo"></div></span>
                            <a href="admin_student_edit.php?id='.$row["student_ID"].'"><span id="info6"><i class="bx bxs-edit" ></i></span></a>
                            <a onclick="return confirm(\'Delete this record?\')" href="admin_student_delete.php?id='.$row["student_ID"].'""><span id="info7"><i class="bx bx-trash"></i></span></a>
                        </div>';
                }

                else{
                    echo'
                    <div class="infobox">
                        <span id="info1">'.$row['student_ID'].'</span>
                        <span id="info2">'.$row['student_firstname'].' '.$row['student_lastname'].'</span>
                        <span id="info31">'.$row['student_mobilenum'].'</span>
                        <span id="info32">'.$row['student_email'].'</span>
                        <span id="info4">'.$row['student_register_date'].'</span>
                        <span id="info5">Inactive <div id="inactivelogo"></div></span>
                        <a href="admin_student_edit.php?id='.$row["student_ID"].'"><span id="info6"><i class="bx bxs-edit" ></i></span></a>
                        <a onclick="return confirm(\'Delete this record?\')" href="admin_student_delete.php?id='.$row["student_ID"].'"><span id="info7"><i class="bx bx-trash"></i></span></a>
                    </div>';
                }
        }
    }
        ?>

    </div>

    <script>
        let title = document.getElementById("title");
        title.innerHTML="Students";
    </script>
</body>
</html>