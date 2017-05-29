<?php 
  if($user->statusId==3){
    ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Замечания</h1>
          <div class="table-responsive">
            <form action="controllers/act.php" method="POST">
            <div class="col-xs-3">
              <label for="ex2">Добавить новую замечание</label>
               <input class="form-control" id="ex2" name="note" type="text" required placeholder="Введите замечание">
               <input type="hidden" name="act" requiared value="addNote">
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
                $sqlAllClinics="SELECT * FROM `derivationstype`  ";
                $queryAllClinics=$connection->query($sqlAllClinics);
                  while ($rowAllClinics=$queryAllClinics->fetch_object()) {
                    
                    ?>
                <form action="" method="POST" class="navbar-form navbar-right">
                  <input  type="hidden" name="act" value="deleteOrganization">
                  <input type="hidden" name="clinicId" value="<?php echo $rowAllClinics->id ; ?>">

                <tr>
                  <td><b><?php echo $rowAllClinics->name; ?></b></td>
                  <td><a href=""><button type="button" class="btn btn-info">Информация</button></a></td>
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