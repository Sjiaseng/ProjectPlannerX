<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="admin_admin_addnew.css">
</head>
<body>
    <?php
        include("admin_navigator.php");
        include("conn.php");
        
    ?>

    <form action="admin_admin_insert.php" method="post" enctype="multipart/form-data">
    <div class="profile">
    
    <input type="hidden" name="admin_register_date" value=<?php date("Y-m-d"); ?>>

        <div id="profileimage"><input type="file" name="admin_profilepic" id="img" style="display:none;"/>
                <label for="img" id="changeimg">Click me to upload image</label>
        </div>

        <span class="myid"> Admin ID: Auto Generated </span>
        <span class="mydate"> Date Registered: Auto Generated</span>

        <div id="informationbackground">
            <hr id="divider">
            <span id="first">First Name:<br><br>
                <input type="text" placeholder="First Name" class="inputbox" name="admin_firstname" required pattern="[^\d]+" title="Digits are not allowed!">
            </span>

            <span id="last">Last Name: <br><br>
                <input type="text" placeholder="Last Name" class="inputbox" name="admin_lastname" required pattern="[^\d]+" title="Digits are not allowed!">
            </span>

            <span id="gender">Gender: <br><br>
                <select class="inputbox2" name="admin_gender" required>
                    <option value="none" selected>none</option>
                    <option value="male">male</option>
                    <option value="female">female</option>
                </select>
            </span>

            <span id="ic">IC Number: <br><br>
                <input type="text" placeholder="IC Number" class="inputbox" name="admin_ic" required pattern="[0-9]+" title="Only Integers are Accepted!">
            </span>

            <span id="bday">Birth Date:<br><br>
                <input type="date" placeholder="Birthday" class="inputbox" name="admin_birthdate" required>
            </span>

            <span id="mobilenum">Mobile Number: <br><br>
                <input type="tel" placeholder="Mobile Number" class="inputbox" name="admin_mobilenum" required pattern="[0-9]+" title="Only Integers are Accepted!">
            </span>

            <span id="address">Address: <br><br>
                <textarea placeholder="Address:" class="textarea" name="admin_address" required></textarea>
            </span>

            <span id="country">Country: <br><br>
                <select class="inputbox2" name="admin_country" required>
                    <option value="None" >None</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Other">Other</option>
                </select>
            </span>
        </div>

        <button type="submit" id="profilesave"> Save Changes </button>

        <div id="credentialbutton" onclick=credentials()>Login Credential</div>

        <div id="logincredentials">

            <span id="loginemail">Email: <br><br>
                <input type="email" placeholder="Email Address" class="inputbox3" name="admin_email" required>
            </span>

            <span id="loginpassword">Password: <br><br>
                <input type="password" placeholder="Password" minlength="6" title="Minimum 6 characters or digits!" name="admin_password" class="inputbox3" id="passwordview"><i class='bx bx-show' id="showpassword" onclick=password()></i>
            </span>

        </div>

    </div>
    </form>

    <script>
        let title = document.getElementById("title");
        title.innerHTML="Admin Registration";

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
        document.getElementById("nav_admin").className = "active";  
    </script>
</body>
</html>