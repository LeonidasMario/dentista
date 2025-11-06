<?php
include_once('../componentes/conect.php');

$admin_id = $_COOKIE['admin_id'] ?? '';
if (empty($admin_id)) {  
    header('location:login.php');
    exit;
}

if(isset($_POST['delete'])){
    $delete_id = $_POST['delete_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

    $verify_delete = $conn->prepare("SELECT * FROM `appointments` WHERE id = ?");
    $verify_delete->execute([$delete_id]);

    if($verify_delete->rowCount() > 0){
        $delete_appointment = $conn->prepare("DELETE FROM `appointments` WHERE id =?");
        $delete_appointment->execute([$delete_id]);
        $success_msg[] = 'appointment_id deletada!';
    } else {
        $warning_msg[] = 'appointment_id já foi deletada!';
    }
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
    <link rel="stylesheet" type="text/css" href="../css/admi_style.css?v=<?php echo time(); ?>">
</head>
<body class="dashboard-bg" style="padding-left:0;">


<div class="main-container">
    <?php include_once('../admin/admin_header.php'); ?>
    <section class="appointment-container">
        <div class="heading">
            <h1><img src="../images/separator.png"> Painel de consultas <img src="../images/separator.png"></h1>
        </div>
        <div class="box-container">
        <?php
        $select_appointment = $conn->prepare("SELECT * FROM `appointments`");
        $select_appointment->execute();

        if ($select_appointment->rowCount() > 0) {
            while($fetch_appointment = $select_appointment->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div class="box">
    <div class="status" style="color:<?= ($fetch_appointment['status']=='in progress') ? "limegreen" : "red"; ?>">
        <?php
            if($fetch_appointment['status']=='canceled'){
                echo 'cancelado';
            } else if($fetch_appointment['status']=='in progress'){
                echo 'em andamento';
            } else if($fetch_appointment['status']=='booked'){
                echo 'agendado';
            } else{
                echo htmlspecialchars($fetch_appointment['status']);
            }
        ?>
    </div>
    <div class="content-flex">
        <?php
        // Buscar e exibir funcionário deste agendamento
        $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE id = ? LIMIT 1");
        $select_employee->execute([$fetch_appointment['employee_id']]);
        if ($select_employee->rowCount() > 0) {
            $fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="employee-photo">
    <img src="../images/h1-img-team-single-2.jpg" alt="Teste funcionario"
     style="width:120px; height:120px; border-radius:50%; border: 4px solid orange; object-fit: cover;">

</div>


        <?php } ?>
        <div class="detail">
            <?php if ($select_employee->rowCount() > 0) { ?>
            <p class="title">selecionar funcionário: <span><?= htmlspecialchars($fetch_employee['name']); ?></span></p>
            <?php } ?>
            <p>nome do usuário: <span><?= htmlspecialchars($fetch_appointment['name']); ?></span></p>
            <p>id do usuário: <span><?= htmlspecialchars($fetch_appointment['user_id']); ?></span></p>
            <p>Data: <span><?= htmlspecialchars($fetch_appointment['date']); ?></span></p>
            <p>numero: <span><?= htmlspecialchars($fetch_appointment['number']); ?></span></p>
            <p>email: <span><?= htmlspecialchars($fetch_appointment['email']); ?></span></p>
            <p>tempo: <span><?= htmlspecialchars($fetch_appointment['time']); ?></span></p>
            <p>preço total: <span><?= htmlspecialchars($fetch_appointment['price']); ?></span></p>
            <?php
            // Buscar e exibir o serviço deste agendamento
            $select_service = $conn->prepare("SELECT * FROM `services` WHERE id = ? LIMIT 1");
            $select_service->execute([$fetch_appointment['service_id']]);
            if($select_service->rowCount() > 0){
                $fetch_service = $select_service->fetch(PDO::FETCH_ASSOC);
            ?>
                <div class="service">
                    <p class="title">selecionar serviço: <span><?= htmlspecialchars($fetch_service['name']); ?></span></p>
                </div>
            <?php } else { ?>
                <div class="service">
                    <p>Serviço não encontrado para esse ID.</p>
                </div>
            <?php } ?>
        </div>
    </div>
               <form action ="" method="post">
                <input type="hidden" name="delete_id" value ="<?= $fetch_appointment['id']; ?>">
                <button type="submit" name ="delete" class="btn" onclick="return confirm('delete this appointment');">delete appointment</button>
                </form>
      </div>

        <?php
            } // fecha while
        } else {
            echo "<div class='empty'><p>Nenhuma consulta encontrada!</p></div>";
        }
        ?>
        </div>
    </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include('../componentes/alert.php'); ?>
<script type="text/javascript" src="../js/admin_script.js?v=<?php echo time(); ?>"></script>
</body>
</html>
