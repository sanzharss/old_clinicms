        <?php 

    $iin=$_GET['iin'];
    $sqlSelectOrg="SELECT * FROM `users` where iin=\"".$iin."\"";
    $querySelectOrg=$connection->query($sqlSelectOrg);
      if ($rowSelectOrg=$querySelectOrg->fetch_object()) {
      	$sqlCheck="select * from organizations where id=$rowSelectOrg->organizationId";
      	//echo $sqlCheck;
      	$queryCheck=$connection->query($sqlCheck);
      	if($rowCheck=$queryCheck->fetch_object()){
          echo "string.".$rowCheck->director;
      		if($rowCheck->director==$user->iin){

      			?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Врач</h1>
          <div class="table-responsive">
            <form action="controllers/act.php" method="POST">
            <div class="col-xs-3">
              <label >ИИН</label>
              <input required class="form-control" id="ex2"  disabled value="<?php echo $iin;?>" type="text" placeholder="">
              <input  type="hidden" name="act" value="updateUser">
              <input  type="hidden" name="iin" value="<?php echo $iin;?>">
              <input  type="hidden" name="statusId" value="1">
              <label >Имя</label>
              <input required class="form-control" required id="ex2" name="name" type="text" value="<?php echo $rowSelectOrg->name; ?>" placeholder="Введите юридический адрес">
              <label >Фамилия</label>
              <input required class="form-control" required id="ex2" name="surname" value="<?php echo $rowSelectOrg->surname; ?>"type="text"  placeholder="Введите наименование">
              <label >Пароль</label>
              <input required class="form-control" type="password" required id="ex2" name="password" type="text" placeholder="Введите номер контактного телефона, факса с указанием кода города">
              <br>
              <button type="submit" class="btn btn-success">Изменить</button>
            </div>
            </form>

          </div>
      			<?php

      		}else{
      			$_SESSION['message']="У вас нет достаточных привилегий ";
            echo $user->iin;
      			header("Location:index.php");
      		}
      	}




}


?>