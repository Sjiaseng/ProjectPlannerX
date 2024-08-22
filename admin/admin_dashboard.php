<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    
    <?php
        include("admin_navigator.php");
        include("conn.php");

        $student = mysqli_query($con, "SELECT * FROM student");
        $studentcount = mysqli_num_rows($student);

        $supervisor = mysqli_query($con, "SELECT * FROM supervisor");
        $supervisorcount = mysqli_num_rows($supervisor);

        $admin = mysqli_query($con, "SELECT * FROM admin");
        $admincount = mysqli_num_rows($admin);

        $program = mysqli_query($con, "SELECT * FROM program");
        $programcount = mysqli_num_rows($program);

        $project = mysqli_query($con, "SELECT * FROM project");
        $projectcount = mysqli_num_rows($project);

        $proposal = mysqli_query($con, "SELECT * FROM proposal WHERE is_approve = 1");
        $proposalcount = mysqli_num_rows($proposal);

    ?>

    <div class="summaryreport">
        <div class="summary1"><span class="numbers"><?php echo $studentcount ?></span><span>Students</span><div class="circle"></div></div>
        <div class="summary2"><span class="numbers"><?php echo $supervisorcount ?></span><span>Supervisors</span><div class="circle"></div></div>
        <div class="summary3"><span class="numbers"><?php echo $admincount ?></span><span>Admins</span><div class="circle"></div></div>
        <div class="summary4"><span class="numbers"><?php echo $programcount ?></span><span>Programs</span><div class="circle"></div></div>
        <div class="summary5"><span class="numbers"><?php echo $projectcount ?></span><span>Projects</span><div class="circle"></div></div>
        <div class="summary6"><span class="numbers"><?php echo $proposalcount ?></span><span>Approved Proposal</span><div class="circle"></div></div>
    </div>

    <div class="activeprogram">
        <span class="programtitle">Active Programs</span>

        <?php

        $result = mysqli_query($con, "SELECT * FROM program WHERE is_active = 1");
        
        while ($row = mysqli_fetch_array($result)){

            $result2 = mysqli_query($con, 'SELECT program.program_ID, student.program_ID FROM program
            JOIN student ON program.program_ID = student.program_ID WHERE program.program_ID ='.$row["program_ID"].'');
            $studentcount = mysqli_num_rows($result2);

            $result3 = mysqli_query($con, 'SELECT program.program_ID, supervisor.program_ID FROM program
            JOIN supervisor ON program.program_ID = supervisor.program_ID WHERE program.program_ID ='.$row["program_ID"].'');
            $supervisorcount = mysqli_num_rows($result3);

            echo'<div class="classes">
            '.$row["program_name"].' <span id="studentcount"> Student: '.$studentcount.'</span><span id="supervisorcount"> Supervisor: '.$supervisorcount.'</span>
            </div>';

        }

        ?>
    </div>

    <div class="todolistbackground">
        <div class="todolisttitle">
            To-Do Lists
            <div id="todoaddicon" onclick=todo1()><i class='bx bxs-folder-plus' ></i></div>



        </div>

        <?php
            $result = $result = mysqli_query($con,"SELECT * FROM todolist WHERE admin_ID = $adminID ORDER BY todo_date ASC"); 
            while ($row = mysqli_fetch_array($result)){
                echo'
                <div class="todocontent">
                    <span id="todotitle">'.$row["todo_desc"].'</span>
                    <span id="tododate">'.$row["todo_date"].'</span>
                    <a href="admin_dashboard_delete.php?id='.$row["todo_ID"].'"><span id="tododelete"><i class="bx bx-trash"></i></span></a>
                </div>';
            }

        ?>

    
    </div>

    <div id="todoback" onclick=todo2()></div>
    
    <form action=admin_dashboard.php method="POST">
        <div id="tododialog">
            <span class="tdtopic"> New To-Do Lists</span>
            <span id="tddate">Date: <br><br>
                <input type="date" id="innertddate" name="tododate">
            </span>

            <span id="tddesc">Description: <br><br>
                <textarea id="innerdesc" name="tododesc"></textarea>
            </span>
            <span id="tdclose" onclick=todo2()><i class='bx bx-x'></i></span>
            <button type="submit" id="tdsubmit">Submit</button>
        </div>
    </form>

    <?php
        if (isset($_POST['tododesc'])){
            $sql="INSERT INTO todolist (todo_date, todo_desc, admin_ID)
            VALUES ('$_POST[tododate]', '$_POST[tododesc]', $adminID)"; 
            
            if (mysqli_query($con,$sql)) {
                echo '<script> window.location.href = "admin_dashboard.php"; </script>';
            }else{
                echo '<script> alert("Failed to add record!"); </script>';
            }

            mysqli_close($con);
        }
    ?>

    <div class="wrapper">
        <span class="calendar-topic">Calendar</span> <span id="weekday">Sun <i class='bx bx-chevron-right'></i> Sat </span>
        <header>
            <div class="innerwrapper">
                <p class="current-date"></p>
                <div class="calendar-icon">
                    <span id="prev" class="arrow-left"><i class='bx bx-chevron-left' id="prev"></i></span>
                    <span id="next" class="arrow-right"><i class='bx bx-chevron-right' id="next" ></i></span>
                </div>
            </div>
            <div class="calendar">
                <ul class="calendar-days">
                </ul>
            </div>
        </header>
    </div>
    

  </body>
</html>

    <script>
        let title = document.getElementById("title");
        title.innerHTML="Dashboard";
        const currentDate = document.querySelector(".current-date");
        const daysTag = document.querySelector(".calendar-days");
        const calendarIcon = document.querySelectorAll(".calendar-icon span")

        let date = new Date();
        currYear = date.getFullYear();
        currMonth = date.getMonth();

        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        const renderCalendar = () => {
            let firstDate = new Date(currYear, currMonth, 1).getDay();
            let lastDate = new Date (currYear, currMonth +1, 0).getDate();
            let lastDate2 = new Date (currYear, currMonth, 0).getDate();
            let lastDay = new Date (currYear, currMonth, lastDate2).getDay()
            let listTag= "";

            for (let i = firstDate; i > 0; i--){
                listTag += `<li class="inactivedate">${lastDate2 - i + 1}</li>`;
            }

            for (let i = 1; i <= lastDate; i++){
                let isToday = i ===date.getDate() && currMonth===new Date().getMonth() && currYear === new Date().getFullYear()? "activedate" : "";
                listTag += `<li class="${isToday}">${i}</li>`;
            }

            for (let i = lastDay; i < 6; i++){
                listTag += `<li class="inactivedate">${i - lastDay +1 } </li>`
            }


            currentDate.innerText = `${months[currMonth]} ${currYear}`;
            daysTag.innerHTML = listTag;
        }

        renderCalendar();

        calendarIcon.forEach(icon => {
            icon.addEventListener("click", () => {
                    currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;
                    if (currMonth < 0 || currMonth > 11){
                        date = new Date(currYear, currMonth);
                        currYear = date.getFullYear();
                        currMonth = date.getMonth();
                    } else {
                        date = new Date();
                    }
                    renderCalendar();
                });
        })

        function todo1(){
            document.getElementById("tododialog").style.display = "block";
            document.getElementById("todoback").style.display= "block";
        }

        function todo2(){
            document.getElementById("tododialog").style.display = "none";
            document.getElementById("todoback").style.display= "none";
        }
    </script>

</body>
    
</html>