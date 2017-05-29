<?php 
if($user->statusId!=3){
  if($user->statusId==1){
    $disabled="disabled";

  }else{
    $disabled="";
  }

  $iin=$_GET['iin'];
  $sqlSelectPatient="Select * from patient where IIN='$iin'";
          $queryPatient=$connection->query($sqlSelectPatient);
        if($rowPatient=$queryPatient->fetch_object()){
  ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Пациенты</h1>
          <div class="table-responsive">
            <form action="controllers/act.php" method="POST">
            <div class="col-xs-3">
              <label for="ex2">Добавить нового пциента</label>
              <input  class="form-control" id="ex2" type="hidden" <?php echo $disabled; ?> name="iin" value="<?php echo $rowPatient->IIN; ?>" placeholder="Введите ИИН">
              <br>
              <input  class="form-control" id="ex2" type="text"<?php echo $disabled; ?>  name="name" value="<?php echo $rowPatient->name; ?>"  placeholder="Имя" required>
              <br>
              <input  class="form-control" id="ex2" type="text" <?php echo $disabled; ?> name="surname" value="<?php echo $rowPatient->surname; ?>"  placeholder="Фамилия" required>
              <br>
              <input required class="form-control" id="ex2" type="text" <?php echo $disabled; ?> name="patr" value="<?php echo $rowPatient->Patronymic; ?>"  placeholder="Отчество" required>
              <br>
              <input required class="form-control" id="ex2" type="text" <?php echo $disabled; ?> name="date" value="<?php echo $rowPatient->BirthDate; ?>"  placeholder="Дата рождения(гггг-мм-дд)" required>
              <br>
              <input required class="form-control" id="ex2" type="text" <?php echo $disabled; ?> name="address" value="<?php echo $rowPatient->Address; ?>"  placeholder="Адрес" required>
              <br>
              <input  type="hidden" name="act" value="updatePatient">
              <?php if($user->statusId==2){?>
              <button type="submit" class="btn btn-success">Изменить</button>
              <?php }?>
            </div>
            </form>
          </div>
          </div>
          <?php

          if($user->statusId==1){
            ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Форма 043</h1>
          <div class="table-responsive">
            <form action="controllers/act.php" method="POST">
            <div class="col-xs-6">
                <select class="form-control" name="diagnos" id="sel1">
                  <option value="" selected disabled>Диагноз</option>
                  <?php 
                  $sqlDiagnosis="Select * from diagnosis";
                   $queryDiagnosis=$connection->query($sqlDiagnosis);
                    while ($rowDiagnosis=$queryDiagnosis->fetch_object()) {
                      ?>
                      <option value="<?php echo $rowDiagnosis->id; ?>"><?php echo $rowDiagnosis->Name." [".$rowDiagnosis->codeICD."]"; ?></option>
                      <?php 
                    }
                  ?>

                </select>
              <br>
              <label for="ex2">Льготные контигенты</label>
              <input class="form-control" type="text" pattern="^[а-яё\s]+$+;+[0-9]" required placeholder="" name="freeMedicalService" >
              <br>
              <?php 
              $sqlDerivationTypes="SELECT * FROM `derivationstype`";
              $queryDerivationTypes=$connection->query($sqlDerivationTypes);
                    while ($rowDerivationTypes=$queryDerivationTypes->fetch_object()) {
?>
              <label for="ex2"><?php echo $rowDerivationTypes->name; ?></label>
              <input class="form-control" type="text" pattern="^[а-яё\s]+$+;+[0-9]" required placeholder="Пример(<?php echo $rowDerivationTypes->name.'1;'.$rowDerivationTypes->name.'2;'; ?>)" name="<?php echo "DerivationTypes".$rowDerivationTypes->id;?>" >
              <br>
<?php

                    }
              ?>
              <input type="hidden" name="act" value="add043">
              <input type="hidden" name="patientId" value="<?php echo $rowPatient->id; ?>">
              <input type="hidden" name="orgId"  value="<?php echo $user->organizationId; ?>">

              <button type="submit" class="btn btn-success">Добавить</button>

            </div>
            </form>

          </div>
          </div>

          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th><h2>Дата</h2></th>

                </tr>
              </thead>
              <tbody>
                <?php
                $sqlAllClinics="SELECT * FROM `form043` where patient_id='$rowPatient->id'";
                $queryAllClinics=$connection->query($sqlAllClinics);
                  while ($rowAllClinics=$queryAllClinics->fetch_object()) {
                    
                    ?>
                <tr>
                  <td><b><?php echo $rowAllClinics->date; ?></b></td>
                  <td><a href="index.php?page=form043&id=<?php echo $rowAllClinics->id; ?>"><button type="button" class="btn btn-info">Информация</button></a></td>
                </tr>
                    <?php
                    
                  }


                ?>
                
                <?php

                ?>
              </tbody>
            </table>
          </div>

            <?php 
          }
  }
}else{
              $_SESSION['message']="Ошибка";
            header("Location:index.php");
}

?>
