        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?php echo "Hello ".$user->name; ?></h1>

          <div class="row placeholders">
            <?php 
              if($_SESSION['userData']->statusId==3){
                ?>
                <div class="col-xs-6 col-sm-3 placeholder">
              <img src="images\clinics.jpg" width="200" height="200" class="img-responsive" alt="Photo">
              <a href="?page=Clinics"><button class="btn">Организации</button></a>
            </div>
                <?php 
              }
            ?>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="images\doctors.jpg" width="200" height="200" class="img-responsive" alt="Photo">
              <a href="?page=doctors"><button class="btn">Врачи</button></a>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="images\nurse.jpg" width="200" height="200" class="img-responsive" alt="Photo">
              <a href="?page=medPersonal"><button class="btn">Медицинский персонал</button></a>
            </div>
            <?php 
              if($_SESSION['userData']->statusId==0){
                ?>
                <div class="col-xs-6 col-sm-3 placeholder">
              <img src="images\patients.jpg" width="200" height="200" class="img-responsive" alt="Photo">
              <a href="?page=patients"><button class="btn">Пациенты</button></a>
            </div>
                <?php 
              }
            ?>
            
          </div>

        </div>