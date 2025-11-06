<?php
    include_once('../componentes/conect.php');
    
    $admin_id = $_COOKIE['admin_id'] ?? '';
    if (empty($admin_id)) {  
        header('location:login.php');
        exit;
    }
   

    $get_id = $_GET['post_id'];

    if(isset($_POST['post_id'])){
        $service_id = $_POST['service_id'];
        $service_id = filter_var($service_id, FILTER_SANITIZE_STRING);

        $delete_image = $conn->prepare("SELET * FROM `services` WHERE id = ?");
         $delete_image->execute([$service_id]);
         $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

          if (!empty($fetch_delete_image['image'])) {
            unlink('../uploaded_files/services/'.$fetch_delete_image['image']);
        }
         $delete_service = $conn->prepare("DELETE FROM `services` WHERE id = ?");
         $delete_service -> execute([$service_id]);

         header('location:view_services.php');
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
            <section class="read-container">
                <div class="heading">
                    <h1><img src="../images/separator.png">Detalhes de Serviço<img src="../images/separator.png"></h1>
                </div>
                <div class="box-container">
                    <?php
                        $select_service  = $conn->prepare("SELECT * FROM `services` WHERE id = ?");
                        $select_service->execute([$get_id]);

                        if($select_service->rowCount() > 0){
                            while($fetch_services = $select_service->fetch(PDO::FETCH_ASSOC)){

                    ?>
                    <form action ="" method="post" class="box">
                        <input type ="hidden" name ="service_id" value="<?= $fetch_services['id']; ?>">
                        <div class="status" style="color: <?= ($fetch_services['status'] == 'active') ? 'limegreen' : 'red'; ?>;">
                    <?= htmlspecialchars($fetch_services['status']) ?>
                            </div>
                            <?php if (!empty($fetch_services['image'])) { ?>
                                <img src="../uploaded_files/services/<?= htmlspecialchars($fetch_services['image']) ?>" class="image">
                            <?php } ?>
                            <p class="price">$<?= htmlspecialchars($fetch_services['price']) ?>/-</p>
                            <div class ="name"><?= htmlspecialchars($fetch_services['name']) ?></div>
                            <div class ="content"><?= htmlspecialchars($fetch_services['service_detail']) ?></div>
                            <div class="flex-btn">
                             <a href="edit_service.php?id=<?= $fetch_services['id']; ?>" class="btn">editar</a>
                            <button type="submit" name="delete" class="btn" onclick="return confirm('delete this service');">deletar</button>
                            <a href="/dentista/admin/view_services.php" class="btn">Voltar</a>
                            </div>
                    </form>
                    <?php
                            }
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
