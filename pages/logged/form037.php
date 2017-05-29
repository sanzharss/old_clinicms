      <?php 
        function getAge($then) {
    $then_ts = strtotime($then);
    $then_year = date('Y', $then_ts);
    $age = date('Y') - $then_year;
    if(strtotime('+' . $age . ' years', $then_ts) > time()) $age--;
    return $age;
    }
      ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="row">
            <h1 class="page-header">Поиск по дате</h1>
            <form class="form-inline" action="index.php?page=form037" method="POST">
                <div class="form-group">
                  <label for="email">От:</label>
                  <input type="date"  class="form-control" name="dateF">
                </div>
                <div class="form-group">
                  <label for="pwd">До:</label>
                  <input type="date" class="form-control" name="dateS">
                </div>
                <button type="submit" class="btn btn-default">Поиск</button>
              </form>
          </div>
          <br>
          <h1 class="page-header">Форма 037</h1>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th><h4>Время</h4></th>
                  <th><h4>ФИО</h4></th>
                  <th><h4>Дата рождения</h4></th>
                  <th><h4>Число полных лет</h4></th>
                  <th><h4>Адрес</h4></th>
                  <th><h4>Диагноз</h4></th>
                  <th><h4>Льготные контигенты</h4></th>
                </tr>
              </thead>
              <tbody>
                <?php

                $sqlAllForm="SELECT * FROM `form043`";
                if(isset($_POST['dateF'])){
                  if($_POST['dateF']!=""){
                    
                    $date1=$_POST['dateF'];
                    $date2=$_POST['dateS'];
                    $sqlAllForm="SELECT * FROM `form043` where date BETWEEN '$date1'  and '$date2'";

                
                  }
                }
                //echo $sqlAllForm;
                $queryAllForm=$connection->query($sqlAllForm);
                  while ($rowAllForm=$queryAllForm->fetch_object()) {
                    ?>
                <tr>
                  <td><b><?php echo $rowAllForm->date; ?></b></td>

                <?php 
                $sqlPatients="select * from patient  where status='1' and id=$rowAllForm->patient_id";
                $queryPatients=$connection->query($sqlPatients);
                      while ($rowPatients=$queryPatients->fetch_object()) {
                        ?>
                          <td><b><?php echo $rowPatients->surname." ".$rowPatients->name; ?></b></td>
                          <td><b><?php echo $rowPatients->BirthDate; ?></b></td>
                          <td><b><?php echo getAge($rowPatients->BirthDate); ?></b></td>
                          <td><b><?php echo $rowPatients->Address; ?></b></td>
                        <?php 
                        }


                    $sqlDiagnosSelectR="Select * from diagnosisrecord where form_043_id=$rowAllForm->id";
                    $queryDiagnosSelectR=$connection->query($sqlDiagnosSelectR);
                    while($rowDiagnosSelectR=$queryDiagnosSelectR->fetch_object()){
                      $sqlDiagnosSelect="select * from diagnosis where id='$rowDiagnosSelectR->Diagnosis_id'";
                      $queryDiagnosSelect=$connection->query($sqlDiagnosSelect);
                      while($rowDiagnosSelect=$queryDiagnosSelect->fetch_object()){
                        ?>
                      <td><b><?php echo $rowDiagnosSelect->Name; ?></b></td>

                        <?php

                      }


                    }





                      ?>



                <td><b><?php echo $rowAllForm->freeMedicalService; ?></b></td>   
                </tr>


                    <?php
 
                 
                  }


                ?>
                
                <?php

                ?>
              </tbody>
            </table>
          </div>