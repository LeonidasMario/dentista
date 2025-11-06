 <?php
     include_once('../componentes/conect.php');
     if (isset($_POST['login'])){

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        $pass = sha1($_POST['password']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE email = ? AND password = ? LIMIT 1");
        $select_admin->execute([$email, $pass]);
        $row = $select_admin->fetch(PDO::FETCH_ASSOC);

        if ($select_admin->rowCount() > 0) {
            setcookie('admin_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:dashboard.php');
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


            <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
                

            <link rel="stylesheet" type="text/css" href="../css/admi_style.css?v=<?php echo time(); ?> ">  



        </head>
        <body  class="form-bg" style ="padding-left:0;">
            <!--register section starts -->
                <div class ="form-container ">
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
                </div>

             <!--register section ends -->
             <!--sweetalert cdn link--> 

           <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
           <!--custom js file link-->
           <script type="text/javascript" src="../js/admin_script.js"></script>
              <?php include('../componentes/alert.php'); ?>
        </body>
     </html>
