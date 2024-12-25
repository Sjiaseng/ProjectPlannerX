<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignments</title>
    <link rel="stylesheet" href="admin_assignment.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
        $count = mysqli_query($con,"SELECT project.project_name, project.project_ID, project.project_start_date, project.is_approve,
        project.project_end_date, project.program_ID, program.program_ID, program.program_name, project.project_files,
        project.guideline_ID, guideline.guideline_ID, guideline.guide_file, project.reject_detail, project.create_at FROM project
        JOIN program ON project.program_ID = program.program_ID JOIN guideline ON project.guideline_ID = guideline.guideline_ID
        WHERE project.project_name LIKE '%$search%' OR program.program_name LIKE '%$search%' OR project.project_ID LIKE '%$search%'
        ORDER BY create_at DESC");
        $mycount = mysqli_num_rows($count);
    ?>

    <form action="admin_assignment.php" method="GET">
        <span id="result"><?php echo $mycount ?> results found!</span>
        <div class="searchinguser">
            <button type="submit" id="searchbutton"><i class='bx bx-search-alt-2'></i></button>
            <input type="text" name="searchuser" placeholder="Search here" id="searchbox" value="<?php echo $search ?>">
        </div>
    </form>

    
    <div class="assignmentbackground">
    
    <?php
    if (isset($search) == False){
        $result = mysqli_query($con,"SELECT project.project_name, project.project_ID, project.project_start_date, project.is_approve,
        project.project_end_date, project.program_ID, program.program_ID, program.program_name, project.project_files,
        project.guideline_ID, guideline.guideline_ID, guideline.guide_file, project.reject_detail, project.create_at FROM project
        JOIN program ON project.program_ID = program.program_ID JOIN guideline ON project.guideline_ID = guideline.guideline_ID
        ORDER BY project_ID DESC");
        while ($row = mysqli_fetch_array($result)){
            if ($row["is_approve"] == 0){
            echo '
                <div id="assignmentbox">
                    <span id="assignmenttopic">'.$row["project_name"].'</span>
                    <span id="projectid">Project ID: '.$row["project_ID"].'</span>
                    <span id="startdate">Start Date: '.$row["project_start_date"].'</span>
                    <span id="enddate">End Date: '.$row["project_end_date"].'</span>
                    <span id="courseid">Program ID: '. $row["program_ID"].' </span>
                    <span id="coursename">Program Name: '. $row["program_name"].' </span>
                    <a href="'.$row["guide_file"].'"><div id="assignmentfile">Guideline</div></a>
                    <a href="'.$row["project_files"].'"><div id="assignmentfile2">Project</div></a>
                    <a href="admin_assignment_approve.php?id='.$row["project_ID"].'"><span id="approveicon">Approve</span></a>
                    <a href="admin_assignment_reject_page.php?id='.$row["project_ID"].'"><span id="rejecticon">Reject</span></a>
                </div>';
            }
            else if ($row["is_approve"] == 1){
            echo '
                <div id="assignmentbox">
                    <span id="assignmenttopic">'.$row["project_name"].'</span>
                    <span id="projectid">Project ID: '.$row["project_ID"].'</span>
                    <span id="startdate">Start Date: '.$row["project_start_date"].'</span>
                    <span id="enddate">End Date: '.$row["project_end_date"].'</span>
                    <span id="courseid">Program ID: '.$row["program_ID"].' </span>
                    <span id="coursename">Program Name: '. $row["program_name"].' </span>
                    <a href="'.$row["guide_file"].'"><div id="assignmentfile">Guideline</div></a>
                    <a href="'.$row["project_files"].'"><div id="assignmentfile2">Project</div></a>
                    <span id="approvedicon">Approved</span>
                </div>';
            }
            else if ($row["is_approve"] == 2){
            echo '
                <div id="assignmentbox">
                    <span id="assignmenttopic">'.$row["project_name"].'</span>
                    <span id="projectid">Project ID: '.$row["project_ID"].'</span>
                    <span id="startdate">Start Date: '.$row["project_start_date"].'</span>
                    <span id="enddate">End Date: '.$row["project_end_date"].'</span>
                    <span id="courseid">Program ID: '.$row["program_ID"].' </span>
                    <span id="coursename">Program Name: '.$row["program_name"].'</span>
                    <a href="'.$row["guide_file"].'"><div id="assignmentfile">Guideline</div></a>
                    <a href="'.$row["project_files"].'"><div id="assignmentfile2">Project</div></a>
                    <span id="rejectedicon">Rejected</span>
                    <span id="rejectsymbol" onclick="message()"> <i class="bx bxs-message-alt-x" ></i></span>
                    <div id="rejectbox">
                        <span id="rejectreason">Reject Reason:</span>
                        <span id="rejectmessage">'.$row["reject_detail"].'</span>
                    </div>
                </div>';
            }
        }
    } else{
        $result = mysqli_query($con,"SELECT project.project_name, project.project_ID, project.project_start_date, project.is_approve,
        project.project_end_date, project.program_ID, program.program_ID, program.program_name, project.project_files,
        project.guideline_ID, guideline.guideline_ID, guideline.guide_file, project.reject_detail, project.create_at FROM project
        JOIN program ON project.program_ID = program.program_ID JOIN guideline ON project.guideline_ID = guideline.guideline_ID
        WHERE project.project_name LIKE '%$search%' OR program.program_name LIKE '%$search%' OR project.project_ID LIKE '%$search%' 
        ORDER BY project_ID DESC");
        while ($row = mysqli_fetch_array($result)){
            if ($row["is_approve"] == 0){
            echo '
                <div id="assignmentbox">
                    <span id="assignmenttopic">'.$row["project_name"].'</span>
                    <span id="projectid">Project ID: '.$row["project_ID"].'</span>
                    <span id="startdate">Start Date: '.$row["project_start_date"].'</span>
                    <span id="enddate">End Date: '.$row["project_end_date"].'</span>
                    <span id="courseid">Program ID: '. $row["program_ID"].' </span>
                    <span id="coursename">Program Name: '. $row["program_name"].' </span>
                    <a href="'.$row["guide_file"].'"><div id="assignmentfile">Guideline</div></a>
                    <a href="'.$row["project_files"].'"><div id="assignmentfile2">Project</div></a>
                    <a href="admin_assignment_approve.php?id='.$row["project_ID"].'"><span id="approveicon">Approve</span></a>
                    <a href="admin_assignment_reject_page.php?id='.$row["project_ID"].'"><span id="rejecticon">Reject</span></a>
                </div>';
            }
            else if ($row["is_approve"] == 1){
            echo '
                <div id="assignmentbox">
                    <span id="assignmenttopic">'.$row["project_name"].'</span>
                    <span id="projectid">Project ID: '.$row["project_ID"].'</span>
                    <span id="startdate">Start Date: '.$row["project_start_date"].'</span>
                    <span id="enddate">End Date: '.$row["project_end_date"].'</span>
                    <span id="courseid">Program ID: '.$row["program_ID"].' </span>
                    <span id="coursename">Program Name: '. $row["program_name"].' </span>
                    <a href="'.$row["guide_file"].'"><div id="assignmentfile">Guideline</div></a>
                    <a href="'.$row["project_files"].'"><div id="assignmentfile2">Project</div></a>
                    <span id="approvedicon">Approved</span>
                </div>';
            }
            else if ($row["is_approve"] == 2){
            echo '
                <div id="assignmentbox">
                    <span id="assignmenttopic">'.$row["project_name"].'</span>
                    <span id="projectid">Project ID: '.$row["project_ID"].'</span>
                    <span id="startdate">Start Date: '.$row["project_start_date"].'</span>
                    <span id="enddate">End Date: '.$row["project_end_date"].'</span>
                    <span id="courseid">Program ID: '.$row["program_ID"].' </span>
                    <span id="coursename">Program Name: '.$row["program_name"].'</span>
                    <a href="'.$row["guide_file"].'"><div id="assignmentfile">Guideline</div></a>
                    <a href="'.$row["project_files"].'"><div id="assignmentfile2">Project</div></a>
                    <span id="rejectedicon">Rejected</span>
                    <span id="rejectsymbol" onclick="message()"> <i class="bx bxs-message-alt-x" ></i></span>
                    <div id="rejectbox">
                        <span id="rejectreason">Reject Reason:</span>
                        <span id="rejectmessage">'.$row["reject_detail"].'</span>
                    </div>
                </div>';
            }
        }        
    }

    ?>
    </div>
    

    <script>
        let title = document.getElementById("title");
        title.innerHTML="Assignments";

        var flag = true;
        function message(){
            let rejectsymbol = document.getElementById("rejectbox");
            rejectsymbol.style.display = flag ? "block" + $("#rejectbox").slideDown() : "none" + $("#rejectbox").slideUp(); 
            flag = !flag; 
        }
    </script>
</body>
</html>