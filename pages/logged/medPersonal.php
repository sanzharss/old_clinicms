<?php 

$sqlSelectOrg="SELECT * FROM `organizations` where director='$user->iin'";
$queryOrg=$connection->query($sqlSelectOrg);
if ($rowOrg=$queryOrg->fetch_object()) {

?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Медицинский персонал</h1>
          <div class="table-responsive">
            <form action="controllers/act.php" method="POST">
            <div class="col-xs-3">
              <label for="ex2">Добавить нового мед персонала</label>
               <input class="form-control" id="ex2" name="iin" type="text" required placeholder="Введите ИИН">
              <br>
              <input required class="form-control" id="ex2" name="name" type="text" required placeholder="Имя">
              <input type="hidden" name="act" value="addUser">
              <input type="hidden" name="statusId" value="2">
              <br>
              <input required class="form-control" id="ex2" name="surname" type="text" required placeholder="Фамилия">              
              <br>
              <input required class="form-control" id="ex2" name="password" type="password" required placeholder="Введите пароль">
              <br>
              <button type="submit" class="btn btn-success">Добавить</button>
            </div>
            </form>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th><h2>ФИО</h2></th>

                </tr>
              </thead>
              <tbody>

                <?php
                $sqlAllClinics="SELECT * FROM `users` where statusId='2' and status!='0' and organizationId='$user->organizationId'";
                $queryAllClinics=$connection->query($sqlAllClinics);
                  while ($rowAllClinics=$queryAllClinics->fetch_object()) {
                    
                    ?>
                <form action="controllers/act.php" method="POST" class="navbar-form navbar-right">
                  <input type="hidden" name="act" value="deleteUser">
                  <input type="hidden" name="userId" value="<?php echo $rowAllClinics->id ; ?>">

                <tr>
                  <td><b><?php echo $rowAllClinics->name." ".$rowAllClinics->surname; ?></b></td>
                  <td><a href="index.php?page=medPersonalPage&iin=<?php echo $rowAllClinics->iin; ?>"><button type="button" class="btn btn-info">Информация</button></a></td>
                  <td><button type="submit" class="btn btn-danger">Удалить</button></td>
                </tr>

                </form> 
                    <?php
                    
                  }


                ?>
                
                <?php

                ?>
              </tbody>
            </table>
          </div>

<?php
}else{
            $_SESSION['message']="У вас нет достаточных привилегий ";
            header("Location:index.php");
}
?>
