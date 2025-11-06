<?php
    include_once('../componentes/conect.php');
    
    $admin_id = $_COOKIE['admin_id'] ?? '';
    if (empty($admin_id)) {  
        header('location:login.php');
        exit;
    }
    if(isset($_POST['delete'])){
      $service_id = $_POST['service_id'];
      $service_id = filter_var($service_id, FILTER_SANITIZE_STRING);

      $delete_service = $conn->prepare ("DELETE FROM `services` WHERE id = ?");
      $delete_service->execute([$service_id]);

      $succes_msg[] = 'service delete successfully';
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
        <link rel="stylesheet" type="text/css" href="../css/admi_style.css?v=<?php echo time(); ?>">
    </head>
    <body style="padding-left:0;">
        <div class="main-container">
            <?php include_once('../admin/admin_header.php'); ?>
            <section class="show-container">
                <div class="heading">
                    <h1><img src="../images/separator.png">Nossos Serviços<img src="../images/separator.png"></h1>
                </div>
                <div class="box-container">
<?php 
    $select_services = $conn->prepare("SELECT * FROM `services`");
    $select_services->execute();

    if ($select_services->rowCount() > 0) {
        while ($fetch_services = $select_services->fetch(PDO::FETCH_ASSOC)) {
?>
                    <div class="box">
                        <form action="" method="post" class="box">
                            <input type="hidden" name="service_id" value="<?= htmlspecialchars($fetch_services['id']) ?>">
                            <?php if (!empty($fetch_services['image'])) { ?>
                                <img src="../uploaded_files/services/<?= htmlspecialchars($fetch_services['image']) ?>" class="image">
                            <?php } ?>
                            <div class="status" style="color: <?= ($fetch_services['status'] == 'active') ? 'limegreen' : 'red'; ?>;">
                                <?= htmlspecialchars($fetch_services['status']) ?>
                            </div>
                            <p class="price">$<?= htmlspecialchars($fetch_services['price']) ?>/-</p>
                            <div class="content">
                                <div class="title"><?= htmlspecialchars($fetch_services['name']) ?></div>
                                <div class="flex-btn">
                                <a href="edit_service.php?post_id=<?= $fetch_services['id']; ?>" class="btn">edit</a>
                                <button type ="submit" name="delete"  class="btn"   onclick="confirm('delete this service');">delete</button>
                                <a href  ="read_service.php?post_id=<?= $fetch_services['id']; ?>" class="btn">read</a>

                                </div>
                              </div>
                        </form>
                    </div>
                      <?php
                          }
                     }else{
                      echo '
                      <div class="empty">
                      <p> sem serviços ainda ! <br> <a href="add_service.php" class="btn"
                      style="margin-top: 1rem;">Adicionar serviço</a></p>
                      </div>
                      ';
                     }
                  ?>
                </div>
            </section>
        </div>
              <div class ="em">
        <!--sweetalert cdn link--> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <!--custom js file link-->
        <?php include('../componentes/alert.php'); ?>
        <script type="text/javascript" src="../js/admin_script.js?v=<?php echo time(); ?>"></script>
    </body>
</html>
