        <?php 
        $bin=$_GET['bin'];
    $sqlSelectOrg="SELECT * FROM `organizations` where bin=\"".$bin."\"";
    $_SESSION['bin']=$bin;
    $querySelectOrg=$connection->query($sqlSelectOrg);
      if ($rowSelectOrg=$querySelectOrg->fetch_object()) {
        ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Организации</h1>
          <div class="table-responsive">
            <form action="controllers/act.php" method="POST">
            <div class="col-xs-3">
              <label for="ex2">Добавить новую организацию</label>
              <label >БИН</label>
              <input class="form-control" id="ex2"  disabled value="<?php echo $bin;?>" type="text" placeholder="">
              <input type="hidden" name="act" value="updateOrganization">
              <input type="hidden" name="bin" value="<?php echo $bin;?>">
              <br>
              <input class="form-control" required id="ex2" name="ur_address" type="text" value="<?php echo $rowSelectOrg->ur_address; ?>" placeholder="Введите юридический адрес">
              <br>
              <input class="form-control" required id="ex2" name="name" value="<?php echo $rowSelectOrg->name; ?>"type="text"  placeholder="Введите наименование">
              <br>
              <input class="form-control"  required id="ex2" name="tel_number" value="<?php echo $rowSelectOrg->tel_number; ?>" type="text" placeholder="Введите номер контактного телефона, факса с указанием кода города">
              <br>
              <input class="form-control"  required id="ex2" name="director" value="<?php echo $rowSelectOrg->director; ?>"  type="text" placeholder="Введите ИИН Директора">
              <br>

              <button type="submit" class="btn btn-success">Изменить</button>
            </div>
            </form>

          </div>

<?php
}


?>