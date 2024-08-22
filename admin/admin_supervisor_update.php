<?php
    try{
        include("conn.php");

        $myprogram = null;
        $result = mysqli_query($con,"SELECT program_ID FROM program WHERE program_name = '$_POST[supervisor_program]';");
        while ($row = mysqli_fetch_array($result)){
            $myprogram = $row["program_ID"];
        }

            if($_FILES["supervisor_profilepic"]["name"] == null){
                $sql = "UPDATE supervisor SET
                supervisor_firstname='$_POST[supervisor_firstname]',
                supervisor_lastname='$_POST[supervisor_lastname]',
                supervisor_gender='$_POST[supervisor_gender]',
                supervisor_ic='$_POST[supervisor_ic]', 
                supervisor_birthdate='$_POST[supervisor_birthdate]', 
                supervisor_mobilenum='$_POST[supervisor_mobilenum]', 
                supervisor_address='$_POST[supervisor_address]', 
                supervisor_country='$_POST[supervisor_country]', 
                supervisor_email='$_POST[supervisor_email]', 
                supervisor_password='$_POST[supervisor_password]',
                program_ID = '$myprogram'
                WHERE supervisor_ID = $_POST[supervisor_ID];";
            }
            else{
                $name = $_FILES["supervisor_profilepic"]["name"];
                $image = $_FILES["supervisor_profilepic"]["tmp_name"];
                $images = base64_encode(file_get_contents(addslashes($image)));
                $sql = "UPDATE supervisor SET
                supervisor_profilepic='$images',
                supervisor_firstname='$_POST[supervisor_firstname]',
                supervisor_lastname='$_POST[supervisor_lastname]',
                supervisor_gender='$_POST[supervisor_gender]',
                supervisor_ic='$_POST[supervisor_ic]', 
                supervisor_birthdate='$_POST[supervisor_birthdate]', 
                supervisor_mobilenum='$_POST[supervisor_mobilenum]', 
                supervisor_address='$_POST[supervisor_address]', 
                supervisor_country='$_POST[supervisor_country]', 
                supervisor_email='$_POST[supervisor_email]', 
                supervisor_password='$_POST[supervisor_password]',
                program_ID = '$myprogram'
                WHERE supervisor_ID= $_POST[supervisor_ID];";
            }

            if (mysqli_query($con, $sql)) {
                echo "<script> alert('Record Updated!'); window.location.href='admin_supervisor.php'; </script>";
            }
            else{
                echo "<script> alert('Record failed to Update!'); window.location.href='admin_supervisor.php';</script>";
                echo mysqli_error($con);
                }
            
}
    catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }
?>