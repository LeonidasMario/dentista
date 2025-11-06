<?php
include_once('../componentes/conect.php');

$admin_id = $_COOKIE['admin_id'] ?? '';
if (empty($admin_id)) {  
    header('location:login.php');
    exit;
}

$get_id = $_GET['post_id'] ?? '';

if(isset($_POST['delete'])){
    $employee_id = $_POST['employee_id'];
    $employee_id = filter_var($employee_id, FILTER_SANITIZE_STRING);

    // Seleciona o funcionário para deletar a imagem se existir
    $delete_image = $conn->prepare("SELECT * FROM `employee` WHERE id = ?");
    $delete_image->execute([$employee_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

    if (!empty($fetch_delete_image['profile'])) {
        $image_path = '../images/services/' . $fetch_delete_image['profile'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    $delete_employee = $conn->prepare("DELETE FROM `employee` WHERE id = ?");
    $delete_employee->execute([$employee_id]);

    header('location:view_employee.php');
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <link rel="stylesheet" type="text/css" href="../css/admi_style.css?v=<?php echo time(); ?>">
    </head>
    <body style="padding-left:0;">
        <div class="main-container">
            <?php include_once('../admin/admin_header.php'); ?>
            <section class="read-container">
                <div class="heading">
                    <h1><img src="../images/separator.png">Detalhes do Funcionário<img src="../images/separator.png"></h1>
                </div>
                <div class="box-container">
                    <?php
                        $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE id = ?");
                        $select_employee->execute([$get_id]);
                        if($select_employee->rowCount() > 0){
                            while($fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <form action ="" method="post" class="box">
                        <input type ="hidden" name ="employee_id" value="<?= htmlspecialchars($fetch_employee['id']); ?>">
                        <div class="status" style="color: <?= ($fetch_employee['status'] == 'active') ? 'limegreen' : 'red'; ?>;">
                            <?= htmlspecialchars($fetch_employee['status']) ?>
                        </div>
                        <?php if (!empty($fetch_employee['profile'])) { ?>
                           <img src="../images/services/<?= htmlspecialchars($fetch_employee['profile']) ?>" class="image">
                        <?php } ?>
                        <div class="name"><?= htmlspecialchars($fetch_employee['name']) ?></div>
                        <div class="email">Número : <span><?= htmlspecialchars($fetch_employee['number']) ?></span></div>
                        <div class="profession">Profissão :<span><?= htmlspecialchars($fetch_employee['profession']) ?></span></div>
                        <div class="email"> Email :<span><?= htmlspecialchars($fetch_employee['email']) ?></span></div>
                        <div class="content"><?= htmlspecialchars($fetch_employee['profile_dec']) ?></div>
                        <div class="flex-btn">
                           <a href="edit_employee.php?post_id=<?= htmlspecialchars($fetch_employee['id']); ?>" class="btn">Editar</a>

                            <button type="submit" name="delete" class="btn" onclick="return confirm('Deletar este funcionário?');">Deletar</button>
                            <a href="view_employee.php" class="btn">Voltar</a>
                        </div>
                    </form>
                    <?php
                            }
                        }
                    ?>
                </div>
            </section>
        </div>
        <div class ="em">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <?php include('../componentes/alert.php'); ?>
            <script type="text/javascript" src="../js/admin_script.js?v=<?php echo time(); ?>"></script>
        </div>
    </body>
</html>
