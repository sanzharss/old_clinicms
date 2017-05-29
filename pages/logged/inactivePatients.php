        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Пациенты</h1>
          <div class="table-responsive">
            <form action="controllers/act.php" method="POST">
            <div class="col-xs-3">
              <label for="ex2">Добавить нового пциента</label>
              <input class="form-control" id="ex2" type="text" name="iin" placeholder="Введите ИИН">
              <br>
              <input class="form-control" id="ex2" type="text" name="name" placeholder="Имя">
              <br>
              <input class="form-control" id="ex2" type="text" name="surname" placeholder="Фамилия">
              <br>
              <input class="form-control" id="ex2" type="text" name="patr" placeholder="Отчество">
              <br>
              <input class="form-control" id="ex2" type="text" name="date" placeholder="Дата рождения(гггг-мм-дд)">
              <br>
                <select class="form-control" name="genderId" id="sel1">
                   <option value="" selected disabled>Пол</option>
                  <option value="1">М</option>
                  <option value="2">Ж</option>
                </select>
              <br>
              <input class="form-control" id="ex2" type="text" name="address" placeholder="Адрес">
              <br>
              <input type="hidden" name="act" value="addPatient">
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
                $sqlPatients="select * from patient  where status='0'";
                $queryPatients=$connection->query($sqlPatients);
                  while ($rowPatients=$queryPatients->fetch_object()) {
                    ?>
                <form action="controllers/act.php" method="POST" class="navbar-form navbar-right">
                  <input type="hidden" name="act" value="deletePatient">
                  <input type="hidden" name="patientId" value="<?php echo $rowPatients->id ; ?>">

                <tr>
                  <td><b><?php echo $rowPatients->surname." ".$rowPatients->name." ".$rowPatients->Patronymic; ?></b></td>
                  <td><a href="index.php?page=Patient&iin=<?php echo $rowPatients->iin; ?>"><button type="button" class="btn btn-info">Информация</button></a></td>
                  <td><button type="submit" class="btn btn-danger">Удалить</button></td>
                </tr>

                </form> 


                  <?php 
                  }
                ?>
               

              </tbody>
 
            </table>
          </div>