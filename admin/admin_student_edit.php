<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="admin_student_edit.css">
</head>
<body>
    <?php
        include("admin_navigator.php");
        include("conn.php");
        $id = intval($_GET['id']);
        $result = mysqli_query($con,"SELECT student.student_ID, student.student_email, student.student_password, student.student_firstname, 
        student.student_lastname, student.student_birthdate, student.student_gender, student.student_mobilenum, student.student_address,
        student.student_country, student.student_ic, student.student_register_date, student.is_active, student.student_profilepic, student.program_ID,
        student.supervisor_ID, supervisor.supervisor_profilepic, program.program_name FROM student JOIN program ON program.program_ID = student.program_ID
        JOIN supervisor ON supervisor.supervisor_ID = student.supervisor_ID WHERE student.student_ID = $id;");
        
        while ($row = mysqli_fetch_array($result))
            {
    ?>
    
    <form action="admin_student_update.php" method= "POST" enctype="multipart/form-data">
    <div class="profile">

        <input type="hidden" name="student_ID" value="<?php echo $row['student_ID'] ?>">

        <div id="profileimage"><img id="stuimg" src="data:image;base64,<?php echo $row['student_profilepic']?>"><input type="file" name="student_profilepic" id="img" style="display:none;"/>
                <label for="img" id="changeimg">Click me to upload image</label>
        </div>

        <span class="myid"> Student ID: <?php echo $row["student_ID"]?> </span>
        <span class="mydate"> Date Registered: <?php echo $row["student_register_date"]?></span>

        <div id="informationbackground">
            <hr id="divider">
            <span id="first">First Name:<br><br>
                <input type="text" placeholder="First Name" class="inputbox" value="<?php echo $row["student_firstname"]?>" name="student_firstname" required pattern="[^\d]+" title="Digits are not allowed!">
            </span>

            <span id="last">Last Name: <br><br>
                <input type="text" placeholder="Last Name" class="inputbox" value="<?php echo $row["student_lastname"]?>" name="student_lastname" required pattern="[^\d]+" title="Digits are not allowed!">
            </span>

            <span id="gender">Gender: <br><br>
                <select class="inputbox2" name="student_gender" required>
                    <option value="none" <?php if ($row['student_gender'] == "none") { ?>selected="selected"<?php } ?>>none</option>
                    <option value="male" <?php if ($row['student_gender'] == "male") { ?>selected="selected"<?php } ?>>male</option>
                    <option value="female" <?php if ($row['student_gender'] == "female") { ?>selected="selected"<?php } ?>>female</option>
                </select>
            </span>

            <span id="ic">IC Number: <br><br>
                <input type="text" placeholder="IC Number" class="inputbox" value="<?php echo $row["student_ic"]?>" name="student_ic" required pattern="[0-9]+" title="Only Integers are Accepted!">
            </span>

            <span id="bday">Birth Date:<br><br>
                <input type="date" placeholder="Birthday" class="inputbox" value="<?php echo $row["student_birthdate"]?>" name="student_birthdate" required>
            </span>

            <span id="mobilenum">Mobile Number: <br><br>
                <input type="tel" placeholder="Mobile Number" class="inputbox" value="<?php echo $row["student_mobilenum"]?>" name="student_mobilenum" required pattern="[0-9]+" title="Only Integers are Accepted!">
            </span>

            <span id="address">Address: <br><br>
                <textarea placeholder="Address:" class="textarea" name="student_address" required><?php echo $row["student_address"]?></textarea>
            </span>

            <span id="country">Country: <br><br>
                <select class="inputbox2" name="student_country" required>
                    <option value="None" <?php if ($row['student_country'] == "None") { ?>selected="selected"<?php } ?>>None</option>
                    <option value="Malaysia" <?php if ($row['student_country'] == "Malaysia") { ?>selected="selected"<?php } ?>>Malaysia</option>
                    <option value="Other" <?php if ($row['student_country'] == "Other") { ?>selected="selected"<?php } ?>>Other</option>
                </select>
            </span>
        </div>

        <button type="submit" id="profilesave">Save Changes</button>

        <div id="credentialbutton" onclick=credentials()>Login Credential</div>

        <div id="logincredentials">

            <span id="loginemail">Email: <br><br>
                <input type="email" placeholder="Email Address" class="inputbox3" value="<?php echo $row["student_email"]?>" name="student_email" required>
            </span>

            <span id="loginpassword">Password: <br><br>
                <input type="password" placeholder="Password" minlength="6" title="Minimum 6 characters or digits!" required class="inputbox3" name="student_password" id="passwordview" value="<?php echo $row["student_password"]?>"><i class='bx bx-show' id="showpassword" onclick=password()></i>
            </span>

        </div>
        

    </div>

    
    <div class="studside">
        <span id="studtitle">Supervised By:</span>
        <div id="superpic"><img id="superpic2" src="data:image;base64,<?php echo $row['supervisor_profilepic']?>"></div>

        <span class="superid">Supervisor ID: <?php echo $row["supervisor_ID"] ?></span>
        <br>
    <?php
        }
    ?>

    <?php
            $result4 = mysqli_query($con, "SELECT supervisor_ID FROM student WHERE student_ID = $id");
            while ($row = mysqli_fetch_array($result4)){
                $superid = $row["supervisor_ID"];
            }
        ?>

        <span class="super1">Supervisor Name: <br><br>
        <select placeholder="supername" id="supername" name="student_supervisor" required>
            <option value="none"> none </option>
            <?php
                $result5 = mysqli_query($con, "SELECT * FROM supervisor WHERE supervisor_ID = '$superid'");
                while ($row = mysqli_fetch_array($result5)){
                    echo '<option selected value="'.$row["supervisor_firstname"].' '.$row["supervisor_lastname"] .'">'.$row["supervisor_firstname"].' '.$row["supervisor_lastname"] .'</option>';
                }

                $result6 = mysqli_query($con, "SELECT * FROM supervisor WHERE supervisor_ID <> '$superid'");
                while ($row = mysqli_fetch_array($result6)){
                    echo '<option value="'.$row["supervisor_firstname"].' '.$row["supervisor_lastname"] .'">'.$row["supervisor_firstname"].' '.$row["supervisor_lastname"] .'</option>';
                }

                    ?>
        </select>
        </span>
    <?php
    $result = mysqli_query($con,"SELECT student.student_ID, student.student_email, student.student_password, student.student_firstname, 
    student.student_lastname, student.student_birthdate, student.student_gender, student.student_mobilenum, student.student_address,
    student.student_country, student.student_ic, student.student_register_date, student.is_active, student.student_profilepic, student.program_ID,
    student.supervisor_ID, supervisor.supervisor_profilepic, program.program_name FROM student JOIN program ON program.program_ID = student.program_ID
    JOIN supervisor ON supervisor.supervisor_ID = student.supervisor_ID WHERE student.student_ID = $id;");
                
    while ($row = mysqli_fetch_array($result))
        {
    ?>
        <br>
        <span class="progid">Program ID: <?php echo $row["program_ID"] ?></span>
        <br>
        
        <?php
            $result = mysqli_query($con, "SELECT program_ID FROM student WHERE student_ID = $id");
            while ($row = mysqli_fetch_array($result)){
                $programid = $row["program_ID"];
            }
        ?>

        <span class="super1">Program Name: <br><br>
        <select placeholder="progname" id="progname" name="student_program" required>
            <option value="none"> none </option>
            <?php
                    $result2 = mysqli_query($con, "SELECT * FROM program WHERE program_ID = '$programid'");
                    while ($row = mysqli_fetch_array($result2)){
                        echo '<option selected value="'.$row["program_name"].'">'.$row["program_name"].'</option>';
                    }

                    $result3 = mysqli_query($con, "SELECT * FROM program WHERE program_ID <> '$programid'");
                    while ($row = mysqli_fetch_array($result3)){
                        echo '<option value="'.$row["program_name"].'">'.$row["program_name"].'</option>';
                    }

                    ?>
        </select>
        </span>
    </div>
    <?php
     }
    ?>

    </form>


    <script>
        let title = document.getElementById("title");
        title.innerHTML="Editing Student";

        var login = true;
        function credentials(){
            let loginboard = document.getElementById("logincredentials");
            loginboard.style.display = login ? "block" + $("#logincredentials").slideDown() : "none" + $("#logincredentials").slideUp(); 
            login = !login; 
        }

        function password(){
            let passwordField = document.getElementById("passwordview");

            if(passwordField.type == 'password') {
                passwordField.type = 'text';
            }
            else {
                passwordField.type = 'password';
            }
        } 

        document.getElementById("nav_student").className = "active"; 
    </script>
</body>
</html>