  <?php
     include_once('../componentes/conect.php');
     
       $admin_id = $_COOKIE['admin_id']?? '';
       if (empty($admin_id)){  
           header('location:login.php');
           exit;
          } 

    
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
       <section class="dashboard">
        <div class="heading">
          <h1><img src="../images/separator.png" >dashboard<img src="../images/separator.png"></h1>
        </div>
            <h3>Dashboard</h3>
            <p>Bem-vindo ao painel de controle</p>
           <div class="box-container">
               <div class="box">
                   <h3>Bem-vindo de volta!</h3>
                   <p><?= $fetch_profile['name']; ?></p>
                   <a href="profile.php" class="btn">Ver Perfil</a>
               </div>
               <div class="box">
                   <?php
                   $select_msg = $conn->prepare("SELECT * FROM `message`");
                   $select_msg->execute();
                   $num_of_msg = $select_msg->rowCount();
                   ?>
                   <h3><?= $num_of_msg; ?></h3>
                   <p>Mensagens</p>
                   <a href="admin_message.php" class="btn">Ver Mensagens</a>
               </div>
               <div class="box">
                   <?php
                   $select_services = $conn->prepare("SELECT * FROM `services`");
                   $select_services->execute();
                   $num_of_services = $select_services->rowCount();
                   ?>
                   <h3><?= $num_of_services; ?></h3>
                   <p>ver serviços</p>
                   <a href="view_services.php" class="btn">Ver Serviços</a>
               </div>
               <div class="box">
                   <?php
                   $select_active_services = $conn->prepare("SELECT * FROM `services` WHERE status = ?");
                   $select_active_services->execute(['active']);
                   $num_of_active_services = $select_active_services->rowCount();
                   ?>
                   <h3><?= $num_of_active_services; ?></h3>
                   <p>ver serviços ativos</p>
                   <a href="view_services.php" class="btn">Serviços Ativos</a>
               </div>
               <div class="box">
                   <?php
                   $select_deactive_services = $conn->prepare("SELECT * FROM `services` WHERE status = ?");
                   $select_deactive_services->execute(['deactive']);
                   $num_of_deactive_services = $select_deactive_services->rowCount();
                   ?>
                   <h3><?= $num_of_deactive_services; ?></h3>
                   <p>ver serviços inativos</p>
                   <a href="view_services.php" class="btn">Serviços Inativos</a>
               </div>
               <div class="box">
                   <?php
                   $select_employee = $conn->prepare("SELECT * FROM `employee`");
                   $select_employee->execute();
                   $num_of_employee = $select_employee->rowCount();
                   ?>
                   <h3><?= $num_of_employee; ?></h3>
                   <p>ver funcionários</p>
                   <a href="view_employee.php" class="btn">Ver funcionários</a>
               </div>
               <div class="box">
                   <?php
                   $select_appointments = $conn->prepare("SELECT * FROM `appointments`");
                   $select_appointments->execute();
                   $num_of_appointments = $select_appointments->rowCount();
                   ?>
                   <h3><?= $num_of_appointments; ?></h3>
                   <p>ver consultas</p>
                   <a href="admin_appointments.php" class="btn">Ver consultas</a>
               </div>
               <div class="box">
                   <?php
                   $select_cancelled_appointments = $conn->prepare("SELECT * FROM `appointments` WHERE status = ?");
                   $select_cancelled_appointments->execute(['cancelled']);
                   $num_of_cancelled_appointments = $select_cancelled_appointments->rowCount();
                   ?>
                   <h3><?= $num_of_cancelled_appointments; ?></h3>
                   <p>ver consultas canceladas</p>
                   <a href="admin_appointments.php" class="btn">Consultas Canceladas</a>
               </div>
            <div class="box">
                   <?php
                   $select_users= $conn->prepare("SELECT * FROM `users`");
                   $select_users->execute();
                   $num_of_users = $select_users->rowCount();
                   ?>
                   <h3><?= $num_of_users; ?></h3>
                   <p>todos os usuários</p>
                   <a href="admin_message.php" class="btn">Ver Usuários</a>
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
