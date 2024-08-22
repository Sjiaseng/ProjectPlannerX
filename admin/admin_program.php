<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programs</title>
    <link rel="stylesheet" href="admin_program.css">
</head>
<body>
    <?php
        include("admin_navigator.php");
        if (isset($_GET["searchuser"]) == True){
            $search = $_GET["searchuser"];
        }
        else{
            $search = null;
        }

        $count = mysqli_query($con,"SELECT * FROM program WHERE program_ID LIKE '%$search%' OR program_name LIKE '%$search%' ORDER BY program_ID ASC");
        $mycount = mysqli_num_rows($count);
    ?>

    <a href="admin_program_addnew.php"><div id="addnewuser">Add New Program</div></a>

    <form action="admin_program.php" method="GET">
    <span id="result"><?php echo $mycount ?> results found!</span>
    <div class="searchinguser">
        <button type="submit" id="searchbutton"><i class='bx bx-search-alt-2'></i></button>
        <input type="text" name="searchuser" placeholder="Search here" id="searchbox" value=<?php echo $search?>>
    </div>
    </form>

    <div class="programbackground">
        <?php
        if (isset($search) == False){
            $result = mysqli_query($con,"SELECT * FROM program ORDER BY program_ID ASC");
            while ($row = mysqli_fetch_array($result)){
                if($row["is_active"] == 1){
                    echo'
                    <a href="admin_program_inner.php?id='.$row["program_ID"].'">
                        <div id="courses">
                            <span id="coursestatus">Active <div id="activecourse"></div></span>
                            <div id="courseactive"></div>
                            <div id="courseimage"><img id="courseimage2" src="data:image;base64,'.$row['program_icon'].'"></div>
                            <span id="coursename">'.$row['program_name'].'</span>
                            <span id="courseid">Course ID: '.$row['program_ID'].'</span>
                            <span id="coursedate">Created Date: '.$row['created_at'].'</span> 
                        </div>
                    </a>';
                } else if($row["is_active"] == 0){
                    echo'
                    <a href="admin_program_inner.php?id='.$row["program_ID"].'">
                        <div id="courses">
                            <span id="coursestatus">Inactive <div id="inactivecourse"></div></span>
                            <div id="courseactive"></div>
                            <div id="courseimage"><img id="courseimage2" src="data:image;base64,'.$row['program_icon'].'"></div>
                            <span id="coursename">'.$row['program_name'].'</span>
                            <span id="courseid">Course ID: '.$row['program_ID'].'</span>
                            <span id="coursedate">Created Date: '.$row['created_at'].'</span> 
                        </div>
                    </a>';
                }
            }
        }else{
            $result = mysqli_query($con,"SELECT * FROM program WHERE program_ID LIKE '%$search%' OR program_name LIKE '%$search%' ORDER BY program_ID ASC");
            while ($row = mysqli_fetch_array($result)){
                if($row["is_active"] == 1){
                    echo'
                    <a href="admin_program_inner.php?id='.$row["program_ID"].'"">
                        <div id="courses">
                            <span id="coursestatus">Active <div id="activecourse"></div></span>
                            <div id="courseactive"></div>
                            <div id="courseimage"><img id="courseimage2" src="data:image;base64,'.$row['program_icon'].'"></div>
                            <span id="coursename">'.$row['program_name'].'</span>
                            <span id="courseid">Course ID: '.$row['program_ID'].'</span>
                            <span id="coursedate">Created Date: '.$row['created_at'].'</span> 
                        </div>
                    </a>';
                } else if($row["is_active"] == 0){
                    echo'
                    <a href="admin_program_inner.php?id='.$row["program_ID"].'">
                        <div id="courses">
                            <span id="coursestatus">Inactive <div id="inactivecourse"></div></span>
                            <div id="courseactive"></div>
                            <div id="courseimage"><img id="courseimage2" src="data:image;base64,'.$row['program_icon'].'"></div>
                            <span id="coursename">'.$row['program_name'].'</span>
                            <span id="courseid">Course ID: '.$row['program_ID'].'</span>
                            <span id="coursedate">Created Date: '.$row['created_at'].'</span> 
                        </div>
                    </a>';
                }   
            }         
        }
        ?>

    </div>

    <script>
        let title = document.getElementById("title");
        title.innerHTML="Programs";
    </script>
</body>
</html>