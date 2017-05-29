<?php 
if(isset($_SESSION['bin']) ){
?>
        <?php 
          if(isset($_SESSION['bin'])){
            $bin=$_SESSION['bin'];
            //unset($_SESSION['bin']);
          }
        ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Организации</h1>
          <div class="table-responsive">
            <form action="controllers/act.php" method="POST">
            <div class="col-xs-3">
              <label for="ex2">Добавить новую организацию</label>
              <label >БИН</label>
              <input class="form-control" id="ex2"  disabled value="<?php echo $bin;?>" type="text" placeholder="">
              <input type="hidden" name="act" value="addOrganizationCompl">
              <input type="hidden" name="bin" value="<?php echo $bin;?>">
              <br>
              <input class="form-control" required id="ex2" name="ur_address" type="text" placeholder="Введите юридический адрес">
              <br>
              <input class="form-control" required id="ex2" name="name" type="text" placeholder="Введите наименование">
              <br>
              <input class="form-control"  required id="ex2" name="tel_number" type="text" placeholder="Введите номер контактного телефона, факса с указанием кода города">
              <br>
              <input class="form-control"  required id="ex2" name="director" type="text" placeholder="Введите ИИН Директора">
      <br>
   <input class="form-control" id="ex2" name="nameDoctor" type="text" required placeholder="Имя Директора">
              <input type="hidden" name="statusId" value="1">
              <br>
              <input class="form-control" id="ex2" name="surname" type="text" required placeholder="Фамилия">              
              <br>
              <input class="form-control" id="ex2" name="password" type="password" required placeholder="Введите пароль">
              <br>

              <button type="submit" class="btn btn-success">Добавить</button>
            </div>
            </form>

          </div>

<?php
}else{
  header("Location:../index.php?page=Clinics");
}

?>