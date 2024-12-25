<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program</title>
    <link rel="stylesheet" href="admin_program_inner.css">
</head>
<body>
    <?php
        include("admin_navigator.php");
        include("conn.php");
        $id = intval($_GET['id']);

        $result = mysqli_query($con,"SELECT * FROM program WHERE program_ID = $id");
        while ($row = mysqli_fetch_array($result)){
    ?>

    <form action="admin_program_inner_update.php" enctype="multipart/form-data" method="POST">
    <div class="innerprogrambg">

        <input type="hidden" name="programs_ID" value="<?php echo $row['program_ID'] ?>">

        <a href="admin_program.php" id="backicon"><i class='bx bx-chevrons-left'></i> Back</a>

         <div id="profileimage"><img id="profileimage2" src="data:image;base64,<?php echo $row["program_icon"]?>"><input type="file" name="program_icon" id="img" style="display:none;"/>
            <label for="img" id="changeimg">Click me to upload image</label>
        </div>

        <span id="progid">Program ID:<br>
            <input type="text" readonly class="inputtext" placeholder="Program ID" readonly value=<?php echo $row["program_ID"]?> name="program_ID">
        </span>

        <span id="progname">Program Name: <br>
            <input type="text" class="inputtext" value="<?php echo $row["program_name"]?>" name="program_name">
        </span>

        <span id="progdate">Created At: <br>
            <input type="date" class="inputtext" readonly value="<?php echo $row["created_at"]?>" name="program_date">
        </span>

        <span id="progstatus">Status: <br>
            <input type="radio" id="active" value = 1 <?php if($row['is_active']== 1){echo "checked";} ?> name="program_status">
            <label for="active">Active</label>
            <input type="radio" id="inactive" value = 0 <?php if($row['is_active']== 0){echo "checked";} ?> name="program_status">
            <label for="inactive">Inactive</label>
        </span>

        <button type="submit" id="progsubmit">Save Changes</button>
        
        </form>

        <?php
        }
        ?>

        <hr id="progdivider">

        <?php
            $result = mysqli_query($con,"SELECT * FROM supervisor WHERE program_ID = $id");
            $supervisorcount = mysqli_num_rows($result);
        ?>

        <span id="progsuper">Supervisors -  <?php echo $supervisorcount ?> </span>
        <div class="progbg1">

        <?php
            $result = mysqli_query($con,"SELECT * FROM supervisor WHERE program_ID = $id");
            while ($row = mysqli_fetch_array($result)){
                echo'
                    <div class="superbg">
                        <div id="progprofile"><img id="progprofile2" src="data:image;base64,'.$row['supervisor_profilepic'].'"></div>
                        <span id="programname"> '. $row["supervisor_firstname"].' '. $row["supervisor_lastname"].' </span>
                        <span id="programemail">'. $row["supervisor_email"].' </span>
                        <a href="admin_supervisor_edit.php?id='.$row['supervisor_ID'].'" target="_blank"><span id="programedit"><i class="bx bx-edit-alt"></i></span></a>
                    </div>';

            }
        ?>
        </div>

        <?php
            $result = mysqli_query($con,"SELECT * FROM student WHERE program_ID = $id");
            $studentcount = mysqli_num_rows($result);
        ?>

        <span id="progstud">Students - <?php echo $studentcount ?></span>
        <div class="progbg2">
        
        <?php
            $result = mysqli_query($con,"SELECT * FROM student WHERE program_ID = $id");
            $supervisorcount = mysqli_num_rows($result);
            while ($row = mysqli_fetch_array($result)){
                echo'
                <div class="superbg">
                    <div id="progprofile"><img id="progprofile2" src="data:image;base64,'.$row['student_profilepic'].'"></div>
                    <span id="programname">  '. $row["student_firstname"].' '. $row["student_lastname"].' </span>
                    <span id="programemail"> '. $row["student_email"].' </span>
                    <a href="admin_student_edit.php?id='.$row['student_ID'].'" target="_blank"><span id="programedit"><i class="bx bx-edit-alt"></i></span></a>
                </div>';
            }
        ?>
        </div>
        

        <hr class="spacing">

    </div>
    


    <script>
        let title = document.getElementById("title");
        title.innerHTML="Programs";
        document.getElementById("nav_prog").className = "active"; 
    </script>
</body>
</html>