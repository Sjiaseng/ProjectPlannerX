<?php
    try{
        include("conn.php");

            if($_FILES["admin_profilepic"]["name"] == null){
                $sql = "UPDATE admin SET
                admin_firstname='$_POST[admin_firstname]',
                admin_lastname='$_POST[admin_lastname]',
                admin_gender='$_POST[admin_gender]',
                admin_ic='$_POST[admin_ic]', 
                admin_birthdate='$_POST[admin_birthdate]', 
                admin_mobilenum='$_POST[admin_mobilenum]', 
                admin_address='$_POST[admin_address]', 
                admin_country='$_POST[admin_country]', 
                admin_email='$_POST[admin_email]', 
                admin_password='$_POST[admin_password]'
                WHERE admin_ID=$_POST[admin_ID];";
            }
            else{
                $name = $_FILES["admin_profilepic"]["name"];
                $image = $_FILES["admin_profilepic"]["tmp_name"];
                $images = base64_encode(file_get_contents(addslashes($image)));
                $sql = "UPDATE admin SET
                admin_profilepic='$images',
                admin_firstname='$_POST[admin_firstname]',
                admin_lastname='$_POST[admin_lastname]',
                admin_gender='$_POST[admin_gender]',
                admin_ic='$_POST[admin_ic]', 
                admin_birthdate='$_POST[admin_birthdate]', 
                admin_mobilenum='$_POST[admin_mobilenum]', 
                admin_address='$_POST[admin_address]', 
                admin_country='$_POST[admin_country]', 
                admin_email='$_POST[admin_email]', 
                admin_password='$_POST[admin_password]'
                WHERE admin_ID=$_POST[admin_ID];";
            }

            if (mysqli_query($con, $sql)) {
                echo "<script> alert('Record Updated!'); window.location.href='admin_admin.php';</script>";
            }
            else{
                echo "<script> alert('Record failed to Update!'); window.location.href='admin_admin.php';</script>";
                }
            
}
    catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }
?>