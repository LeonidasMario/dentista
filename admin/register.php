<?php
include_once('../componentes/conect.php');

if (isset($_POST['register'])) {
    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $pass = $_POST['password']; // Corrigido para 'password' assim como o input
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $cpass = $_POST['cpassword']; // Corrigido para 'cpassword' assim como o input
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $rename;

    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE email = ?");
    $select_admin->execute([$email]);

    if ($select_admin->rowCount() > 0) {
        $warning_msg[] = 'O email já está sendo usado!';
    } elseif ($pass != $cpass) {
        $warning_msg[] = 'As senhas não coincidem!';
    } else {
        $insert_admin = $conn->prepare("INSERT INTO `admin` (id, name, email, password, image) VALUES (?, ?, ?, ?, ?)");
        $insert_admin->execute([$id, $name, $email, $pass, $rename]); // Considere usar hash na senha!

        if (!is_dir('../uploaded_files')) mkdir('../uploaded_files', 0755, true);
        move_uploaded_file($image_tmp_name, $image_folder);
        $success_msg[] = 'Registrado com sucesso! Agora você pode entrar.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Uni-Sorriso - Registro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admi_style.css?v=<?php echo time(); ?>">
</head>
<body class="form-bg" style="padding-left:0;">
    <div class="form-container">
        <form class="form register" action="" method="post" enctype="multipart/form-data">
            <h3>Registrar</h3>
            <div class="flex">
                <div class="col">
                    <p>Seu nome <span>*</span></p>
                    <input type="text" name="name" required placeholder="Digite seu nome" maxlength="50" class="box-input">

                    <p>Seu email <span>*</span></p>
                    <input type="email" name="email" required placeholder="Digite seu email" maxlength="50" class="box-input">
                </div>
                <div class="col">
                    <p>Sua senha <span>*</span></p>
                    <input type="password" name="password" required placeholder="Digite sua senha" maxlength="50" class="box-input">

                    <p>Confirme sua senha <span>*</span></p>
                    <input type="password" name="cpassword" required placeholder="Confirme sua senha" maxlength="50" class="box-input">
                </div>
            </div>
            <div class="input-field">
                <p>Selecione sua foto <span>*</span></p>
                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required class="box-input">
            </div>
            <p class="link">Já tem uma conta? <a href="login.php">Login</a></p>
            <button type="submit" name="register" class="btn">Registrar agora</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../js/admin_script.js"></script>
    <?php include('../componentes/alert.php'); ?>
</body>
</html>
