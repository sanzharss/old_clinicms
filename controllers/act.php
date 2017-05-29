<?php
	session_start();
	include "../initt/db.php";
	include "../model/User.php";  
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		//echo "POST";
		if (isset($_POST['act'])) {
			if($_POST['act']=="login"){
				//echo "login";

	$login=$_POST['login'];
	$password=sha1($_POST['password']);
	$sql="Select * from users  where login=\"".$login."\" and password = \"".$password."\" and status='1'";
	$query=$connection->query($sql);
	if ($row=$query->fetch_object()) {
		$_SESSION['user']=$row->id;
		$_SESSION['user_id']=$row->id;
		$_SESSION['userData']=$row;


	}else{
		$_SESSION['message']="Логин или пароль неправильный";
	}
			


	header("Location:../index.php");
	}else if($_POST['act']=="addOrganization" ){
		if($_POST['bin']!=""){
					$bin=$_POST['bin'];
		$sqlSelectOrg="SELECT * FROM `organizations` where bin=\"".$bin."\"";
		$_SESSION['bin']=$bin;
		$querySelectOrg=$connection->query($sqlSelectOrg);
			if ($rowSelectOrg=$querySelectOrg->fetch_object()) {
				$_SESSION['message']="Такая организация уже существует";
				header("Location:../index.php?page=Clinics");
			}else{
				header("Location:../index.php?page=newClinic");
			}
		}else{
			header("Location:../index.php?page=Clinics");
			$_SESSION['message']="Введите БИН";
		}

		/*
		$organizationName=$_POST['oraganizationName'];
		$organizationTelNumber=$_POST['organizationTelNumber'];
		$organizationDate=$_POST['organizationDate'];
		$organizationStatus=$_POST['organizationStatus'];*/

		


	}else if($_POST['act']=="addOrganizationCompl"){
		echo "string";
		$bin=$_POST['bin'];
		$ur_address=$_POST['ur_address'];
		$name=$_POST['name'];
		$tel_number=$_POST['tel_number'];
		$director=$_POST['director'];
		$sqlCompleateClinic="INSERT INTO `clinic`.`organizations` (`id`, `name`, `ur_address`, `bin`, `bin_bik_kbe_bank`, `director`, `tel_number`, `status`)".
							" VALUES (NULL, '$name', '$ur_address', '$bin', '$bin', '$director', '$tel_number', '1','1')";
		$connection->query($sqlCompleateClinic);

		$sqlSelectOrg="SELECT * FROM `organizations` where bin=\"".$bin."\"";
		$_SESSION['bin']=$bin;
		$querySelectOrg=$connection->query($sqlSelectOrg);
			if ($rowSelectOrg=$querySelectOrg->fetch_object()) {
				$orgId=$rowSelectOrg->id;
			}

		$statusId=$_POST['statusId'];
		$name=$_POST['nameDoctor'];
		$surname=$_POST['surname'];
		$password=sha1($_POST['password']);
		$iin=$_POST['director'];
		$sqlCreate="INSERT INTO `clinic`.`users` (`id`, `login`, `password`, `organizationId`, `name`, `surname`, `statusId`, `genderId`, `iin`, `positionId`, `status`) VALUES (NULL, '$iin', '$password', '$orgId', '$name', '$surname', '$statusId', '2', '$iin', '2', '1')";
		$connection->query($sqlCreate);


		$_SESSION['messageSuccess']="Организация успешно добавлена";
		header("Location:../index.php?page=Clinics");
		

	}else if($_POST['act']=="updateOrganization"){
		$bin=$_POST['bin'];
		$ur_address=$_POST['ur_address'];
		$name=$_POST['name'];
		$tel_number=$_POST['tel_number'];
		$director=$_POST['director'];
		$sqlUpdate="UPDATE `organizations` SET `name`='$name',`ur_address`='$ur_address',`director`='$director',`tel_number`='$tel_number' WHERE bin= '$bin'";
		$connection->query($sqlUpdate);
		$_SESSION['messageSuccess']="Организация успешно обновлена";
		header("Location:../index.php?page=Clinics");


	}else if($_POST['act']=="deleteOrganization"){
		$clinicId=$_POST['clinicId'];
		$sqlUpdate="UPDATE `organizations` SET `status`='0' WHERE id= '$clinicId'";
		$connection->query($sqlUpdate);

		$sqlDeActivateUsers="UPDATE `clinic`.`users` SET `status` = '0' WHERE `users`.`organizationId` =$clinicId";
		$connection->query($sqlDeActivateUsers);
		
		$_SESSION['messageSuccess']="Статус организации - неактивен ";
		header("Location:../index.php?page=Clinics");

	}else if($_POST['act']=="toActiveOcrganization"){
		$clinicId=$_POST['clinicId'];
		$sqlUpdate="UPDATE `organizations` SET `status`='1' WHERE id= '$clinicId'";
		$connection->query($sqlUpdate);
		$director=$_POST['director'];
		$sqlUpdate="UPDATE `users` SET `status`='1' WHERE iin= '$director'";
		$connection->query($sqlUpdate);
		$_SESSION['messageSuccess']="Статус организации - активен ";
		header("Location:../index.php?page=Clinics");

	}else if($_POST['act']=="deleteUser"){
		$userId=$_POST['userId'];
		$sqlUpdate="UPDATE `users` SET `status`='0' WHERE id= '$userId'";
		$connection->query($sqlUpdate);
		echo $sqlUpdate;
		 $sqlSelectUser="Select * from users where id='$userId'";
		 $querySelectUser=$connection->query($sqlSelectUser);
		 if($rowSelectUser=$querySelectUser->fetch_object()){
		 	if($rowSelectUser->statusId==1){
		 				$_SESSION['messageSuccess']="Статус пользователя - неактивен ";
						header("Location:../index.php?page=doctors");
		 	}else if($rowSelectUser->statusId==2){
		 			$_SESSION['messageSuccess']="Статус пользователя - неактивен ";
					header("Location:../index.php?page=medPersonal");
		 	}
		 }


	}else if($_POST['act']=="deletePatient"){
		$patientId=$_POST['patientId'];
		$sqlUpdate="UPDATE `clinic`.`patient` SET `status` = '0' WHERE `patient`.`id` = $patientId";
		$connection->query($sqlUpdate);
		$_SESSION['messageSuccess']="Статус пациента - неактивен ";
		echo $sqlUpdate;



	}else if($_POST['act']=="addUser"){
		$iin=$_POST['iin'];
		$statusId=$_POST['statusId'];
		$name=$_POST['name'];
		$surname=$_POST['surname'];
		$password=sha1($_POST['password']);

		$sqlCreate="INSERT INTO `clinic`.`users` (`id`, `login`, `password`, `organizationId`, `name`, `surname`, `statusId`, `genderId`, `iin`, `positionId`, `status`) VALUES (NULL, '$iin', '$password', '$user->organizationId', '$name', '$surname', '$statusId', '2', '$iin', '2', '1')";
		//$connection->query($sqlCreate);
		if($connection->query($sqlCreate)){
			$_SESSION['messageSuccess']="Пользователь успешно добавлен";
			if($statusId=='1'){
				$_SESSION['messageSuccess']="Пользователь успешно добавлен";
				header("Location:../index.php?page=doctors");
			}else if($statusId=='2'){
				$_SESSION['messageSuccess']="Пользователь успешно добавлен";
				header("Location:../index.php?page=medPersonal");
			}

		}else{	
			$_SESSION['message']="Такой пользователь уже существуеты";
			header("Location:../index.php?page=medPersonal");	

		}


	}else if($_POST['act']=="updateUser"){
		$iin=$_POST['iin'];
		$name=$_POST['name'];
		$surname=$_POST['surname'];
		$password=sha1($_POST['password']);
		$sqlUpdateUser="UPDATE `users` SET `password`='$password',`name`='$name',`surname`='$surname' where iin='$iin'";
		$connection->query($sqlUpdateUser);
		echo $sqlUpdateUser;

				 $sqlSelectUser="Select * from users where iin='$iin'";
		 $querySelectUser=$connection->query($sqlSelectUser);
		 if($rowSelectUser=$querySelectUser->fetch_object()){
		 	if($rowSelectUser->statusId==1){
		 				$_SESSION['messageSuccess']="Статус пользователя - неактивен ";
						header("Location:../index.php?page=doctors");
		 	}else if($rowSelectUser->statusId==2){
		 			$_SESSION['messageSuccess']="Статус пользователя - неактивен ";
					header("Location:../index.php?page=medPersonal");
		 	}
		 }
	}else if($_POST['act']=="activeUser"){
		$userId=$_POST['userId'];
		$statusId=$_POST['statusId'];
		$sqlUpdate="UPDATE `users` SET `status`='1' WHERE id= '$userId'";
		$connection->query($sqlUpdate);
		echo $sqlUpdate;
		$_SESSION['messageSuccess']="Статус пользователя - активен ";
		if($statusId==2){
			header("Location:../index.php?page=medPersonal");
		}else if($statusId==1){
			header("Location:../index.php?page=doctors");
		}
		

	}else if($_POST['act']=="addPatient"){
		$iin=$_POST['iin'];
		$name=$_POST['name'];
		$surname=$_POST['surname'];
		$patr=$_POST['patr'];
		$date=$_POST['date'];
		$genderId=$_POST['genderId'];
		$address=$_POST['address'];
		$sqlAddPatient="INSERT INTO `clinic`.`patient` (`id`, `name`, `surname`, `Patronymic`, `BirthDate`, `gender_id`, `Address`, `IIN`) VALUES (NULL, '$name', '$surname', '$patr', '$date', '$genderId', '$address', '$iin')";
		$connection->query($sqlAddPatient);
		echo $sqlUpdate;
		$_SESSION['messageSuccess']="Пациент добавлен ";
		header("Location:../index.php?page=patients");

	}else if($_POST['act']=="deletePatient"){
		$patientId=$_POST['patientId'];
		$sqlUpdate="UPDATE `patient` SET `status`='0' WHERE id= '$patientId'";
		$connection->query($sqlUpdate);
		echo $sqlUpdate;
		$_SESSION['messageSuccess']="Статус пациента - неактивен ";
		header("Location:../index.php?page=patients");

	}else if($_POST['act']=="deletePatient"){
		$patientId=$_POST['patientId'];
		$sqlUpdate="UPDATE `patient` SET `status`='0' WHERE id= '$patientId'";
		$connection->query($sqlUpdate);
		echo $sqlUpdate;
		$_SESSION['messageSuccess']="Статус пациента - неактивен ";
		header("Location:../index.php?page=patients");

	}else if($_POST['act']=="updatePatient"){
		$iin=$_POST['iin'];
		$name=$_POST['name'];
		$surname=$_POST['surname'];
		$patr=$_POST['patr'];
		$date=$_POST['date'];
		$address=$_POST['address'];
		$sqlUpdateP="UPDATE `patient` SET `name`='$name',`surname`='$surname',`Patronymic`='$patr',`BirthDate`='$date',`Address`='$address' WHERE IIN=$iin";
		echo $sqlUpdateP;
		$connection->query($sqlUpdateP);
				$_SESSION['messageSuccess']="Пациент updated ";
		header("Location:../index.php?page=patients");
	}else if($_POST['act']=="addNote"){
		$note=$_POST['note'];
		$sqlNote="INSERT INTO `clinic`.`derivationstype` (`id`, `name`) VALUES (NULL, '$note')";
		echo $sqlNote;
		$connection->query($sqlNote);
				$_SESSION['messageSuccess']="Замечания + ";
		header("Location:../index.php?page=notes");
	}else if($_POST['act']=="add043"){
		$cashCode=rand(10,100000);
		$patientId=$_POST['patientId'];
		$orgId=$_POST['orgId'];
		$diagnos=$_POST['diagnos'];
		$freeMedicalService=$_POST['freeMedicalService'];
		$sqlForm="INSERT INTO `clinic`.`form043` (`id`, `patient_id`, `organization_id`, `cash_code`,`doctor_id`,`freeMedicalService`) VALUES (NULL, '$patientId', '$orgId', '$cashCode','$user->id','$freeMedicalService')";
		//echo $sqlForm;
		$connection->query($sqlForm);
		$sqlSelectForm="select * from form043 where cash_code='$cashCode'";
		//echo $sqlSelectForm;
		$querySelectForm=$connection->query($sqlSelectForm);
			if ($rowSelectForm=$querySelectForm->fetch_object()) {
				$sqlCleanCash="UPDATE `clinic`.`form043` SET `cash_code` = NULL WHERE `form043`.`id` = $rowSelectForm->id";
				$connection->query($sqlCleanCash);

				$sqlDerivationTypes="SELECT * FROM `derivationstype`";
            	$queryDerivationTypes=$connection->query($sqlDerivationTypes);
            	$derivations=array();
            	//$Derivation=$_POST['DerivationTypes4'];
            	//echo $Derivation;
                    while ($rowDerivationTypes=$queryDerivationTypes->fetch_object()) {
                    		$num="DerivationTypes".$rowDerivationTypes->id;
                    		$value=$_POST[$num].";";
                    		if($value!=''){
							
							$str="";
                    		for($j=0;$j<strlen($value);$j++){
                    			if($value[$j]==";"){
                    				if($str!=""){
			                    		array_push($derivations,"$str");
			                    		$sqlDerivationAdd="INSERT INTO `clinic`.`derivations` (`id`, `derivation_type_id`, `name`) VALUES (NULL, '$rowDerivationTypes->id', '$str')";
			                    		//echo $sqlDerivationAdd;
			                    		$connection->query($sqlDerivationAdd);
			                    		$str="";

                    				}
                    			}else{
                    				$str=$str.$value[$j];
                    			}
                    		}


                    		}
                    		//echo $num;

                    		

                    }

                 for($k=0;$k<count($derivations);$k++){
                 	$dname=$derivations[$k];
                $sqlDerivationsS="SELECT * FROM `derivations` where name='$dname'";
            	$queryDerivationsS=$connection->query($sqlDerivationsS);
    
                    if($rowDerivationsS=$queryDerivationsS->fetch_object()) {

                    	$sqlDerivetionRecord="INSERT INTO `clinic`.`derivationrecord` (`id`, `form_043_id`, `DerivationId`) VALUES (NULL, '$rowSelectForm->id', '$rowDerivationsS->id')";
                    	//echo "<br>-$dname-".$sqlDerivetionRecord."<br>";
                    	$connection->query($sqlDerivetionRecord);
                    }


                 }
				
                 $sqlDiagnosisRecord="INSERT INTO `clinic`.`diagnosisrecord` (`id`, `form_043_id`, `Diagnosis_id`) VALUES (NULL, '$rowSelectForm->id', '$diagnos')";
                 $connection->query($sqlDiagnosisRecord);
                $_SESSION['message']="Форма 043 добавлена";
				header("Location:../index.php?page=Patient&iin=$patientId");


			}


/*		    */

	}else{		
			$_SESSION['message']="Ошибка";
			header("Location:../index.php");
				
				

	}
			# code...
		}
	}else{
		
	}
?>