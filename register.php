<?php
include_once('components/conect.php');

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

   if (isset($_POST['register'])) {
    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $pass = sha1($_POST['password']); 
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $cpass = sha1($_POST['cpassword']); 
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $rename;

    $select_users = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_users->execute([$email]);

    if ($select_users->rowCount() > 0) {
        $warning_msg[] = 'O email já está sendo usado!';
    } elseif ($pass != $cpass) {
        $warning_msg[] = 'As senhas não coincidem!';
    } else {
        $insert_users = $conn->prepare("INSERT INTO `users` (id, name, email, password, image) VALUES (?, ?, ?, ?, ?)");
        $insert_users->execute([$id, $name, $email, $pass, $rename]); // Considere usar hash na senha!

        if (!is_dir('../uploaded_files')) mkdir('../uploaded_files', 0755, true);
        move_uploaded_file($image_tmp_name, $image_folder);
        $success_msg[] = 'Registrado com sucesso! Agora você pode entrar.';
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
    <link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>">
</head>
<body>

<?php include_once('components/user_header.php'); ?>

<div class="banner">
    <div class="detail">
        <h1>registra agora</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate natus quidem, <br>cumque esse officiis quo eos doloremque debitis mollitia aliquam consequatur eaque?<br> Molestias, 
            delectus enim minima recusandae laboriosam libero ipsa?</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt">registrar agora</i></span>
    </div>
 </div>


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

    


<?php include_once('components/user_footer.php'); ?>

<!--sweetalert cdn link-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!--custom js file link-->
<?php include('components/alert.php'); ?>

<script type="text/javascript" src="js/user_script.js?v=<?php echo time(); ?>"></script>
</body>
</html>
