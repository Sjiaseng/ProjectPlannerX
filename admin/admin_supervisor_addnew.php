<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="admin_supervisor_addnew.css">
</head>
<body>
    <?php
        include("admin_navigator.php");

    ?>

    <form action="admin_supervisor_insert.php" enctype="multipart/form-data" method="POST">
    <div class="profile">

        <div id="profileimage"><input type="file" name="supervisor_profilepic" id="img" style="display:none;"/>
                <label for="img" id="changeimg">Click me to upload image</label>
        </div>

        <span class="myid"> Supervisor ID: Autogenerated </span>
        <span class="myprogram">Program ID: Autogenerated </span>
        <span class="mydate"> Date Registered: Autogenerated</span>

        <div id="informationbackground">
            <hr id="divider">
            <span id="first">First Name:<br><br>
                <input type="text" placeholder="First Name" class="inputbox"  name="supervisor_firstname" required pattern="[^\d]+" title="Digits are not allowed!">
            </span>

            <span id="last">Last Name: <br><br>
                <input type="text" placeholder="Last Name" class="inputbox" name="supervisor_lastname" required pattern="[^\d]+" title="Digits are not allowed!">
            </span>

            <span id="gender">Gender: <br><br>
                <select class="inputbox2" name="supervisor_gender" required> 
                    <option value="none" >none</option>
                    <option value="male" >male</option>
                    <option value="female" > female </option>
                </select>
            </span>

            <span id="ic">IC Number: <br><br>
                <input type="text" placeholder="IC Number" class="inputbox"  name="supervisor_ic" required pattern="[0-9]+" title="Only Integers are Accepted!">
            </span>

            <span id="bday">Birth Date:<br><br>
                <input type="date" placeholder="Birthday" class="inputbox"  name="supervisor_birthdate" required>
            </span>

            <span id="mobilenum">Mobile Number: <br><br>
                <input type="tel" placeholder="Mobile Number" class="inputbox"  name="supervisor_mobilenum" required pattern="[0-9]+" title="Only Integers are Accepted!">
            </span>

            <span id="address">Address: <br><br>
                <textarea placeholder="Address:" class="textarea" name="supervisor_address" required></textarea>
            </span>

            <span id="country">Country: <br><br>
                <select class="inputbox2" name="supervisor_country" required>
                    <option value="None">None</option>
                    <option value="Malaysia" >Malaysia</option>
                    <option value="Other">Other</option>
                </select>
            </span>


            <span id="programme">Program: <br><br>
                <select class="inputbox2" name="supervisor_program" required>
                    <option value="none">none</option>
                    <?php            
                        $result = mysqli_query($con,"SELECT program_name FROM program");
                        while ($row = mysqli_fetch_array($result)){
                            echo '<option value="'.$row["program_name"].'">'.$row["program_name"].'</option>';
                        };
                    ?>
                </select>
            </span>
        </div>

        <button id="profilesave">Save Changes</button>

        <div id="credentialbutton" onclick=credentials()>Login Credential</div>
        

        <div id="logincredentials">

            <span id="loginemail">Email: <br><br>
                <input type="email" placeholder="Email Address" class="inputbox3"  name="supervisor_email" required>
            </span>

            <span id="loginpassword">Password: <br><br>
                <input type="password" placeholder="Password" minlength="6" title="Minimum 6 characters or digits!" required class="inputbox3" id="passwordview" name="supervisor_password"><i class='bx bx-show' id="showpassword" onclick=password()></i>
            </span>
        </div>
    </div>
    </form>   

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