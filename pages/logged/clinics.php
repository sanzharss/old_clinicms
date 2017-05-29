        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Организации</h1>
          <div class="table-responsive">
            <form action="controllers/act.php" method="POST">
            <div class="col-xs-3">
              <label for="ex2">Добавить новую организацию</label>
               <input class="form-control" id="ex2" name="bin" type="text" placeholder="Введите БИН">
             
              <!-- <input class="form-control" id="ex2" name="organizationName" type="text" placeholder="Введите наименование">
              --> <input type="hidden" name="act" value="addOrganization">
            <!--   <br>
              <input class="form-control" id="ex2" name="ur_address" type="text" placeholder="Введите юридический адрес">
              <br>
              <input class="form-control" id="ex2" name="bin" type="text" placeholder="Введите БИН">
              <br>
              <input class="form-control" id="ex2" name="name" type="text" placeholder="Введите наименование">
              <br>
              <input class="form-control" id="ex2" name="tel_number" type="text" placeholder="Введите номер контактного телефона, факса с указанием кода города">
              <br>
              <input class="form-control" id="ex2" name="director" type="text" placeholder="Введите ФИО Директора">
               -->
              <br>
              <button type="submit" class="btn btn-success">Добавить</button>
            </div>
            </form>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th><h2>Наименование</h2></th>

                </tr>
              </thead>
              <tbody>
                <?php
                $sqlAllClinics="SELECT * FROM `organizations` where status='1' ";
                $queryAllClinics=$connection->query($sqlAllClinics);
                  while ($rowAllClinics=$queryAllClinics->fetch_object()) {
                    
                    ?>
                <form action="controllers/act.php" method="POST" class="navbar-form navbar-right">
                  <input type="hidden" name="act" value="deleteOrganization">
                  <input type="hidden" name="clinicId" value="<?php echo $rowAllClinics->id ; ?>">

                <tr>
                  <td><b><?php echo $rowAllClinics->name; ?></b></td>
                  <td><a href="index.php?page=Clinic&bin=<?php echo $rowAllClinics->bin; ?>"><button type="button" class="btn btn-info">Информация</button></a></td>
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