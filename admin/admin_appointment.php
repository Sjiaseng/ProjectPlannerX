<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="stylesheet" href="admin_appointment.css">
</head>
<body>
    <?php
        include("admin_navigator.php");
        include("conn.php");
        if (isset($_GET["searchuser"]) == True){
            $search = $_GET["searchuser"];
        }
        else{
            $search = null;
        }

        $count = mysqli_query($con,"SELECT appointment.appointment_ID, appointment.appointment_data,
        appointment.appointment_description, appointment.is_approve, appointment.appointment_datetime,
        student.student_firstname, student.student_lastname, supervisor.supervisor_firstname, 
        supervisor.supervisor_lastname FROM appointment
        JOIN student ON appointment.student_ID = student.student_ID
        JOIN supervisor ON appointment.supervisor_ID = supervisor.supervisor_ID
        WHERE appointment_ID LIKE '%$search%' OR student_firstname LIKE '%$search%' OR student_lastname LIKE '%$search%'
        OR supervisor_firstname LIKE '%$search%' OR supervisor_lastname LIKE '%$search%' OR appointment_data LIKE '%$search%'
        ORDER BY appointment_ID DESC");
        $mycount = mysqli_num_rows($count);
    ?>

    <form action="admin_appointment.php" method="GET">
        <span id="result"><?php echo $mycount?> results found!</span>
        <div class="searchinguser">
            <button type="submit" id="searchbutton" name="searchbutton"><i class='bx bx-search-alt-2'></i></button>
            <input type="text" name="searchuser" placeholder="Search here" id="searchbox" value="<?php echo $search ?>">
        </div>
    </form>

    <div class="myappointmentbg">

    <?php         


    if (isset($search) == False){
        $result = mysqli_query($con,"SELECT appointment.appointment_ID, appointment.appointment_data,
        appointment.appointment_description, appointment.is_approve, appointment.appointment_datetime,
        student.student_firstname, student.student_lastname, supervisor.supervisor_firstname, 
        supervisor.supervisor_lastname FROM appointment
        JOIN student ON appointment.student_ID = student.student_ID
        JOIN supervisor ON appointment.supervisor_ID = supervisor.supervisor_ID
        ORDER BY appointment_ID DESC");
        while ($row = mysqli_fetch_array($result)){
            if($row["is_approve"] == 0){
                echo'
                <div id="insidecontainer">
                    <div id="mystatus1"></div>
                    <span id="aid">Appointment ID: '.$row["appointment_ID"].'</span>
                    <span id="adata">'.$row["appointment_data"].'</span>
                    <span id="adesc">Description: '.$row["appointment_description"].'</span>
                    <span id="atime">Appointment Date: '.$row["appointment_datetime"].'</span>
                    <span id="studname">Student Name: '.$row["student_firstname"].' '.$row["student_lastname"].'</span>
                    <span id="supername">Supervisor Name: '.$row["supervisor_firstname"].' '.$row["supervisor_lastname"].'</span>
                    <a onclick="return confirm(\'Delete this record?\')" href="admin_appointment_delete.php?id='.$row["appointment_ID"].'" id="delete"><i class="bx bx-trash"></i></a>
                </div>';
            }
            else if($row["is_approve"] == 1){
                echo'
                <div id="insidecontainer">
                    <div id="mystatus2"></div>
                    <span id="aid">Appointment ID: '.$row["appointment_ID"].'</span>
                    <span id="adata">'.$row["appointment_data"].'</span>
                    <span id="adesc">Description: '.$row["appointment_description"].'</span>
                    <span id="atime">Appointment Date: '.$row["appointment_datetime"].'</span>
                    <span id="studname">Student Name: '.$row["student_firstname"].' '.$row["student_lastname"].'</span>
                    <span id="supername">Supervisor Name: '.$row["supervisor_firstname"].' '.$row["supervisor_lastname"].'</span>
                    <a onclick="return confirm(\'Delete this record?\')" href="admin_appointment_delete.php?id='.$row["appointment_ID"].'" id="delete"><i class="bx bx-trash"></i></a>
                </div>';
            }
            else if($row["is_approve"] == 2){
                echo'
                <div id="insidecontainer">
                    <div id="mystatus3"></div>
                    <span id="aid">Appointment ID: '.$row["appointment_ID"].'</span>
                    <span id="adata">'.$row["appointment_data"].'</span>
                    <span id="adesc">Description: '.$row["appointment_description"].'</span>
                    <span id="atime">Appointment Date: '.$row["appointment_datetime"].'</span>
                    <span id="studname">Student Name: '.$row["student_firstname"].' '.$row["student_lastname"].'</span>
                    <span id="supername">Supervisor Name: '.$row["supervisor_firstname"].' '.$row["supervisor_lastname"].'</span>
                    <a onclick="return confirm(\'Delete this record?\')" href="admin_appointment_delete.php?id='.$row["appointment_ID"].'" id="delete"><i class="bx bx-trash"></i></a>
                </div>';
            }
        }
    } else{
            
        $result = mysqli_query($con,"SELECT appointment.appointment_ID, appointment.appointment_data,
        appointment.appointment_description, appointment.is_approve, appointment.appointment_datetime,
        student.student_firstname, student.student_lastname, supervisor.supervisor_firstname, 
        supervisor.supervisor_lastname FROM appointment
        JOIN student ON appointment.student_ID = student.student_ID
        JOIN supervisor ON appointment.supervisor_ID = supervisor.supervisor_ID
        WHERE appointment_ID LIKE '%$search%' OR student_firstname LIKE '%$search%' OR student_lastname LIKE '%$search%'
        OR supervisor_firstname LIKE '%$search%' OR supervisor_lastname LIKE '%$search%' OR appointment_data LIKE '%$search%'
        ORDER BY appointment_ID DESC");

        while ($row = mysqli_fetch_array($result)){
            if($row["is_approve"] == 0){
                echo'
                <div id="insidecontainer">
                    <div id="mystatus1"></div>
                    <span id="aid">Appointment ID: '.$row["appointment_ID"].'</span>
                    <span id="adata">'.$row["appointment_data"].'</span>
                    <span id="adesc">Description: '.$row["appointment_description"].'</span>
                    <span id="atime">Appointment Date: '.$row["appointment_datetime"].'</span>
                    <span id="studname">Student Name: '.$row["student_firstname"].' '.$row["student_lastname"].'</span>
                    <span id="supername">Supervisor Name: '.$row["supervisor_firstname"].' '.$row["supervisor_lastname"].'</span>
                    <a onclick="return confirm(\'Delete this record?\')" href="admin_appointment_delete.php?id='.$row["appointment_ID"].'" id="delete"><i class="bx bx-trash"></i></a>
                </div>';
            }
            else if($row["is_approve"] == 1){
                echo'
                <div id="insidecontainer">
                    <div id="mystatus2"></div>
                    <span id="aid">Appointment ID: '.$row["appointment_ID"].'</span>
                    <span id="adata">'.$row["appointment_data"].'</span>
                    <span id="adesc">Description: '.$row["appointment_description"].'</span>
                    <span id="atime">Appointment Date: '.$row["appointment_datetime"].'</span>
                    <span id="studname">Student Name: '.$row["student_firstname"].' '.$row["student_lastname"].'</span>
                    <span id="supername">Supervisor Name: '.$row["supervisor_firstname"].' '.$row["supervisor_lastname"].'</span>
                    <a onclick="return confirm(\'Delete this record?\')" href="admin_appointment_delete.php?id='.$row["appointment_ID"].'" id="delete"><i class="bx bx-trash"></i></a>
                </div>';
            }
            else if($row["is_approve"] == 2){
                echo'
                <div id="insidecontainer">
                    <div id="mystatus3"></div>
                    <span id="aid">Appointment ID: '.$row["appointment_ID"].'</span>
                    <span id="adata">'.$row["appointment_data"].'</span>
                    <span id="adesc">Description: '.$row["appointment_description"].'</span>
                    <span id="atime">Appointment Date: '.$row["appointment_datetime"].'</span>
                    <span id="studname">Student Name: '.$row["student_firstname"].' '.$row["student_lastname"].'</span>
                    <span id="supername">Supervisor Name: '.$row["supervisor_firstname"].' '.$row["supervisor_lastname"].'</span>
                    <a onclick="return confirm(\'Delete this record?\')" href="admin_appointment_delete.php?id='.$row["appointment_ID"].'" id="delete"><i class="bx bx-trash"></i></a>
                </div>';
            }
        }
    }
?>


    </div>



    <script>
        let title = document.getElementById("title");
        title.innerHTML="Appointments";
    </script>
</body>
</html>