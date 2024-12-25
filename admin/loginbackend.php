<?php
include('./conn.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['acc-email']);
    $password = mysqli_real_escape_string($con, $_POST['acc-password']);
    $sql = "SELECT student_ID,is_active FROM student WHERE student_email='$email' and student_password='$password'";
    $sql2 = "SELECT supervisor_ID,is_active FROM supervisor WHERE supervisor_email='$email' and supervisor_password='$password'";
    $sql3 = "SELECT admin_ID FROM admin WHERE admin_email='$email' and admin_password='$password'";
    $result = mysqli_query($con, $sql);
    $result2 = mysqli_query($con, $sql2);
    $result3 = mysqli_query($con, $sql3);
    if ($result and $result2 and $result3) {
        $rowcount = mysqli_num_rows($result);
        $rowcount2 = mysqli_num_rows($result2);
        $rowcount3 = mysqli_num_rows($result3);
        $row = mysqli_fetch_assoc($result);
        $row2 = mysqli_fetch_assoc($result2);
        $row3 = mysqli_fetch_assoc($result3);
    }
    if ($rowcount == 1 || $rowcount2 == 1 || $rowcount3 == 1) {
        if ($rowcount == 1) {
            if ($row['is_active'] == 1) {
                $_SESSION['id'] = $row['student_ID'];
                echo '<script>
                        alert("Student Function Not Included In Here");
                        window.location.href = "./login.php"; 
                    </script>';
            } else {
                    '<script>
                        alert("Student Function Not Included In Here");
                        window.location.href = "./login.php"; 
                    </script>';
            }
        } elseif ($rowcount2 == 1) {
            if ($row2['is_active'] == 1) {
                $_SESSION['id'] = $row2['supervisor_ID'];
                    '<script>
                        alert("Supervisor Function Not Included In Here");
                        window.location.href = "./login.php"; 
                    </script>';
            } else {
                    '<script>
                        alert("Supervisor Function Not Included In Here");
                        window.location.href = "./login.php"; 
                    </script>';
            }
        } elseif ($rowcount3 == 1) {
            $_SESSION['id'] = $row3['admin_ID'];
            header("location: ./admin_dashboard.php");
        }
    } else {
        echo '<script>
                alert("Your Login Name or Password is invalid. Please re-login");
                window.location.href = "./login.php"; 
             </script>';
    }
}



mysqli_close($con);
?>