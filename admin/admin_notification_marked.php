<?php
    try{
        include("conn.php");
        $id = intval($_GET['id']);
        $sql = "UPDATE notification SET is_read = 1 WHERE admin_ID = $id";


        if (mysqli_query($con, $sql)) {
            echo "<script> history.back();</script>";
            mysqli_close($con);
        }
        else{
            echo "<script> alert('Failed to update this record!'); history.back(); </script>";
            mysqli_close($con);
            echo mysqli_error($con);
        }
    }

    catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }
?>
