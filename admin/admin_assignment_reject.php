<?php

try{
    include("conn.php");


    $sql = "UPDATE project SET
    reject_detail = '$_POST[reject_reason]',
    is_approve = 2 
    WHERE project_ID = $_POST[project_ID]";

    $date = date("Y-m-d");
    $mysupervisor = null;

    $result2 = mysqli_query($con,"SELECT main_supervisor_ID FROM project WHERE project_ID = $_POST[project_ID]");
    while ($row = mysqli_fetch_array($result2)){
        $mysupervisor = $row["main_supervisor_ID"];
    }

    $sql2 = "INSERT INTO notification (`supervisor_ID`, `notification_title`, `notification_message`, `created_at`, `is_read`)
    VALUES ('$mysupervisor','Rejection!', 'Your guideline has been rejected!', '$date' , 0)";


    if (mysqli_query($con, $sql) && mysqli_query($con, $sql2)) {
        echo "<script> alert('Rejected Assignment Guideline!'); window.location.href='admin_assignment.php';</script>";
    }
    else{
        echo "<script> alert('Fail to Reject Assignment Guideline!'); window.location.href='admin_assignment.php';</script>";
    }
    echo mysqli_error($con);  
}


catch(Exception $e){
    echo 'Message: ' .$e->getMessage();
}

?>
