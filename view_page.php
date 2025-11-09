<?php
include_once('components/conect.php');

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

   

$pid = $_GET['pid'];


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
        <h1>service details</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate natus quidem, <br>cumque esse officiis quo eos doloremque debitis mollitia aliquam consequatur eaque?<br> Molestias, 
            delectus enim minima recusandae laboriosam libero ipsa?</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt">service details</i></span>
    </div>
 </div>

    <div class="view-container">
       
       <?php
       if(isset($_GET['pid'])){
        $pid = $_GET['pid'];
        $select_service = $conn->prepare("SELECT * FROM     `services` WHERE id = '$pid'");
         $select_service ->execute();

         if($select_service->rowCount() > 0){
            while($fetch_service =  $select_service-> fetch(PDO::FETCH_ASSOC)){
          
          ?> 
          <form action="" method="post" class="box">
            <div class="img-box">
                <div class="heading">
                    <h1><img src="images/separator.png">service details <img src="images/separator.png"></h1>
                </div>
                <img src="uploaded_files/services/<?= $fetch_service['image']; ?>" >
            </div>
            <div class="detail">
                <p class="price">$<?= $fetch_service['price']; ?>/-</p>
                <div class="name"><?= $fetch_service['name']; ?></div>
                <p class="service-detail"><?= $fetch_service['service_detail']; ?></p>
                <input type="hidden" name="service_id" value="<?= $fetch_service['id']; ?>">
                <div class="flex-btn">
                    <a href="appointment.php?get_id=<?= $fetch_service['id']; ?>" class="btn" style="width: 100%;">agende agora</a>
                </div>
            </div>
          </form>
           <?php        
            }
         }

       } else {
    echo '<div class="empty"><p>sem serviços ainda!</p></div>';
}
       ?>       
</div>

<?php include_once('components/user_footer.php'); ?>

<!--sweetalert cdn link-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!--custom js file link-->
<?php include('components/alert.php'); ?>

<script type="text/javascript" src="js/user_script.js?v=<?php echo time(); ?>"></script>
</body>
</html>
