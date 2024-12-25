<?php
    try{
        include("conn.php");
        $date = date("Y-m-d");
    
        $image = $_FILES['programicon']['tmp_name'];
        $name = $_FILES['programicon']['name'];
        $image = base64_encode(file_get_contents(addslashes($image)));

        $sql = "INSERT INTO program (`program_name`, `created_at`, `is_active`,`program_icon`)
        VALUES ('$_POST[programname]', '$date', 0, '$image')";   

        if (mysqli_query($con, $sql)) {
            echo "<script> alert('Record Added!'); window.location.href='admin_program.php'</script>";
        }
        else{
            echo "<script> alert('Record failed to Add!'); window.location.href='admin_program.php' </script>";
            }
                
        }
        catch(Exception $e){
            echo 'Message: ' .$e->getMessage();
        }
    
?>