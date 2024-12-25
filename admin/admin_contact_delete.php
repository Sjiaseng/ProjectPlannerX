<?php
    try{
        include("conn.php");

        $id = intval($_GET['id']);

        $sql="DELETE FROM contactus WHERE contactus_ID=$id";
        $result = mysqli_query($con, $sql);
            if ($result){
                echo "<script> window.location.href='admin_contact.php';</script>";
                mysqli_close($con);
            }
            else {
                echo "<script> alert('Failed to delete this record!'); window.location.href='admin_contact.php';</script>";
                mysqli_close($con);
            }
        }
        catch(Exception $e){
            echo 'Message: ' .$e->getMessage();
        }
?>