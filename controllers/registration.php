<?php 
session_start();
include "../initt/db.php";
if( isset($_SESSION['registId'])){
	
	$login=$_POST['login'];
	$password=$_POST['password'];
	$user_name=$_POST['user_name'];
	$user_surname=$_POST['user_surname'];
    $role=$_POST['role'];
	

	
			$randName=rand(10,10000).$login;
			echo $randName;echo "<br>";



        $file = $_FILES['avatar']['name'];
        $temp_file = explode(".", $file);

        $new_file = 'images/'.$randName.".".end($temp_file);
        move_uploaded_file($_FILES['avatar']['tmp_name'], "../".$new_file);


        $sqlReg="INSERT INTO `users`(`id`, `login`, `password`, `name`, `surname` ,`role`, `avatar_url`) VALUES  (NULL, \"".$login."\", \"".$password."\", \"".$user_name."\", \"".$user_surname."\", \"".$role."\", \"".$new_file."\")";

 $query=$connection->query($sqlReg);


        $sqlLog="Select * from users  where login=\"".$login."\" and password = \"".$password."\"";

        $query=$connection->query($sqlLog);
        if ($row=$query->fetch_object()) {

        $sqlFrend="INSERT INTO `final_project`.`friends` (`id`, `requestor_id`, `responsible_id`, `result`) VALUES (NULL, '19', '$row->id', '1')";
       
        $connection->query($sqlFrend);

        if($role==2){
        
        $sqlTeach="INSERT INTO `final_project`.`teachers` (`id`, `active`, `teacher_id`) VALUES (NULL, '$row->id', 'inactive')";

        $queryy=$connection->query($sqlTeach);
        
         $_SESSION['user_id']=$row->id;
         
        }else{
             $_SESSION['user_id']=$row->id;

        }
            
           
            header("Location:../index.php");


        }

 

	



}

?>


