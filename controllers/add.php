<?php 
session_start();
include "../initt/db.php";
include "User.php";


	if(isset($_SESSION['user_id'])){
		 
				if(isset($_POST['new'])){
					
					if($_POST['new']=="new_subject"){
						$name=$_POST['name'];
								
								$sql="INSERT INTO `final_project`.`subjects` (`id`, `name`, `active`) VALUES (NULL, '$name', 'inactive') ";
								$query=$connection->query($sql);
								echo $sql;

								header("Location:../index.php");



					}elseif($_POST['new']=="new_topic"){
							
								$name=$_POST['name'];
								$subjecctIdOfTopic = $_POST['subject_id'];
								$nameOfTopic=$_POST['name'];
								$tags=$_POST['tag'];
								$image=$_POST['image'];
								$text=$_POST['text'];
								

								//$sql="INSERT INTO `final_project`.`topics` (`id`, `name`, `subject_id`, `image_id`,'text', `tags`, `author_id`) VALUES (NULL, '$nameOfTopic', '$subjecctIdOfTopic', '$image', '$text','$tags', '".$_SESSION['user_id']."')";
								
								$sql="INSERT INTO `final_project`.`topics` (`id`, `name`, `subject_id`, `image_id`, `text`, `tags`, `author_id`) VALUES (NULL, '$nameOfTopic', '$subjecctIdOfTopic', '$image', '$text', '$tags', '".$_SESSION['user_id']."')";
								$query=$connection->query($sql);
								echo $sql;
								
								header("Location:../index.php?subjectId=$subjecctIdOfTopic");


					}elseif ($_POST['new']=="new_task") {
								$name=$_POST['name'];
								$subjectIdForTask = $_POST['subjectIdForTask'];
								$topicId=$_POST['topicId'];
								$tag=$_POST['tag'];
								$image=$_POST['image'];
								$video=$_POST['video'];
								$sqlTask="INSERT INTO `final_project`.`tasks` (`id`, `name`, `subject_id`, `topic_id`, `video_id`, `image_id`, `tags`, `author_id`, `popularity`, `active`) VALUES (NULL, '$name', '$subjectIdForTask', '$topicId', '$video', '$image', '$tag', ".$_SESSION['user_id'].", '', '1')";
						
								echo $sqlTask;
								$query=$connection->query($sqlTask);
								header("Location:http://localhost/final_project/index.php?topicId=$topicId&subjectIdForTask=$subjectIdForTask");
					}

				

				}elseif(isset($_POST['new2'])){
					if ($_POST['new2']=="new_comment") {
								$text=$_POST['text'];
								$Csubject_id = $_POST['Csubject_id'];
								$Ctopic_id=$_POST['Ctopic_id'];
								$Ctask_id=$_POST['Ctask_id'];
								if(!$text==""  ){
									$Csql="INSERT INTO `final_project`.`comments` (`id`, `task_id`, `topic_id`, `subject_id`, `author_id`, `text`, `comment_date`,`active`) VALUES (NULL, '$Ctask_id', '$Ctopic_id', '$Csubject_id', '$user->id', '$text', NOW(),1)";
								//echo $Csql;
								$query=$connection->query($Csql);
								}
								
								//header("Location:../index.php?taskId=$Ctask_id&topicId2=$Ctopic_id&subjectIdForTaskS=$Csubject_id");
								//echo "string";

					}elseif ($_POST['new2']=="Ladd") {
						$Countlike;
							$taskId=$_POST['Ltask'];
							$userId = $_POST['Luser'];
							
							$LikeSelect="SELECT * FROM `task_like` where user_id= '$userId' and task_id='$taskId' ";
							//echo $LikeSelect;
							$SelectQuery=$connection->query($LikeSelect);
							if($likeRow=$SelectQuery->fetch_object()){
								if($likeRow->count=='1'){
									$Countlike=0;

								}else {
									$Countlike=1;
								}

								$sqlUpdate="UPDATE `final_project`.`task_like` SET  `count` = '$Countlike' WHERE `task_id` = '$taskId' and `user_id` = '$userId' ";
								//echo $sqlUpdate;
								$connection->query($sqlUpdate);

							}else{
								$LikeSql="INSERT INTO `final_project`.`task_like` (`id`, `task_id`, `user_id`, `count`) VALUES (NULL, '$taskId', '$userId', '1')";
								$connection->query($LikeSql);
							}
							//echo "taskId-".$taskId." userId-".$userId;

							$LikeSelect="SELECT * FROM `task_like` where  task_id='$taskId' and count= '1' ";
							//echo $LikeSelect;
							$SelectQuery=$connection->query($LikeSelect);
							$i=0;
							while ( $likeRow=$SelectQuery->fetch_object()) {
							  $i=$i+1;

							}
							 echo " ".$i;
					}
				}
	
		
		

//header("Location:../index.php");
if(isset($_POST['drug'])){
							$act=$_POST['drug'];
							$uid=$_POST['uid'];
							$id=$_POST['id'];
								if($act=="prinat"){

								    		$sqlAct="UPDATE `final_project`.`friends` SET `result` = '1' WHERE `friends`.`id` = '$id'";
								    	 

								}elseif ($act=="otpisatsya") {
									$sqlAct="DELETE FROM `final_project`.`friends` WHERE `friends`.`id` = '$id'";
    		
									# code...
								}elseif ($act=="Ualit") {
									$sqlAct="DELETE FROM `final_project`.`friends` WHERE `friends`.`id` = '$id'";
    	 

									# code...
								}elseif ($act=="poadt") {

    							$sqlAct="INSERT INTO `final_project`.`friends` (`id`, `requestor_id`, `responsible_id`, `result`) VALUES (NULL, '$user->id', '$uid', '0')";
     
									# code...
								}
								$connection->query($sqlAct);
								header("Location:http://localhost/final_project/index.php?userPage=$uid");
								
				}
		

	}


?>