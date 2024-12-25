<?php
    try{
        include("conn.php");
        $myprogramname= null;
        $mysupervisorname = null;

        $supervisor = $_POST["student_supervisor"];

        $result2 = mysqli_query($con,"SELECT supervisor_ID FROM supervisor WHERE CONCAT(supervisor_firstname, ' ', supervisor_lastname) = '$supervisor'");
        while ($row = mysqli_fetch_array($result2)){
            $mysupervisorname = $row["supervisor_ID"];
        }

        $result = mysqli_query($con,"SELECT program_ID FROM program WHERE program_name = '$_POST[student_program]'");
        while ($row = mysqli_fetch_array($result)){
            $myprogramname = $row["program_ID"];
        }

        $date = date("Y-m-d");
        
            if($_FILES["student_profilepic"]["name"] == null){    
                $sql = "INSERT INTO student (`student_email`, `student_password`,
                `student_firstname`, `student_lastname`, `student_birthdate`, `student_gender`,
                `student_mobilenum`, `student_address`, `student_country`, `student_ic`,
                `student_register_date`, `is_active`, `program_ID`, `supervisor_ID`) VALUES 
                ('$_POST[student_email]', '$_POST[student_password]','$_POST[student_firstname]',
                '$_POST[student_lastname]', '$_POST[student_birthdate]', '$_POST[student_gender]',
                '$_POST[student_mobilenum]', '$_POST[student_address]', '$_POST[student_country]',
                '$_POST[student_ic]','$date', 0 , '$myprogramname', '$mysupervisorname')";
            }
            else{
                $image = $_FILES['student_profilepic']['tmp_name'];
                $name = $_FILES['student_profilepic']['name'];
                $image = base64_encode(file_get_contents(addslashes($image)));
    
                $sql = "INSERT INTO student  (`student_email`, `student_password`,
                `student_firstname`, `student_lastname`, `student_birthdate`, `student_gender`,
                `student_mobilenum`, `student_address`, `student_country`, `student_ic`,
                `student_register_date`, `is_active`, `student_profilepic`, `program_ID`, `supervisor_ID`) 
                 VALUES ('$_POST[student_email]','$_POST[student_password]','$_POST[student_firstname]',
                '$_POST[student_lastname]','$_POST[student_birthdate]', '$_POST[student_gender]',
                '$_POST[student_mobilenum]', '$_POST[student_address]', '$_POST[student_country]',
                '$_POST[student_ic]','$date', 0 , '$image', '$myprogramname', '$mysupervisorname')";
            }
            

            if (mysqli_query($con, $sql)) {
                echo "<script> alert('Record Added!'); window.location.href='admin_student.php';</script>";
            }
            else{
                echo "<script> alert('Record failed to Add!'); window.location.href='admin_student.php';</script>";
                }


            
    }
    catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }
?>