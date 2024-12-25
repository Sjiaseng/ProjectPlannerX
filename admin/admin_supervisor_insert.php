<?php
    try{
        include("conn.php");

        $myname=null;

        $result = mysqli_query($con,"SELECT program_ID FROM program WHERE program_name = '$_POST[supervisor_program]';");
        while ($row = mysqli_fetch_array($result)){
            $myname = $row["program_ID"];
        }
        $date = date("Y-m-d");

            if($_FILES["supervisor_profilepic"]["name"] == null){    
                $sql = "INSERT INTO supervisor (`supervisor_email`, `supervisor_password`,
                `supervisor_firstname`, `supervisor_lastname`, `supervisor_birthdate`, `supervisor_gender`,
                `supervisor_mobilenum`, `supervisor_address`, `supervisor_country`, `supervisor_ic`,
                `supervisor_register_date`, `is_active`, `program_ID`) 
                 VALUES
                ('$_POST[supervisor_email]','$_POST[supervisor_password]','$_POST[supervisor_firstname]',
                '$_POST[supervisor_lastname]','$_POST[supervisor_birthdate]', '$_POST[supervisor_gender]',
                '$_POST[supervisor_mobilenum]', '$_POST[supervisor_address]', '$_POST[supervisor_country]',
                '$_POST[supervisor_ic]','$date', 0 , '$myname')";
            }
            else{
                $image = $_FILES['supervisor_profilepic']['tmp_name'];
                $name = $_FILES['supervisor_profilepic']['name'];
                $image = base64_encode(file_get_contents(addslashes($image)));
    
                $sql = "INSERT INTO supervisor  (`supervisor_email`, `supervisor_password`,
                `supervisor_firstname`, `supervisor_lastname`, `supervisor_birthdate`, `supervisor_gender`,
                `supervisor_mobilenum`, `supervisor_address`, `supervisor_country`, `supervisor_ic`,
                `supervisor_register_date`, `is_active`, `supervisor_profilepic`, `program_ID`) 
                 VALUES
                 ('$_POST[supervisor_email]','$_POST[supervisor_password]','$_POST[supervisor_firstname]',
                '$_POST[supervisor_lastname]','$_POST[supervisor_birthdate]', '$_POST[supervisor_gender]',
                '$_POST[supervisor_mobilenum]', '$_POST[supervisor_address]', '$_POST[supervisor_country]',
                '$_POST[supervisor_ic]','$date', 0 , '$image', '$myname')";
            }
            

            if (mysqli_query($con, $sql)) {
                echo "<script> alert('Record Added!'); window.location.href='admin_supervisor.php';</script>";
                echo mysqli_error($con);
            }
            else{
                echo "<script> alert('Record failed to Add!'); window.location.href='admin_supervisor.php';</script>";
                echo mysqli_error($con);
                }
            
    }
    catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }
?>