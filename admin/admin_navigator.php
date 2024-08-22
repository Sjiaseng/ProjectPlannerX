<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="admin_navigator.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <title>Navigator</title>
</head>
<body>
    <?php
        $page = basename($_SERVER['PHP_SELF']);
        include("conn.php");
        include("session.php");

        $adminID = $_SESSION["id"];
    ?>
    <nav>
        <div id="navpic">
        <img src="http://localhost/admin/image/Logo.png" id="navigatorpicture">
        </div>
        <ul>
            <span id="title1">NAVIGATIONS</span>
            <div class="content1">
                <a href="admin_dashboard.php">
                    <li class="<?php if ( $page == "admin_dashboard.php" ): echo "active"; else: echo "main"; endif; ?>"><span id="text"><i class='bx bx-home-alt-2' id="icon"></i>Dashboard</span></li>
                </a>
                <a href="admin_student.php">
                    <li id="nav_student" class="<?php if ( $page == "admin_student.php" ): echo "active"; else: echo "main"; endif; ?>"><span id="text"><i class='bx bx-user' id="icon"></i>Students</span></li>
                </a>
                <a href="admin_supervisor.php">
                    <li id="nav_super" class="<?php if ( $page == "admin_supervisor.php" ): echo "active"; else: echo "main"; endif; ?>"><span id="text"><i class='bx bxs-user-rectangle' id="icon"></i>Supervisors</span></li>
                </a>
                <a href="admin_program.php">
                    <li id="nav_prog" class="<?php if ( $page == "admin_program.php" ): echo "active"; else: echo "main"; endif; ?>"><span id="text"><i class='bx bx-folder-open' id="icon"></i>Programs</span></li>
                </a>
                <a href="admin_assignment.php">
                    <li id="nav_ass" class="<?php if ( $page == "admin_assignment.php" ): echo "active"; else: echo "main"; endif; ?>"><span id="text"><i class='bx bx-windows'id="icon"></i>Assignments</span></li>
                </a>
                <a href="admin_appointment.php">
                    <li class="<?php if ( $page == "admin_appointment.php" ): echo "active"; else: echo "main"; endif; ?>"><span id="text"><i class='bx bx-bookmarks' id="icon"></i></i>Appointments</span></li>
                </a>

            </div>

            <hr>

            <span id="title2">ACCOUNT</span>
            <div class="content2">
                <a href="admin_profile.php">
                    <li class="<?php if ( $page == "admin_profile.php" ): echo "active"; else: echo "main"; endif; ?>"><span id="text"><i class='bx bx-at'id="icon" ></i>My Profile</span></li>
                </a>
                <a href="admin_contact.php">
                    <li id="nav_contact" class="<?php if ( $page == "admin_contact.php" ): echo "active"; else: echo "main"; endif; ?>"><span id="text"><i class='bx bx-phone' id="icon"></i>Contact Us</span></li>
                </a>
                <a href="admin_admin.php">
                    <li id="nav_admin" class="<?php if ( $page == "admin_admin.php" ): echo "active"; else: echo "main"; endif; ?>"><span id="text"><i class='bx bx-wrench'id="icon"></i>Admins</span></li>
                </a>
            </div>

            <hr>

            <span id="title3">REPORTS</span>
            <div class="content3">
                <a href="admin_report.php">
                    <li class="<?php if ( $page == "admin_report.php" ): echo "active"; else: echo "main"; endif; ?>"><span id="text"><i class='bx bxs-report' id="icon"></i>Reports</span></li>
                </a>
            </div>

        </ul>
    </nav>

    <div class="header">

        <i class='bx bx-search' id="searchicon" ></i><input type="text" placeholder="Search" id="searchbar" readonly>

        <?php 
        $notification = mysqli_query($con,"SELECT * FROM notification WHERE admin_ID = $adminID AND is_read = 0");
        $notificationcount = mysqli_num_rows($notification);

        if ($notificationcount > 0){
            echo '<i class="bx bxs-bell-ring" id="notification" title="Notification" onclick=notification()></i>';
        } else
            echo '<i class="bx bxs-bell" id="notification" title="Notification" onclick=notification()></i>';
        ?>

        <?php
            $result = mysqli_query($con,"SELECT * FROM admin WHERE admin_ID = $adminID");
            while ($row = mysqli_fetch_array($result)){
                echo'
                <span id="username">'.$row["admin_firstname"].' '.$row["admin_lastname"].'</span>
                <img id="profilepic" src="data:image;base64,'.$row['admin_profilepic'].'">';
            }
        ?>

        <a href="logout.php"><button id="logoutbutton"><i class='bx bx-log-out' id="logouticon" ></i> Logout</button></a>
    </div>

    <div id="title">
        Title
    </div>
    
    <div class="notificationboard" id="notificationboard">


        <div id="notificationtitle">
            <span id="notification2">Notifications</span>
            <?php
            $result = mysqli_query($con,"SELECT * FROM notification WHERE admin_ID = $adminID ORDER BY is_read");
            while ($row = mysqli_fetch_array($result)){
             echo '<a href="admin_notification_marked.php?id='.$row["admin_ID"].'"><i class="bx bx-show" id="readicon" title="Mark all as Read"></i></a>';}
            ?>
        </div>
        <?php
            $result = mysqli_query($con,"SELECT * FROM notification WHERE admin_ID = $adminID ORDER BY is_read");
            while ($row = mysqli_fetch_array($result)){
                if($row["is_read"] == 0){
                    echo '
                        <div id="noreadnotification">
                            <span id="notititle">'.$row["notification_title"].'</span> <br>
                            <span id="notimessage">'.$row["notification_message"].'</span>
                            <span id="notidate">Date: '.$row["created_at"].'</span>
                            <a href="admin_notification_delete.php?id='.$row["notification_ID"].'"><span id="deleteicon"><i class="bx bx-x" ></i></span></a>
                        </div>';
                } else {
                    echo '
                        <div id="readnotification">
                            <span id="notititle">'.$row["notification_title"].'</span> <br>
                            <span id="notimessage">'.$row["notification_message"].'</span>
                            <span id="notidate">Date: '.$row["created_at"].'</span>
                            <a href="admin_notification_delete.php?id='.$row["notification_ID"].'"><span id="deleteicon"><i class="bx bx-x" ></i></span></a>
                        </div>';
                }
            }
        ?>

    </div>

    <script>
        var flag = true;
        function notification(){
            let notificationboard = document.getElementById("notificationboard");
            notificationboard.style.display = flag ? "block" + $("#notificationboard").slideDown() : "none" + $("#notificationboard").slideUp(); 
            flag = !flag; 
        }


    </script>

</body>
</html>