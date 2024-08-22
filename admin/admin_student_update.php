<?php
    try{
        include("conn.php");

        $myprogram = null;
        $mysupervisor = null;
        $result = mysqli_query($con,"SELECT program_ID FROM program WHERE program_name = '$_POST[student_program]';");
        while ($row = mysqli_fetch_array($result)){
            $myprogram = $row["program_ID"];
        }
        $result2 = mysqli_query($con,"SELECT supervisor_ID FROM supervisor WHERE CONCAT(supervisor_firstname, ' ', supervisor_lastname) = '$_POST[student_supervisor]'");
        while ($row = mysqli_fetch_array($result2)){
            $mysupervisor = $row["supervisor_ID"];
        }

            if($_FILES["student_profilepic"]["name"] == null){
                $sql = "UPDATE student SET
                student_firstname='$_POST[student_firstname]',
                student_lastname='$_POST[student_lastname]',
                student_gender='$_POST[student_gender]',
                student_ic='$_POST[student_ic]', 
                student_birthdate='$_POST[student_birthdate]', 
                student_mobilenum='$_POST[student_mobilenum]', 
                student_address='$_POST[student_address]', 
                student_country='$_POST[student_country]', 
                student_email='$_POST[student_email]', 
                student_password='$_POST[student_password]',
                program_ID = '$myprogram',
                supervisor_ID = '$mysupervisor'
                WHERE student_ID = $_POST[student_ID];";
            }
            else{
                $name = $_FILES["student_profilepic"]["name"];
                $image = $_FILES["student_profilepic"]["tmp_name"];
                $images = base64_encode(file_get_contents(addslashes($image)));
                $sql = "UPDATE student SET
                student_profilepic='$images',
                student_firstname='$_POST[student_firstname]',
                student_lastname='$_POST[student_lastname]',
                student_gender='$_POST[student_gender]',
                student_ic='$_POST[student_ic]', 
                student_birthdate='$_POST[student_birthdate]', 
                student_mobilenum='$_POST[student_mobilenum]', 
                student_address='$_POST[student_address]', 
                student_country='$_POST[student_country]', 
                student_email='$_POST[student_email]', 
                student_password='$_POST[student_password]',
                program_ID = '$myprogram',
                supervisor_ID = '$mysupervisor'
                WHERE student_ID= $_POST[student_ID];";
            }

            if (mysqli_query($con, $sql)) {
                echo "<script> alert('Record Updated!'); window.location.href='admin_admin.php'; </script>";
            }
            else{
                echo "<script> alert('Record failed to Update!'); window.location.href='admin_admin.php';</script>";
                echo mysqli_error($con);
                }
            
}
    catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }
?>