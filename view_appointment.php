<?php
include_once('components/conect.php');

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('location:login.php');
    exit;
}

if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location:book_appointment.php');
    exit;
}
if(isset($_POST['canceled'])){
    $update_appointment = $conn -> prepare("UPDATE `appointments` SET status = ? WHERE id = ? LIMIT 1");
    $update_appointment->execute(['canceled' , $get_id]);
    header('location:book_appointment.php');

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
        <h1> Detalhes de Agendamentos</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. ...</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt">Detalhes de Agendamentos</i></span>
    </div>
</div>

<div class="appointment-detail">
    <div class="heading">
        <h1>Detalhes de Agendamentos</h1>
        
    </div>
    <div class="container">
        <?php
        $grand_total = 0;

        $select_appointment = $conn->prepare("SELECT * FROM `appointments` WHERE id = ? LIMIT 1");
        $select_appointment->execute([$get_id]);

        if ($select_appointment->rowCount() > 0) {
            while ($fetch_appointment = $select_appointment->fetch(PDO::FETCH_ASSOC)) {
                $select_service = $conn->prepare("SELECT * FROM `services` WHERE id = ? LIMIT 1");
                $select_service->execute([$fetch_appointment['service_id']]);

                if ($select_service->rowCount() > 0) {
                    while ($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)) {
                        // Aqui você pode definir o subtotal se quiser
                        $sub_total = $fetch_service['price'];
                        $grand_total += $sub_total;
        ?>
        <div class="box">
            <div class="col">
                <img src="uploaded_files/services/<?= $fetch_service['image']; ?>" class="image">
                <p class="date"><i class="bx bxs-calendar-alt"></i>
                <span><?= $fetch_appointment['date']; ?></span></p>
                <div class="detail">
                    <h3 class="name"><?= $fetch_service['name']; ?></h3>
                    <p class="price">Valor: <span style="color: red;">R$ <?= $fetch_service['price']; ?></span></p>
                </div>
            </div>
            <div class="col">
                <?php
                $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE id = ? LIMIT 1");
                $select_employee->execute([$fetch_appointment['employee_id']]);

                if ($select_employee->rowCount() > 0) {
                    while ($fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <p class="title">nome do funcionário</p>
                <div class="employee_detail">
                    <img src="uploaded_files/services/<?= $fetch_employee['profile']; ?>" class="employee">
                        <div>
                            <p><?= $fetch_employee['name']; ?></p>
                            <p><?= $fetch_employee['profession']; ?></p>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
                <p class="title">detalhes de usuário</p>
                <p class="user"><i class="bx bxs-user-rectangle"></i>
                <?= $fetch_appointment['name']; ?></p>
                 <p class="user"><i class="bx bxs-user-outgoing"></i>
                <?= $fetch_appointment['number']; ?></p>
                 <p class="user"><i class="bx bxs-user-envelope"></i>
                <?= $fetch_appointment['date']; ?></p>
                 <p class="user"><i class="bx bxs-user-rectangle"></i>
                <?= $fetch_appointment['time']; ?></p>
                <p class="title">Estado de agendamento</p>
                <p class="status" style="color:<?php if($fetch_appointment['status']=='reservado'){echo "green";}
                elseif($fetch_appointment['status'] =='canceled')
                {echo "red";}else{echo "orange";} ?>"><?= $fetch_appointment['status'];?></p>

                <?php if($fetch_appointment['status'] =='canceled'){ ?>
                    <a href="appointment.php?get_id=<?= $fetch_service['id']; ?> " class="btn">
                        Faça o agendamento de novo</a>
                 <?php }else{?>
                    <form action="" method="post">
                        <button type="submit" name="canceled" class="btn" onclick="return confirm ('você tem certeza que quer cancelar esse agendamento?');">cancelar agendamento</button>
                    </form>       
                    <?php }?>
            </div>
        </div>
        <?php
                    }
                }
            }
        } else {
            echo '<div class="empty"><p>Nenhuma consulta agendada encontrada!</p></div>';
        }
        ?>
    </div>
</div>

<?php include_once('components/user_footer.php'); ?>

<!--sweetalert cdn link-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include('components/alert.php'); ?>
<script type="text/javascript" src="js/user_script.js?v=<?php echo time(); ?>"></script>
</body>
</html>