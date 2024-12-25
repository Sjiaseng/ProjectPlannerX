<?php
try{
        include("conn.php");
        $id = intval($_GET['id']);
        $sql = "UPDATE contactus SET is_read = 1 WHERE contactus_ID = $id;";
        if (mysqli_query($con, $sql)) {
            echo '<script> location.href="admin_contact2.php?id='.$id.'"</script>';
        }
        else{
            echo "<script> alert('Record Failed to Load!'); window.location.href='admin_contact.php';</script>";
        }
        
}
    catch(Exception $e){
            echo 'Message: ' .$e->getMessage();
    }
?>