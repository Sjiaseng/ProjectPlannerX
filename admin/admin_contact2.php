<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="admin_contact2.css">
</head>
<body>
    <?php
        include("admin_navigator.php");
        include("conn.php");
        $id = intval($_GET['id']);
    ?>

    <span id="result">X results found!</span>
    <div class="searchinguser">
        <button type="submit" id="searchbutton"><i class='bx bx-search-alt-2'></i></button>
        <input type="text" name="searchuser" placeholder="Search here" id="searchbox">
    </div>


    <div class="contactbackground">

    <?php

        $sql = "SELECT * FROM contactus ORDER BY is_read ASC";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
            if ($row["is_read"] == 1){
                echo'
                <div id="contactbox">
                    <span id="contactid">Contact ID: '.$row["contactus_ID"].'</span>
                    <span id="contactname">Contact Name: '.$row["name"].' </span>
                    <span id="contactemail">Contact Email: '.$row["email"].'</span>
                    <span id="contactcreated">Created At: '.$row["created_at"].'</span>
                    <a href="admin_contact2.php?id='.$row["contactus_ID"].'"><div id="contactviewbutton">View</div></a>
                    <span id="contactdelete"><i class="bx bx-trash"></i></span>
                    <span id="viewed">Viewed <i class="bx bx-check-double" title="Viewed"></i></span>
                </div>';
            } else{
                echo'
                <div id="contactbox">
                    <span id="contactid">Contact ID: '.$row["contactus_ID"].'</span>
                    <span id="contactname">Contact Name: '.$row["name"].' </span>
                    <span id="contactemail">Contact Email: '.$row["email"].'</span>
                    <span id="contactcreated">Created At: '.$row["created_at"].' </span>
                    <a href="admin_contact2.php?id='.$row["contactus_ID"].'"><div id="contactviewbutton">View</div></a>
                    <span id="contactdelete"><i class="bx bx-trash"></i></span>
                </div>';
            }

        }
    ?>

    </div>

    <a href="admin_contact.php"><div class="background" id="mybackground"></div></a>
    
    <div class="contactback">
        <?php
        $result = mysqli_query($con,"SELECT * FROM contactus WHERE contactus_ID = $id;");
            
        while ($row = mysqli_fetch_array($result))
        {
            echo'
            <span id="contactname3">Name:</span> <input type="text" placeholder="Name" id="contactname2" value='.$row["name"].'>
            <span id="contactemail3"> Email: </span><input type="text" placeholder="Email" id="contactemail2" value='.$row["email"].'>
            <textarea placeholder="Message" id="contactmessage">'.$row["message"].'</textarea>
            <a href="mailto:'.$row["email"].'"><div id="replycontact"><i class="bx bx-reply"></i> Reply </div></a>
            <a href="admin_contact.php" class="closingcontact"><i class="bx bx-x"></i></a>';
        }
        ?>
    </div>
 

    <script>
        let title = document.getElementById("title");
        title.innerHTML="Contact Us";

        document.getElementById("nav_contact").className = "active"; 
    </script>
</body>
</html>