<?php 
if(isset($_SESSION['user']) ){
?>
        <div class="col-sm-12 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Форма 043</h1>
           <div class="table-responsive">
            <div class="col-xs-3">
              <?php
                $formId=$_GET['id'];
                $sqlForm="select * from form043 where id=$formId";
                  $queryForm=$connection->query($sqlForm);
                  while ($rowForm=$queryForm->fetch_object()) {
                    $sqlPatientSelect="Select * from patient where id=$rowForm->patient_id";
                    $queryPatientSelect=$connection->query($sqlPatientSelect);
                    if($rowPatientSelect=$queryPatientSelect->fetch_object()){
                      ?>
                      <a href="?page=Patient&iin=<?php echo $rowPatientSelect->IIN;?>"><button type="submit" class="btn btn-success">Назад</button></a>
         
                    <p><label for="ex2"><h3>ФИО</h3></label></p>
                    <p><label for="ex2"><?php echo  $rowPatientSelect->name." ".$rowPatientSelect->surname; ?></label></p>
                    <?php
                    }

                    $sqlDiagnosSelectR="Select * from diagnosisrecord where form_043_id=$rowForm->id";
                    $queryDiagnosSelectR=$connection->query($sqlDiagnosSelectR);
                    while($rowDiagnosSelectR=$queryDiagnosSelectR->fetch_object()){
                      $sqlDiagnosSelect="select * from diagnosis where id='$rowDiagnosSelectR->Diagnosis_id'";
                      $queryDiagnosSelect=$connection->query($sqlDiagnosSelect);
                      while($rowDiagnosSelect=$queryDiagnosSelect->fetch_object()){
                        ?>
                    <p><label for="ex2"><h3>Диагноз</h3></label></p>
                    <p><label for="ex2"><?php echo  $rowDiagnosSelect->Name?></label></p>

                        <?php

                      }


                    }



                      $sqlDerivationstype="select * from derivationstype";
                      $queryDerivationstype=$connection->query($sqlDerivationstype);
                      while($rowDerivationstype=$queryDerivationstype->fetch_object()){
                        ?>
                        <p><label for="ex2"><h3><?php echo $rowDerivationstype->name; ?></h3></label></p>
                        <?php

                          $sqlDervRecord="SELECT * FROM `derivationrecord` where form_043_id=$rowForm->id";
                          $queryDervRecord=$connection->query($sqlDervRecord);
                          while($rowDervRecord=$queryDervRecord->fetch_object()){

                            $sqlDerv="SELECT * FROM `derivations` where id=$rowDervRecord->DerivationId and derivation_type_id=$rowDerivationstype->id";
                          
                          $queryDerv=$connection->query($sqlDerv);
                          while($rowDerv=$queryDerv->fetch_object()){
                            echo $rowDerv->name."; ";

                          }

                        }
                      }








                  }
              ?>

            </div>


          </div>

<?php
}else{
  header("Location:../index.php?page=mainPage");
}

?>