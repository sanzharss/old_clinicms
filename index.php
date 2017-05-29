
<?php 
	session_start();
  header('Content-Type: text/html; charset=utf-8' );
	include "initt/db.php";
	include "pages/head.php";
  $status="";
  //$_SESSION['user']=0;
//  session_destroy();
  if(isset($_SESSION['user'])){
    $status="logged";
    include "model/User.php";
  }else{
    $status="notlogged";
  }
  //echo $status;

?>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only" >CMS</span>

          </button>
          <a class="navbar-brand" href="?page=mainPage">CMS</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
                <?php
    include "pages/".$status."/header.php";


    ?>
        </div>
      </div>
    </nav>


    <div class="container-fluid">
      <div class="row">

      <?php
        if(isset($_SESSION['message'])){
                  
                    ?>
                      <div class="alert alert-danger" align="center">
                        <strong><?php echo $_SESSION["message"]; ?></strong> 
                      </div>
                    <?php
                    unset($_SESSION['message']);

        }else if(isset($_SESSION['messageSuccess'])){
          ?>
          <div class="alert alert-success" align="center">
            <strong><?php echo $_SESSION["messageSuccess"]; ?></strong> 
          </div>
          <?php
           unset($_SESSION['messageSuccess']); 

        }
      ?>

      </div>
    </div>
        <div class="container-fluid">
      <div class="row">
        <?php 
          if(isset($_SESSION['user_id'])){
            ?>
                    <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li ><a href="?page=mainPage">Главная страница </a></li>
            <?php
            if($_SESSION['userData']->statusId==3){
              ?>
               <li ><a href="?page=Clinics">Организации </a></li>
               <li ><a href="?page=ClinicsInactive">Организации(неактивные) </a></li>
               <li><a href="?page=notes" disabled="true">Заключение врача</a></li>
               
            <?php
              }
            ?>
           
            <li><a href="?page=doctors">Врачи</a></li>
            <li ><a href="?page=DoctorsInactive">Врачи(неактивные) </a></li>
            <li><a href="?page=medPersonal">Медицинский персонал</a></li>
            <li><a href="?page=medPersonalInactive">Медицинский персонал(неактивные)</a></li>
             <?php
            if($_SESSION['userData']->statusId!=3){
              ?>
            <li><a href="?page=patients" disabled="true">Пациенты</a></li>
            <li><a href="?page=form037" disabled="true">Форма 037</a></li>
            <li><a href="?page=stat" disabled="true">Дополнительная статистика </a></li>
            <!-- <li><a href="?page=inactivePatients" disabled="true">Пациенты(неактивные)</a></li> -->
            <?php
              }
            ?>
          </ul>
        </div>
            <?php
          }
        ?>

<?php
      if(isset($_GET['page'])){
        if(isset($_SESSION['user'])){
                  $sqlCheck="Select * from users where id=$user->id";
        $queryCheck=$connection->query($sqlCheck);
        while ($rowCheck=$queryCheck->fetch_object()) {
          if($rowCheck->status==0){
            header("Location:pages/loggout.php");
          }

        }
        }
        if($_GET['page']=="Clinics"){
          ?>

        <?php
         include "pages/".$status."/clinics.php";
        ?>
    



          <?php
        
        }else if($_GET['page']=='mainPage'){
        include "pages/".$status."/content.php";        
      }else if($_GET['page']=='doctors'){
        include "pages/".$status."/doctors.php";        
      }else if($_GET['page']=='medPersonal'){
        include "pages/".$status."/medPersonal.php";        
      }else if($_GET['page']=='patients'){
        include "pages/".$status."/patients.php";        
      }else if($_GET['page']=='newClinic'){
        include "pages/".$status."/newClinic.php";        
      }else if($_GET['page']=='Clinic'){
        include "pages/".$status."/clinic.php"; 
      }else if($_GET['page']=='ClinicsInactive'){
        include "pages/".$status."/inactiveClincics.php"; 
      }else if($_GET['page']=='Doctor'){
        include "pages/".$status."/doctor.php"; 
      }else if($_GET['page']=='DoctorsInactive'){
        include "pages/".$status."/inactiveDoctors.php"; 
      }else if($_GET['page']=='medPersonalInactive'){
        include "pages/".$status."/inactiveMP.php"; 
      }else if($_GET['page']=='patients'){
        include "pages/".$status."/patients.php"; 
      }else if($_GET['page']=='inactivePatients'){
        include "pages/".$status."/inactivePatients.php"; 
      }else if($_GET['page']=='Patient'){
        include "pages/".$status."/patient.php"; 
      }else if($_GET['page']=='notes'){
        include "pages/".$status."/notes.php"; 
      }else if($_GET['page']=='form043'){
        include "pages/".$status."/form043.php"; 
      }else if($_GET['page']=='form037'){
        include "pages/".$status."/form037.php"; 
      }else if($_GET['page']=='stat'){
        include "pages/".$status."/stat.php"; 
       // header("Location:pages/".$status."/stat.php");
      }else if($_GET['page']=='medPersonalPage'){
        include "pages/".$status."/medPersonalPage.php"; 
       // header("Location:pages/".$status."/stat.php");
      }



      }else{
        include "pages/".$status."/content.php";        
      }


?>
  </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
