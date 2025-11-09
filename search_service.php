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
        <h1>Pesquisar serviços</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt">Pesquisar serviços</i></span>
    </div>
</div>

<div class="show-container">
    <div class="heading">
        <h1>resultados de pesquisa </h1>
    </div>

   

    <div class="box-container">
        <?php
        // Só realiza pesquisa se botão ou campo foi enviado
        if (isset($_POST['search_service']) || isset($_POST['search_service_btn'])) {
            $search_service = $_POST['search_service'];
            $select_services = $conn->prepare("SELECT * FROM `services` WHERE name LIKE ? AND status = ?");
            $select_services->execute(['%' . $search_service . '%', 'active']);

            if ($select_services->rowCount() > 0) {
                while ($fetch_services = $select_services->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <form action="" method="post" class="box">
                        <img src="uploaded_files/services/<?= htmlspecialchars($fetch_services['image']); ?>" class="image">
                        <p class="price">R$ <?= htmlspecialchars($fetch_services['price']); ?></p>
                        <div class="content">
                            <div class="button">
                                <div><h3><?= htmlspecialchars($fetch_services['name']); ?></h3></div>
                                <div>
                                    <a href="view_page.php?pid=<?= $fetch_services['id']; ?>" class="bx bxs-show"></a>
                                </div>
                            </div>
                            <input type="hidden" name="service_id" value="<?= $fetch_services['id']; ?>">
                            <div class="flex-btn">
                                <a href="appointment.php?get_id=<?= $fetch_services['id']; ?>" class="btn">Consultas</a>
                            </div>
                        </div>
                    </form>
                    <?php
                }
            } else {
                echo '<div class="empty"><p>sem serviços ainda!</p></div>';
            }
        } else {
            echo '<div class="empty"><p>sem serviços ainda!</p></div>';
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