<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programs</title>
    <link rel="stylesheet" href="admin_program_addnew.css">
</head>
<body>
    <?php
        include("admin_navigator.php");
        include("conn.php");
    ?>

    <a href="admin_program_addnew.php"><div id="addnewuser">Add New Program</div></a>

    <span id="result">X results found!</span>
    <div class="searchinguser">
        <button type="submit" id="searchbutton"><i class='bx bx-search-alt-2'></i></button>
        <input type="text" name="searchuser" placeholder="Search here" id="searchbox">
    </div>

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
                            <span id="coursename">'.$row['program_name'].'t</span>
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
                            <span id="coursename">'.$row['program_name'].'t</span>
                            <span id="courseid">Course ID: '.$row['program_ID'].'</span>
                            <span id="coursedate">Created Date: '.$row['created_at'].'</span> 
                        </div>
                    </a>';
                }   
            }         
        }
        ?>

    </div>

    <a href="admin_program.php"><div class="background" id="mybackground"></div></a>

    <div class="programback">
        <a href="admin_program.php" class="closingprogram"><i class='bx bx-x'></i></a>

        <span class="progid"> Program ID: Autogenerate </span>
        
        <form action= "admin_program_insert.php" method="POST" enctype="multipart/form-data">
            <span class="progname">Program Name: <br><br>
                <input type="text" class="progname2" placeholder="Program Name" name="programname" required>
            </span>

            <span class="progicon"> Program Icon: <br><br>
                <input type="file" name="programicon" required>
            </span>

            <button type="submit" name="createprogram" id="createprogram">Create</button>
        </form>

    </div>



    <script>
        let title = document.getElementById("title");
        title.innerHTML="Programs";
        document.getElementById("nav_prog").className = "active"; 
    </script>
</body>
</html>