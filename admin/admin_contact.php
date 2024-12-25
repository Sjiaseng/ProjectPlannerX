<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="admin_contact.css">
</head>
<body>
    <?php
        include("admin_navigator.php");
        include("conn.php");

        if (isset($_GET["searchuser"]) == True){
            $search = $_GET["searchuser"];
        }
        else{
            $search = null;
        }

        $count = mysqli_query($con,"SELECT * FROM contactus WHERE contactus_ID LIKE '%$search%' OR name LIKE '%$search%' OR email LIKE '%$search%' ORDER BY is_read ASC");
        $mycount = mysqli_num_rows($count);
    ?>

    <form action="admin_contact.php" method="GET">
    <span id="result"><?php echo $mycount?> results found!</span>
    <div class="searchinguser">
        <button type="submit" id="searchbutton"><i class='bx bx-search-alt-2'></i></button>
        <input type="text" name="searchuser" placeholder="Search here" id="searchbox" value=<?php echo $search?>>
    </div>
    </form>
    
    <div class="contactbackground">
    <?php
    if (isset($search) == False){
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
                    <a onclick="return confirm(\'Delete this record?\')" href=admin_contact_delete?id='.$row["contactus_ID"].'><span id="contactdelete"><i class="bx bx-trash"></i></span>
                    <span id="viewed">Viewed <i class="bx bx-check-double" title="Viewed"></i></span>
                </div>';
            } else{
                echo'
                <div id="contactbox">
                    <span id="contactid">Contact ID: '.$row["contactus_ID"].'</span>
                    <span id="contactname">Contact Name: '.$row["name"].' </span>
                    <span id="contactemail">Contact Email: '.$row["email"].'</span>
                    <span id="contactcreated">Created At: '.$row["created_at"].' </span>
                    <a href=admin_contact_read.php?id='.$row["contactus_ID"].'><div id="contactviewbutton">View</div></a>
                    <a onclick="return confirm(\'Delete this record?\')" href=admin_contact_delete?id='.$row["contactus_ID"].'><span id="contactdelete"><i class="bx bx-trash"></i></span>
                </div>';
            }

        }
    } 
    else{
        $sql = "SELECT * FROM contactus WHERE contactus_ID LIKE '%$search%' OR name LIKE '%$search%' OR email LIKE '%$search%' ORDER BY is_read ASC";
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
                    <a onclick="return confirm(\'Delete this record?\')" href=admin_contact_delete?id='.$row["contactus_ID"].'><span id="contactdelete"><i class="bx bx-trash"></i></span>
                    <span id="viewed">Viewed <i class="bx bx-check-double" title="Viewed"></i></span>
                </div>';
            } else{
                echo'
                <div id="contactbox">
                    <span id="contactid">Contact ID: '.$row["contactus_ID"].'</span>
                    <span id="contactname">Contact Name: '.$row["name"].' </span>
                    <span id="contactemail">Contact Email: '.$row["email"].'</span>
                    <span id="contactcreated">Created At: '.$row["created_at"].' </span>
                    <a href=admin_contact_read.php?id='.$row["contactus_ID"].'><div id="contactviewbutton">View</div></a>
                    <a onclick="return confirm(\'Delete this record?\')" href=admin_contact_delete?id='.$row["contactus_ID"].'><span id="contactdelete"><i class="bx bx-trash"></i></span>
                </div>';
            }
        }
    }
    ?>

    </div>

    <script>
        let title = document.getElementById("title");
        title.innerHTML="Contact Us";
    </script>
</body>
</html>