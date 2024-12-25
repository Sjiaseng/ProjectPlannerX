<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="admin_profile.css">
</head>
<body>
    <?php
        include("admin_navigator.php");
        include("conn.php");
        $adminID = $_SESSION["id"];
        $result = mysqli_query($con,"SELECT * FROM admin WHERE admin_ID = $adminID");
        while ($row = mysqli_fetch_array($result))
            {
    ?>

    <form action= "admin_profile_update.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="admin_ID" value="<?php echo $row['admin_ID'] ?>">
    <div class="profile">
        <div id="profileimage"><img id="adimg" src="data:image;base64,<?php echo $row['admin_profilepic']?>"><input type="file" name="admin_profilepic" id="img" style="display:none;"/>
                <label for="img" id="changeimg">Click me to upload image</label>
        </div>

        <span class="myid"> Admin ID: <?php echo $row["admin_ID"]?> </span>
        <span class="mydate"> Date Registered: <?php echo $row["admin_register_date"]?></span>

        <div id="informationbackground">
            <hr id="divider">
            <span id="first">First Name:<br><br>
                <input type="text" placeholder="First Name" class="inputbox" value="<?php echo $row['admin_firstname']?>" name="admin_firstname" required pattern="[^\d]+" title="Digits are not allowed!">
            </span>

                <span id="last">Last Name: <br><br>
                    <input type="text" placeholder="Last Name" class="inputbox" value="<?php echo $row["admin_lastname"]?>" name="admin_lastname" required pattern="[^\d]+" title="Digits are not allowed!">
                </span>
            

            <span id="gender">Gender: <br><br>
                <select class="inputbox2" name="admin_gender" required>
                    <option value="none" <?php if ($row['admin_gender'] == "none") { ?>selected="selected"<?php } ?>>none</option>
                    <option value="male" <?php if ($row['admin_gender'] == "male") { ?>selected="selected"<?php } ?>>male</option>
                    <option value="female" <?php if ($row['admin_gender'] == "female") { ?>selected="selected"<?php } ?>>female</option>
                </select>
            </span>

            <span id="ic">IC Number: <br><br>
                <input type="text" placeholder="IC Number" class="inputbox" value="<?php echo $row["admin_ic"]?>" name="admin_ic" required pattern="[0-9]+" title="Only Integers are Accepted!">
            </span>

            <span id="bday">Birth Date:<br><br>
                <input type="date" placeholder="Birthday" class="inputbox" value="<?php echo $row["admin_birthdate"]?>" name="admin_birthdate">
            </span>

            <span id="mobilenum">Mobile Number: <br><br>
                <input type="tel" placeholder="Mobile Number" class="inputbox" value="<?php echo $row["admin_mobilenum"]?>" name="admin_mobilenum" required pattern="[0-9]+" title="Only Integers are Accepted!">
            </span>

            <span id="address">Address: <br><br>
                <textarea placeholder="Address:" class="textarea" required name="admin_address"><?php echo $row["admin_address"]?></textarea>
            </span>

            <span id="country">Country: <br><br>
                <select class="inputbox2" name="admin_country" required>
                    <option value="None" <?php if ($row['admin_country'] == "None") { ?>selected="selected"<?php } ?>>None</option>
                    <option value="Malaysia" <?php if ($row['admin_country'] == "Malaysia") { ?>selected="selected"<?php } ?>>Malaysia</option>
                    <option value="Other" <?php if ($row['admin_country'] == "Other") { ?>selected="selected"<?php } ?>>Other</option>
                </select>
            </span>
        </div>

        <button type="submit" name="adminsave" id="profilesave">Save Changes</button>

        <div id="credentialbutton" onclick=credentials()>Login Credential</div>

        <div id="logincredentials">

            <span id="loginemail">Email: <br><br>
                <input type="email" placeholder="Email Address" required class="inputbox3" value="<?php echo $row["admin_email"]?>" name="admin_email">
            </span>

            <span id="loginpassword">Password: <br><br>
                <input type="password" placeholder="Password" minlength="6" title="Minimum 6 characters or digits!" class="inputbox3" id="passwordview" value="<?php echo $row["admin_password"]?>" name="admin_password"><i class='bx bx-show' id="showpassword" onclick=password()></i>
            </span>

        </div>

    </div>
    </form>

    <?php
        }
    ?>

    <script>
        let title = document.getElementById("title");
        title.innerHTML="Profile";

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
    </script>
</body>
</html>