<?php
include_once('components/conect.php');

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
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
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate natus quidem, <br>cumque esse officiis quo eos doloremque debitis mollitia aliquam consequatur eaque?<br> Molestias, 
            delectus enim minima recusandae laboriosam libero ipsa?</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt">Sobre-nós</i></span>
    </div>
 </div>

    <div class="employee-container">
        <div class="heading">
                <h1>Contate a clínica</h1>
                <p>Para agendar uma consulta ou tirar dúvidas,
                envie uma mensagem pelo formulário abaixo.</p>
            </div>
            <div class="employee-box-container">
                <?php
                $select_employee = $conn->prepare("SELECT * FROM `employee`WHERE status = ?");
                 $select_employee->execute(['active']);


                 if( $select_employee->rowCount() > 0){
                    while( $fetch_employee =  $select_employee->fetch(PDO::FETCH_ASSOC)){

                  
                
                ?>
                <form action="" method ="post" class="employee-box">
                    <img src="uploaded_files/services/<?= $fetch_employee['profile']; ?>" class="employee-image">
                    <div class="content">
                        <div><h3><?= $fetch_employee['name']; ?></h3></div>
                    <p>profession : <span><?= $fetch_employee['profession']; ?></span></p>
                    <input type="hidden" name="employee_id" value="<?= $fetch_employee['id']; ?>">
                    <div class="flex-btn">
                        <a href="employee_detail.php?get_id=<?= $fetch_employee['id']; ?>" class="btn"> view profile detail</a>
                    </div>
                    </div>
                </form>
                <?php
                     }
                } else {
                  echo '<div class="empty"><p>sem funcionários ainda!</p></div>';
                }
            ?>
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
