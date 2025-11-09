<?php
include_once('../componentes/conect.php');

// Verifica se admin está logado
$admin_id = $_COOKIE['admin_id'] ?? '';
if (empty($admin_id)){
    header('location:login.php');
    exit;
}

// Função unique_id() deve existir em conect.php

if (isset($_POST['add_employee'])) {
    $id = unique_id();

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $profession = filter_var($_POST['profession'], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $profile_desc = filter_var($_POST['profile_desc'], FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../images/services/' . $image;

    $status = 'active';

    $select_image = $conn->prepare("SELECT * FROM `employee` WHERE profile = ?");
    $select_image->execute([$image]);

    if (!empty($image)) {
        if ($select_image->rowCount() > 0){
            $warning_msg[] = 'A imagem do funcionário já existe!';
        } elseif ($image_size > 2000000) {
            $warning_msg[] = 'O tamanho da imagem é muito grande!';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $image = '';
    }

    if ($select_image->rowCount() > 0 && $image != '') {
        $warning_msg[] = 'O nome da imagem do funcionário já existe!';
    } else {
        $insert_employee = $conn->prepare("INSERT INTO `employee` (id, name, profession, email, number, profile_desc, profile, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_employee->execute([$id, $name, $profession, $email, $number, $profile_desc, $image, $status]);
        $success_msg[] = 'Novo funcionário adicionado!';
    }
}

if (isset($_POST['draft'])) {
    $id = unique_id();

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $profession = filter_var($_POST['profession'], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $profile_desc = filter_var($_POST['profile_desc'], FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../images/services/' . $image;

    $status = 'deactive';

    $select_image = $conn->prepare("SELECT * FROM `employee` WHERE profile = ?");
    $select_image->execute([$image]);

    if (!empty($image)) {
        if ($select_image->rowCount() > 0){
            $warning_msg[] = 'A imagem do funcionário já existe!';
        } elseif ($image_size > 2000000) {
            $warning_msg[] = 'O tamanho da imagem é muito grande!';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $image = '';
    }

    if ($select_image->rowCount() > 0 && $image != '') {
        $warning_msg[] = 'O nome da imagem do funcionário já existe!';
    } else {
        $insert_employee = $conn->prepare("INSERT INTO `employee` (id, name, profession, email, number, profile_desc, profile, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_employee->execute([$id, $name, $profession, $email, $number, $profile_desc, $image, $status]);
        $success_msg[] = 'Rascunho de funcionário adicionado!';
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
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" type="text/css" href="../css/admi_style.css?v=<?php echo time(); ?>">
</head>
<body style="padding-left:0;">
    <div class="main-container">
        <?php include_once('../admin/admin_header.php'); ?>
        <section class="dashboard">
            <div class="heading">
                <h1><img src="../images/separator.png">Adicionar funcionários<img src="../images/separator.png"></h1>
            </div>
            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data" class="register">
                    <div class="flex">
                        <div class="col">
                            <div class="input-field">
                                <p>nome do funcionário <span>*</span></p>
                                <input type="text" name="name" placeholder="add employee name" class="box-input" required>
                            </div>
                            <div class="input-field">
                                <p>email do funcionário <span>*</span></p>
                                <input type="email" name="email" placeholder="add employee email" class="box-input" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-field">
                                <p>profissão do funcionário <span>*</span></p>
                                <input type="text" name="profession" placeholder="add employee profession" class="box-input" required>
                            </div>
                            <div class="input-field">
                                <p>numero do funcionário <span>*</span></p>
                                <input type="number" name="number" placeholder="add employee number" class="box-input" required>
                            </div>
                        </div>
                    </div>
                    <div class="input-field">
                        <p>descrição de perfil <span>*</span></p>
                        <textarea name="profile_desc" placeholder="employee profile description" class="box-input"></textarea>
                    </div>
                    <div class="input-field">
                        <p>selecionar o perfil <span>*</span></p>
                        <input type="file" name="image" accept="image/*" class="box-input" required>
                    </div>
                    <div class="flex-btn">
                        <button type="submit" name="add_employee" class="btn">Adicionar funcionário</button>
                        <button type="submit" name="draft" class="btn">Salvar como Rascunho</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include('../componentes/alert.php'); ?>
    <script type="text/javascript" src="../js/admin_script.js?v=<?php echo time(); ?>"></script>
</body>
</html>
