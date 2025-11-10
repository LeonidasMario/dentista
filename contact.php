<?php
include_once('components/conect.php');

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

    if(isset($_POST['send_msg'])){
        if ($user_id != ''){
            
            $id = unique_id();
            
            $name = $_POST['name'];
            $name =filter_var($name,FILTER_SANITIZE_STRING);

            $email = $_POST['email'];
            $email =filter_var($email,FILTER_SANITIZE_STRING);

            $subject = $_POST['subject'];
            $subject =filter_var($subject,FILTER_SANITIZE_STRING);

            $message = $_POST['message'];
            $message =filter_var($message,FILTER_SANITIZE_STRING);


            $verify_message = $conn->prepare("SELECT * FROM `message` WHERE user_id = ? AND  name = ? AND email = ? AND subject = ? AND message = ?");
            $verify_message->execute([$user_id, $name,$email,$subject,$message]);

            if($verify_message->rowCount() > 0){
                $warning_msg[]= 'mensagem já foi enviada';
            }else{
                $insert_message= $conn->prepare("INSERT INTO `message`(id,user_id,name,email,subject,message) VALUES(?,?,?,?,?,?)");
                $insert_message->execute([$id,$user_id,$name,$email,$subject,$message]);
                $success_msg[] ='mensagem enviada';
            }
        }else{
            $warning_msg[] ='Faça login primeiro';
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
        <h1>contate-nos</h1>
        <p>
Fale conosco para agendar consultas, tirar dúvidas ou enviar sugestões!<br>
Nossa equipe está à disposição para oferecer atendimento rápido e eficiente.<br>
Utilize o formulário abaixo, ligue ou envie mensagem pelas nossas redes sociais.<br>
Estamos sempre prontos para ouvir você e ajudar no que for preciso!
</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt">Sobre-nós</i></span>
    </div>
 </div>


        <div class="contact">
            <div class="heading">
                <h1>Contate a clínica</h1>
                <p>Para agendar uma consulta ou tirar dúvidas,
                envie uma mensagem pelo formulário abaixo.</p>
            </div>
                     <div class="box-container">
                        <div class="box">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="input-field">
                                <p>Seu nome <span>*</span></p>
                                <input type="text" name="name" placeholder="digite o seu nome" maxlength="50"
                                required class="box">
                            </div>
                             <div class="input-field">
                                <p>Seu email <span>*</span></p>
                                <input type="email" name="email" placeholder="digite o seu email" maxlength="50"
                                required class="box">
                            </div>
                            <div class="input-field">
                                <p>Assunto <span>*</span></p>
                                <input type="text" name="subject" placeholder="fale sobre o que te aflinge" maxlength="50"
                                required class="box">
                            </div>
                            <div class="input-field">
                                <p>mensagem <span>*</span></p>
                               <textarea name="message" class="box"></textarea>
                            </div>
                            <button type="submit" name="send_msg" class="btn">Envie uma menssagem</button>
                        </form>
                     </div>
                     <div class="box-image">
                        <img src="images/doctor.png">
                     </div>
                </div>
        </div>
        <div class="services">
            <div class="heading">
                <h1>Contate a clínica nos seguintes formatos</h1>
            </div>
            <div class="box-container">
                <div class="box">
                    <img src="images/contact-icon (3).png">
                    <div>
                        <h4>número  de emrgência</h4>
                        <p>192 (Ambulância)</p>
                         <p>193 (Bombeiros)</p>
                            <p>190 (Polícia)</p>
                    </div>
                </div>
                <div class="box">
                    <img src="images/contact-icon (1).png">
                    <div>
                        <h4>enderço</h4>
                      <p>Rua das Flores, 123 - Centro, São Paulo-SP</p>
                       <p>Av. Brasil, 456 - Jardim América, Rio de Janeiro-RJ</p>
                    </div>
                </div>
                <div class="box">
                    <img src="images/contact-icon (2).png">
                    <div>
                        <h4>email</h4>
                        <p>unisorriso@gmail.com</p>
                         <p>unisorriso@gmail.com</p> 
                    </div>
                </div>
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
