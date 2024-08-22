<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="admin_supervisor_edit.css">
</head>
<body>
    <?php
        include("admin_navigator.php");
        include("conn.php");
        $id = intval($_GET['id']);

        $result = mysqli_query($con,"SELECT supervisor.supervisor_ID, supervisor.supervisor_email, supervisor.supervisor_password,
        supervisor.supervisor_firstname, supervisor.supervisor_lastname, supervisor.supervisor_birthdate,
        supervisor.supervisor_gender, supervisor.supervisor_mobilenum, supervisor.supervisor_address, supervisor.supervisor_country,
        supervisor.supervisor_ic, supervisor.supervisor_register_date, supervisor.is_active, supervisor.supervisor_profilepic,
        supervisor.program_ID, program.program_name FROM supervisor JOIN program ON supervisor.program_ID = program.program_ID  WHERE supervisor.supervisor_ID = $id;");

        
        while ($row = mysqli_fetch_array($result))
            {
    ?>

    <form action="admin_supervisor_update.php" enctype="multipart/form-data" method="POST">
    <div class="profile">

        <input type="hidden" name="supervisor_ID" value="<?php echo $row['supervisor_ID'] ?>">

        <div id="profileimage"><img class="superimg" src="data:image;base64,<?php echo $row['supervisor_profilepic']?>"><input type="file" name="supervisor_profilepic" id="img" style="display:none;"/>
                <label for="img" id="changeimg">Click me to upload image</label>
        </div>

        <span class="myid"> Supervisor ID: <?php echo $row["supervisor_ID"] ?> </span>
        <span class="myprogram">Program ID: <?php echo $row["program_ID"] ?> </span>
        <span class="mydate"> Date Registered: <?php echo $row["supervisor_register_date"] ?></span>

        <div id="informationbackground">
            <hr id="divider">
            <span id="first">First Name:<br><br>
                <input type="text" placeholder="First Name" class="inputbox" value="<?php echo $row["supervisor_firstname"]?>" name="supervisor_firstname" pattern="[^\d]+" title="Digits are not allowed!" required>
            </span>

            <span id="last">Last Name: <br><br>
                <input type="text" placeholder="Last Name" class="inputbox" value="<?php echo $row["supervisor_lastname"]?>" name="supervisor_lastname" pattern="[^\d]+" title="Digits are not allowed!" required>
            </span>

            <span id="gender">Gender: <br><br>
                <select class="inputbox2" name="supervisor_gender" required> 
                    <option value="none" <?php if ($row['supervisor_gender'] == "none") { ?>selected="selected"<?php } ?>>none</option>
                    <option value="male" <?php if ($row['supervisor_gender'] == "male") { ?>selected="selected"<?php } ?>>male</option>
                    <option value="female" <?php if ($row['supervisor_gender'] == "female") { ?>selected="selected"<?php } ?>> female </option>
                </select>
            </span>

            <span id="ic">IC Number: <br><br>
                <input type="text" placeholder="IC Number" class="inputbox" value="<?php echo $row["supervisor_ic"]?>" name="supervisor_ic" required pattern="[0-9]+" title="Only Integers are Accepted!">
            </span>

            <span id="bday">Birth Date:<br><br>
                <input type="date" placeholder="Birthday" class="inputbox" value="<?php echo $row["supervisor_birthdate"]?>" name="supervisor_birthdate" required>
            </span>

            <span id="mobilenum">Mobile Number: <br><br>
                <input type="tel" placeholder="Mobile Number" class="inputbox" value="<?php echo $row["supervisor_mobilenum"]?>" name="supervisor_mobilenum" required pattern="[0-9]+" title="Only Integers are Accepted!">
            </span>

            <span id="address">Address: <br><br>
                <textarea placeholder="Address:" class="textarea" required name="supervisor_address"><?php echo $row["supervisor_address"]?></textarea>
            </span>

            <span id="country">Country: <br><br>
                <select class="inputbox2" name="supervisor_country" required>
                    <option value="None" <?php if ($row['supervisor_country'] == "None") { ?>selected="selected"<?php } ?>>None</option>
                    <option value="Malaysia" <?php if ($row['supervisor_country'] == "Malaysia") { ?>selected="selected"<?php } ?>>Malaysia</option>
                    <option value="Other" <?php if ($row['supervisor_country'] == "Other") { ?>selected="selected"<?php } ?>>Other</option>
                </select>
            </span>

            <?php
            }
            ?>

            <?php
                $result = mysqli_query($con, "SELECT program_ID FROM supervisor WHERE supervisor_ID = $id");
                while ($row = mysqli_fetch_array($result)){
                    $programid = $row["program_ID"];
                }
            ?>

            <span id="programme">Program: <br><br>
                <select class="inputbox2" name="supervisor_program" required>
                    <option value="none">none</option>
                    
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

        <button id="profilesave">Save Changes</button>

        <div id="credentialbutton" onclick=credentials()>Login Credential</div>
        
        <?php
            $result = mysqli_query($con,"SELECT * FROM supervisor WHERE supervisor_ID = $id");
            while ($row = mysqli_fetch_array($result)){

        ?>
        <div id="logincredentials">

            <span id="loginemail">Email: <br><br>
                <input type="email" placeholder="Email Address" class="inputbox3" value="<?php echo $row["supervisor_email"]?>" name="supervisor_email" required>
            </span>

            <span id="loginpassword">Password: <br><br>
                <input type="password" placeholder="Password" minlength="6" title="Minimum 6 characters or digits!" class="inputbox3" id="passwordview" name="supervisor_password" value="<?php echo $row["supervisor_password"]?>"><i class='bx bx-show' id="showpassword" onclick=password()></i>
            </span>
        </div>

        <?php
            }
        ?>
        
        </form>
    </div>
   

    <script>
        let title = document.getElementById("title");
        title.innerHTML="Editing Supervisor";

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
        document.getElementById("nav_super").className = "active"; 
    </script>
</body>
</html>