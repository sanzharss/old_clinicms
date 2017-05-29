        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Организации(неактивные)</h1>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th><h2>Наименование</h2></th>

                </tr>
              </thead>
              <tbody>
                <?php
                $sqlAllClinics="SELECT * FROM `organizations` where status='0' and tel_number!='clinic'";
                $queryAllClinics=$connection->query($sqlAllClinics);
                  while ($rowAllClinics=$queryAllClinics->fetch_object()) {
                    
                    ?>
                <form action="controllers/act.php" method="POST" class="navbar-form navbar-right">
                  <input  type="hidden" name="act" value="toActiveOcrganization">
                  <input type="hidden" name="clinicId" value="<?php echo $rowAllClinics->id ; ?>">
                  <input type="hidden" name="director" value="<?php echo $rowAllClinics->director ; ?>">

                <tr>
                  <td><b><?php echo $rowAllClinics->name; ?></b></td>
                  <td><a href="index.php?page=Clinic&bin=<?php echo $rowAllClinics->bin; ?>"><button type="button" class="btn btn-info">Информация</button></a></td>
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