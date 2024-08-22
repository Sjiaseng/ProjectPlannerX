<?php
    try{
        include("conn.php");
        $date = date("Y-m-d");

            if($_FILES["admin_profilepic"]["name"] == null){    
                $sql = "INSERT INTO admin (`admin_email`, `admin_password`, `admin_firstname`,
                `admin_lastname`, `admin_birthdate`, `admin_gender`, `admin_mobilenum`,
                 `admin_address`, `admin_country`, `admin_ic`, `admin_register_date`, `is_active`) 
                 VALUES
                ('$_POST[admin_email]','$_POST[admin_password]','$_POST[admin_firstname]',
                '$_POST[admin_lastname]','$_POST[admin_birthdate]', '$_POST[admin_gender]',
                '$_POST[admin_mobilenum]', '$_POST[admin_address]', '$_POST[admin_country]',
                '$_POST[admin_ic]','$date', 0 )";
            }
            else{
                $image = $_FILES['admin_profilepic']['tmp_name'];
                $name = $_FILES['admin_profilepic']['name'];
                $image = base64_encode(file_get_contents(addslashes($image)));
    
                $sql = "INSERT INTO admin (`admin_email`, `admin_password`, `admin_firstname`,
                `admin_lastname`, `admin_birthdate`, `admin_gender`, `admin_mobilenum`,
                 `admin_address`, `admin_country`, `admin_ic`, `admin_register_date`, `is_active`,`admin_profilepic`) 
                 VALUES
                ('$_POST[admin_email]','$_POST[admin_password]','$_POST[admin_firstname]',
                '$_POST[admin_lastname]','$_POST[admin_birthdate]', '$_POST[admin_gender]',
                '$_POST[admin_mobilenum]', '$_POST[admin_address]', '$_POST[admin_country]',
                '$_POST[admin_ic]','$date', 0 , '$image')";
            }
            

            if (mysqli_query($con, $sql)) {
                echo "<script> alert('Record Added!'); window.location.href='admin_admin_addnew.php';</script>";
            }
            else{
                echo "<script> alert('Record failed to Add!'); window.location.href='admin_admin_addnew.php';</script>";
     
                }
            
    }
    catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }
?>