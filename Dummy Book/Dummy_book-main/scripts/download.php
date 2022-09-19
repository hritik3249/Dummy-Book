<?php
            session_start();
            if(isset($_POST['download']))
            {
                include 'dbmanager.php';
                $sql = "SELECT * FROM transaction WHERE receiver_email=? || sender_email=?";
                $email = $_SESSION['email'];
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,"ss",$email,$email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $user_arr = array();
                while($row = mysqli_fetch_array($result))
                {
                    $user_arr[] = array($row['trans_id'],$row['date'],$row['amount'],$row['sender_name'],$row['sender_email'],$row['receiver_name'],$row['receiver_email']);
                    
                }
                $filename = 'users.csv';
                $file = fopen($filename,"w");
                $heading = array('Trans. ID','Date','Amount','Sender Name','Sender Email','Receiver Name','Receiver Email');
                fputcsv($file,$heading);
                for($i=0;$i<count($user_arr);$i++)
                {
                    fputcsv($file,$user_arr[$i]);
                }
                fclose($file);
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=".$filename);
                header("Content-Type: application/csv; ");
                readfile($filename);
                unlink($filename);
            }
    