<?php
try{
    include("conn.php");
    $id = intval($_GET['id']);

    $sql="DELETE FROM appointment WHERE appointment_ID=$id";
    $result = mysqli_query($con, $sql);

        if ($result){
            echo "<script> alert('Record Deleted!'); window.location.href='admin_appointment.php';</script>";
            mysqli_close($con);
        }
        else {
            echo "<script> alert('Failed to delete this record! Please Retry'); window.location.href='admin_appointment.php'; </script>";
            mysqli_close($con);
            }
        }
    catch(Exception $e){
            echo 'Message: ' .$e->getMessage();
    }
?>