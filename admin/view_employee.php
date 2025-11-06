<?php
include_once('../componentes/conect.php');

$admin_id = $_COOKIE['admin_id'] ?? '';
if (empty($admin_id)) {  
    header('location:login.php');
    exit;
}

if(isset($_POST['delete'])){
    $employee_id = $_POST['employee_id'];
    $employee_id = filter_var($employee_id, FILTER_SANITIZE_STRING);

    $delete_employee = $conn->prepare("DELETE FROM `employee` WHERE id = ?");
    $delete_employee->execute([$employee_id]);

    $success_msg[] = 'Funcionário deletado com sucesso!';
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
    <body style="padding-left:0;">
        <div class="main-container">
            <?php include_once('../admin/admin_header.php'); ?>
            <section class="show-container">
                <div class="heading">
                    <h1><img src="../images/separator.png">Nossos Funcionários<img src="../images/separator.png"></h1>
                </div>
                <div class="box-container">
<?php 
$select_employee = $conn->prepare("SELECT * FROM `employee`");
$select_employee->execute();

if ($select_employee->rowCount() > 0) {
    while ($fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC)) {
?>
                    <div class="box">
                        <form action="" method="post" class="box">
                            <input type="hidden" name="employee_id" value="<?= htmlspecialchars($fetch_employee['id']) ?>">
                            <?php if (!empty($fetch_employee['profile'])) { ?>
                                <img src="../images/services/<?= htmlspecialchars($fetch_employee['profile']) ?>" class="image">
                            <?php } ?>
                            <div class="status" style="color: <?= ($fetch_employee['status'] == 'active') ? 'limegreen' : 'red'; ?>;">
                                <?= htmlspecialchars($fetch_employee['status']) ?>
                            </div>
                            <div class="content">
                                <div class="title"><?= htmlspecialchars($fetch_employee['name']) ?></div>
                                <h2>Profissão: <span><?= htmlspecialchars($fetch_employee['profession']); ?></span></h2>
                                <div class="flex-btn">
                                    <a href="edit_employee.php?post_id=<?= $fetch_employee['id']; ?>" class="btn">Editar</a>
                                    <button type="submit" name="delete" class="btn" onclick="return confirm('Deseja deletar este funcionário?');">Deletar</button>
                                    <a href="read_employee.php?post_id=<?= $fetch_employee['id']; ?>" class="btn">Ler</a>
                                </div>
                            </div>
                        </form>
                    </div>
<?php
    }
} else {
    echo '
    <div class="empty">
    <p>Sem funcionários ainda!<br>
    <a href="add_employee.php" class="btn" style="margin-top: 1rem;">Adicionar funcionário</a></p>
    </div>
    ';
}
?>
                </div>
            </section>
        </div>
        <div class="em">
            <!--sweetalert cdn link--> 
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <!--custom js file link-->
            <?php include('../componentes/alert.php'); ?>
            <script type="text/javascript" src="../js/admin_script.js?v=<?php echo time(); ?>"></script>
        </div>
    </body>
</html>
