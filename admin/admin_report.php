<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="admin_report.css">
</head>
<body>
    <?php
        include("admin_navigator.php");
    ?>

    <div class="reportbackground">
        <a href="submission_report.php"><div class="submission"><img src="http://localhost/admin/image/submit.png" id="subpicture"><button id="submission">Generate Report</button></a></div>
        <a href="grade_report.php"><div class="grading"><img src="http://localhost/admin/image/grade.png" id="gradepicture"><button id="grading">Generate Report</button></a></div>
        <a href="certificate.php"><div class="certificate"><img src="http://localhost/admin/image/certificate.png" id="certpicture"><button id="certificate">Generate Certificate</button></a></body>
    </div>

    <script>
        let title = document.getElementById("title");
        title.innerHTML="Reports";
    </script>
</body>
</html>