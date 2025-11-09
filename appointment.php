<?php
include_once('components/conect.php');

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}
 
        if(isset($_POST['agendamento'])){
            if($user_id != ''){
                $id =unique_id();

                $name = $_POST['first_name'].' '.$_POST['last_name'];
                $name = filter_var($name, FILTER_SANITIZE_STRING);

                 $email = $_POST['email'];
                 $email = filter_var($email, FILTER_SANITIZE_STRING);

                 $number = $_POST['number'];
                $number = filter_var($number, FILTER_SANITIZE_STRING);

                 $payment = $_POST['payment'];
                $payment = filter_var($payment, FILTER_SANITIZE_STRING);

                 $employee = $_POST['employee'];
                $employee = filter_var($employee, FILTER_SANITIZE_STRING);

                 $date = $_POST['date'];
                $date = filter_var($date, FILTER_SANITIZE_STRING);


                 $time = $_POST['time'];
                $time = filter_var($time, FILTER_SANITIZE_STRING);
               
                if(isset($_GET['get_id'])){
                    $get_service = $conn->prepare("SELECT * FROM     `services` WHERE id = ? LIMIT 1");
                    $get_service ->execute([$_GET['get_id']]);

         if($get_service->rowCount() > 0){
            while($fetch_s =  $get_service-> fetch(PDO::FETCH_ASSOC)){
                $insert_appointment = $conn->prepare("INSERT INTO `appointments` (id, user_id,
                name,number, email, service_id, employee_id,date, time,price,payment_status,status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
                $insert_appointment->execute([$id,$user_id,$name,$number,$email,$fetch_s['id'], $employee,$date,$time,$fetch_s['price'], $payment,'reservado']);



                $success_msg[]=' planilha de Agendamentos';
                header('location:book_appointment.php');
            }
        }
    }
 }else{
    $warning_msg[] = 'Primeiro faça login';
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
        <h1>Consultas odontológicas</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate natus quidem, <br>cumque esse officiis quo eos doloremque debitis mollitia aliquam consequatur eaque?<br> Molestias, 
            delectus enim minima recusandae laboriosam libero ipsa?</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt">Consultas odontológicas</i></span>
    </div>
 </div>

    <div class="summary">
        <h3>Consultas odontológicas</h3>
        <div class="container">
            <?php
            $grand_total=0;

            if(isset($_GET['get_id'])){
            $select_get= $conn->prepare("SELECT * FROM     `services` WHERE id = ?");
             $select_get ->execute([$_GET['get_id']]);

            while($fetch_get=  $select_get-> fetch(PDO::FETCH_ASSOC)){
                $sub_total = $fetch_get['price'];
                $grand_total += $sub_total;

         
            
            ?>
            <div class="flex">
                <img src="uploaded_files/services/<?= htmlspecialchars($fetch_get['image']); ?>" class="image">
                <div>
                    <h3 class="name"><?= htmlspecialchars($fetch_get['name']); ?></h3>
                    <p class="price">$<?= htmlspecialchars($fetch_get['price']); ?>/-</p>
                </div>
            </div>
           <?php 
              }
         }else {
    echo '<div class="empty"><p>sem serviços ainda!</p></div>';
}
           
           
           ?> 
           <div class="grand-total"><span>Total a ser pago : </span><p>$<?= $grand_total;?>/-</p></div>
        </div>
        <h3>Preencha tudo para fazer o agendamento</h3>
</div>


<div class="form-container appointment">
    <form action="" method="post" enctype="multipart/form-data" class="register"> <!-- Corrija enctype -->
        <div class="flex">
            <div class="col">
                <div class="input-field">
                    <p>Primeiro nome<span>*</span></p>
                    <input type="text" name="first_name" placeholder="Digite seu primeiro nome" class="box" required>
                </div>
                <div class="input-field">
                    <p>Segundo nome <span>*</span></p>
                    <input type="text" name="last_name" placeholder="Digite seu segundo nome" class="box" required>
                </div>
                <div class="input-field">
                    <p>Seu número<span>*</span></p>
                    <input type="text" name="number" placeholder="Digite seu numero" class="box" required>
                </div>
                <div class="input-field">
                    <p>email<span>*</span></p>
                    <input type="email" name="email" placeholder="Digite seu email" class="box" required>
                </div>
            </div>
            <div class="col">
                <div class="input-field">
                    <p>Método de pagamento<span>*</span></p>
                    <select name="payment" class="box select">
                        <option selected disabled>selecionar método de pagamento</option>
                        <option value="paytm">paytm</option>
                        <option value="credit card">cartão de crédito</option>
                        <option value="phone pay">telefone pay</option>
                        <option value="G-pay">G-pay</option>
                    </select>
                </div>
                <div class="input-field">
                    <p>selecionar funcionário<span>*</span></p>
                    <select name="employee" class="box select">
                        <?php
                        $select_employee= $conn->prepare("SELECT * FROM `employee` WHERE status = ?");
                        $select_employee ->execute(['active']);
                        if ($select_employee->rowCount() > 0){
                            while($fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?= htmlspecialchars($fetch_employee['id']); ?>"><?= htmlspecialchars($fetch_employee['name']); ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="input-field">
                    <p>selecionar data<span>*</span></p>
                    <input type="date" name="date" placeholder="selecionar data" class="box" required>
                </div>
                <div class="input-field">
                    <p>selecionar tempo<span>*</span></p>
                    <select name="time" class="box select">
                        <option selected disabled>selecionar tempo</option>
                        <option value="9:00 AM - 10:00 AM">9:30 AM - 10:30 AM</option>
                        <option value="11:30 AM - 12:30 PM">11:30 AM - 12:30 PM</option>
                        <option value="12:00 AM - 1:00 PM">12:00 AM - 1:00 PM</option>
                        <option value="1:30 PM - 2:30 PM">1:30 PM - 2:30 PM</option>
                        <option value="3:00 PM - 4:30 PM">3:00 PM - 4:30 PM</option>
                        <option value="3:30 PM - 4:30 PM">3:30 PM - 4:30 PM</option>
                        <option value="5:00 PM - 6:00 PM">5:00 PM - 6:00 PM</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" name="agendamento" class="btn">agendamento</button>
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
