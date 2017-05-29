<?php 

$sqlSelectOrg="SELECT * FROM `organizations` where director='$user->iin'";
$queryOrg=$connection->query($sqlSelectOrg);
if ($rowOrg=$queryOrg->fetch_object()) {

?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Медицинский персонал (неактивные)</h1>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th><h2>ФИО</h2></th>

                </tr>
              </thead>
              <tbody>

                <?php
                $sqlAllClinics="SELECT * FROM `users` where statusId='2' and status='0' and organizationId='$user->organizationId'";
                //echo $sqlAllClinics;
                $queryAllClinics=$connection->query($sqlAllClinics);
                  while ($rowAllClinics=$queryAllClinics->fetch_object()) {
                    
                    ?>
                <form action="controllers/act.php" method="POST" class="navbar-form navbar-right">
                  <input type="hidden" name="act" value="activeUser">
                  <input type="hidden" name="userId" value="<?php echo $rowAllClinics->id ; ?>">

                <tr>
                  <td><b><?php echo $rowAllClinics->name." ".$rowAllClinics->surname; ?></b></td>
                  <td><a href="index.php?page=Doctor&iin=<?php echo $rowAllClinics->iin; ?>"><button type="button" class="btn btn-info">Информация</button></a></td>
                  <td><button type="submit" class="btn btn-success">Активировать</button></td>
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
