<?php 
/**
* 
*/

$USER_DATA=null;
class User
{

	
	var $id;
	var $login;
	//var $password;
	var $password;
	var $name;
	var $surname;
	var $statusId;
	var $genderId;
	var $iin;
	var $positionId;
	var $organizationId;

	function setId($id){
		$this->id=$id;
	}
	function setLogin($login){
		$this->login=$login;
		
	}
	function setPassword($password){
		$this->password=$password;
	}
	function setName($name){
		$this->name=$name;
	}
	function setSurname($surname){
		$this->surname=$surname;
	}
	function setStatusId($statusId){
		$this->statusId=$statusId;
	}
	function setGenderId($genderId){
		$this->genderId=$genderId;
	}
	function setIin($iin){
		$this->iin=$iin;
	}
	function setPositionId($positionId){
		$this->positionId=$positionId;
	}
	function setOrganizationId($organizationId){
		$this->organizationId=$organizationId;
	}


	function getId(){
		return $this->id;
	}
	function getLogin(){
		return $this->login;
	}

	function getPassword(){
		return $this->id;
	}
	function getName(){
		return $this->name;
	}
	function getSurname(){
		return $this->surname;
	}
		function getOrganizationId(){
		return $this->organizationId;
	}


	

}

 

	
	

if(isset($_SESSION['user_id'])){
	$query= $connection->query("Select * from users where id=".$_SESSION['user_id']);
		if ($row=$query->fetch_object()){

		 
		 
		 
		$user= new User();
		$user=$row;
		
 
		

	}
 
}


 


?>