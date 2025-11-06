  <?php
     include_once('../componentes/conect.php');
     
       $admin_id = $_COOKIE['admin_id']?? '';
       if (empty($admin_id)){  
           header('location:login.php');
           exit;
          } 
          $select_service = $conn->prepare("SELECT * FROM `services`");
          $select_service->execute();
          $total_service = $select_service->rowCount();

          $select_employee = $conn->prepare("SELECT * FROM `employee`");
          $select_employee->execute();
          $total_employee = $select_service->rowCount();

          $select_appointment= $conn->prepare("SELECT * FROM `services`");
          $select_appointment->execute();
          $total_appointment= $select_service->rowCount();

         
?>

     <!doctype html>
     <html lang="pt-br">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Uni-Sorriso</title>


            <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
            <link rel="stylesheet" type="text/css" href="../css/admi_style.css?v=<?php echo time(); ?> ">  



        </head>
        <body class="dashboard-bg" style ="padding-left:0;">

        <div class= "main-container">
            <?php include_once('../admin/admin_header.php'); ?>
       <section class="profile-container">
        <div class="heading">
          <h1><img src="../images/separator.png" >Detalhes de perfil<img src="../images/separator.png"></h1>
        </div>
          <div class="details">
            <div class="admin">
               <img src="../uploaded_files/perfil.png" width="150">
                <h3><?= $fetch_profile['name'];?></h3>
                <span>admin</span>
                <a href="profile.php" class="btn">Perfil</a>
               </div>
              <div class="flex">
                 <div class ="box">
                    <span><?= $total_appointment; ?></span>
                    <p>Total </p>
                    <a href="view_service.php" class="btn">Serviços</a>
                 </div>
                 <div class ="box">
                    <span><?= $total_employee; ?></span>
                    <p>Total </p>
                    <a href="view_service.php" class="btn">funcionários</a>
                 </div>
                 
                 <div class ="box">
                    <span><?= $total_appointment; ?></span>
                    <p> Total</p>
                    <a href="admin_appointments.php" class="btn" >Nomeações</a>
                  </div>

            </div>
          </div>
       </section>
        </div>

             <!--sweetalert cdn link--> 

           <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
           <!--custom js file link-->
           
              <?php include('../componentes/alert.php'); ?>
        </body>
        <script type="text/javascript" src="../js/admin_script.js?v=<?php echo time(); ?>"></script>
     </html>
