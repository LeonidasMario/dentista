<?php
include_once('components/conect.php');

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
      header('location:login.php');
}



?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uni-Sorriso</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>">
</head>
<body>

<?php include_once('components/user_header.php'); ?>

<div class="banner">
    <div class="detail">
         <h1> consultas marcadas</h1>
        <p>
        Acompanhe suas consultas agendadas com nossa clínica!<br>
        Aqui você encontra todas as informações sobre suas próximas visitas, horários e tipos de atendimento.<br>
        Nossa equipe está pronta para atendê-lo com responsabilidade, pontualidade e dedicação.<br>
        Em caso de dúvidas ou necessidade de alteração, entre em contato conosco.
</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt">Consultas agendadas</i></span>
    </div>
 </div>


      <div class="appointments">
        <div class="heading">
            <h1>Consultas </h1>
        </div>
        <div class="box-container">
            <?php
       
            $select_appointments = $conn-> prepare("SELECT * FROM `appointments` WHERE user_id = ? ");
            $select_appointments ->execute([$user_id]);
        
            if ($select_appointments ->rowCount() > 0 ){

            while($fetch_appointments = $select_appointments ->fetch(PDO::FETCH_ASSOC)){
                $service_id = $fetch_appointments['service_id'];
                $select_service = $conn->prepare("SELECT * FROM `services` WHERE id = ?");
                $select_service ->execute([$fetch_appointments['service_id']]);
                
                if($select_service-> rowCount() > 0){
                    while($fetch_service = $select_service-> fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="box">
                    <a href="view_appointment.php?get_id=<?= $fetch_appointments['id'];?>">
                          <img src="uploaded_files/services/<?= $fetch_service['image']; ?>" class="image">
                        <div class="content">
                            <p class="date"><i class= "bx bxs-calendar-alt"></i><span><?= $fetch_appointments['date'];?></span></p>
                            <div class="now">
                                <h3 class="name"><?= $fetch_service['name'];?></h3>
                                <p class="price">$<?= $fetch_service['price'];?>/-</p>
                                <p class="status" style="color:<?php if($fetch_appointments['status']=='reservado'){echo "green";}else{echo "red";} ?>"><?= $fetch_appointments['status'];?></p>
                            </div>
                        </div>
                        </a>
                </div>
                 <?php         
                    }
                }
                
            }

         }else{
             echo '<div class="empty"><p>Nenhuma consulta
              agendada encontrada!</p></div>';
            }
            ?>
        </div>
      </div>

    


<?php include_once('components/user_footer.php'); ?>

<!--sweetalert cdn link-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!--custom js file link-->
<?php include('components/alert.php'); ?>

<script type="text/javascript" src="js/user_script.js?v=<?php echo time(); ?>"></script>
</body>
</html>
