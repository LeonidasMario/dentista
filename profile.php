<?php
include_once('components/conect.php');

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('location:login.php');
}
$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
$select_profile->execute([$user_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
              
$select_appointment = $conn->prepare("SELECT * FROM `appointments` WHERE user_id = ?");
$select_appointment->execute([$user_id]);
$total_appointment = $select_appointment ->rowCount();

$select_msg = $conn->prepare("SELECT * FROM `message` WHERE user_id = ?");
$select_msg->execute([$user_id]);
$total_msg = $select_msg ->rowCount();

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
        <h1>Meu Perfil</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate natus quidem, <br>cumque esse officiis quo eos doloremque debitis mollitia aliquam consequatur eaque?<br> Molestias, 
            delectus enim minima recusandae laboriosam libero ipsa?</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt">Meu Perfil</i></span>
    </div>
 </div>

 <div class="profile">
    <div class="heading">
        <h1><img src="images/separator.png" >Detalhes de perfil<img src="images/separator.png" ></h1>
    </div>
    <div class="details">
        <div class="user">
           <?php
            $profile_image = !empty($fetch_profile['image']) && file_exists('uploaded_files/' . $fetch_profile['image'])
             ? $fetch_profile['image']
             : 'default-user.png';
?>
<img src="uploaded_files/<?= htmlspecialchars($profile_image); ?>">
          <h3><?= htmlspecialchars($fetch_profile['name']); ?></h3>
            <p>user</p>
            <a href="update.php" class="btn">atualiza perfil</a>
        </div>
        <div class="box-container">
            <div class="box">
                <div class="flex">
                    <i class="bx bxs-food-menu"></i>
                    <h3><?= $total_appointment ?></h3>
                </div>
                <a href="book_appointment.php" class="btn">ver agendamento</a>
            </div>
             <div class="box">
                <div class="flex">
                    <i class="bx bxs-chat"></i>
                    <h3><?= $total_msg ?></h3>
                </div>
                 <a href="book_appointment.php" class="btn">enviar mensagem</a>
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
