<?php
    try{
        include("conn.php");

            if($_FILES["program_icon"]["name"] == null){
                $sql = "UPDATE program SET
                program_name ='$_POST[program_name]',
                is_active = '$_POST[program_status]'
                WHERE program_ID= '$_POST[programs_ID]';";
            }
            else{
                $name = $_FILES["program_icon"]["name"];
                $image = $_FILES["program_icon"]["tmp_name"];
                $images = base64_encode(file_get_contents(addslashes($image)));
                $sql = "UPDATE program SET
                program_name ='$_POST[program_name]',
                is_active = '$_POST[program_status]',
                program_icon = '$images'
                WHERE program_ID= '$_POST[programs_ID]';";
            }

            if (mysqli_query($con, $sql)) {
                echo "<script> alert('Record Updated!'); window.location.href='admin_program.php'; </script>";
            }
            else{
                echo "<script> alert('Record failed to Update!'); window.location.href='admin_program.php';</script>";
                echo mysqli_error($con);
                }
            
}
    catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }
?>