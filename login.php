<?php
include_once('components/conect.php');

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

   if (isset($_POST['login'])){

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        $pass = sha1($_POST['password']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $select_users = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
        $select_users->execute([$email, $pass]);
        $row = $select_users->fetch(PDO::FETCH_ASSOC);

        if ($select_users->rowCount() > 0) {
            setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:home.php');
        } else {
            $warning_msg[] = 'Email ou senha incorretos!';
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
        <h1>login agora</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate natus quidem, <br>cumque esse officiis quo eos doloremque debitis mollitia aliquam consequatur eaque?<br> Molestias, 
            delectus enim minima recusandae laboriosam libero ipsa?</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt">login agora</i></span>
    </div>
 </div>


       <div class="form-container">
          <form action ="" method="post" enctype="multipart/form-data" class="login">
                        <h3>Login</h3>
                        <div class = "input-field">
                                <p>Seu email <span>*</span></p>
                                <input type="email" name="email" required placeholder="Digite seu email" maxlength="50" class="box-input">
                            </div>
                            <div class="input-field">
                                <p>Sua senha <span>*</span></p>
                                <input type="password" name="password" required placeholder="Digite sua senha" maxlength="50" class="box-input">
                            </div>

                        <p>Não tem uma conta? <a href="register.php">Registrar agora</a></p>
                        <button type="submit" name="login" class="btn">Entrar agora</button>
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
