
<?php
include_once('../componentes/conect.php');

$admin_id = $_COOKIE['admin_id'] ?? '';
if (empty($admin_id)) {  
    header('location:login.php');
    exit;
}
$get_id = $_GET['post_id'] ?? '';

// ATUALIZAR SERVIÇO
if (isset($_POST['update'])) {
    $service_id = $_POST['service_id'];
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

    $update_service = $conn->prepare("UPDATE `services` SET name = ?, price = ?, service_detail = ?, status = ? WHERE id = ?");
    $update_service->execute([$name, $price, $content, $status, $service_id]);
    $success_msg[] = 'service updated successfully';

    $old_image = $_POST['old_image'] ?? '';
    $image = $_FILES['image']['name'] ?? '';
    $image_size = $_FILES['image']['size'] ?? 0;
    $image_tmp_name = $_FILES['image']['tmp_name'] ?? '';
    $image_folder = '../uploaded_files/services/' . $image; // CORRIGIDO

    if (!empty($image)) {
        $select_image = $conn->prepare("SELECT * FROM `services` WHERE image = ?");
        $select_image->execute([$image]);

        if ($image_size > 2000000) {
            $warning_msg[] = 'image size is too large';
        } elseif ($select_image->rowCount() > 0 && $image != '') {
            $warning_msg[] = 'please rename your image';
        } else {
            $update_image = $conn->prepare("UPDATE `services` SET image = ? WHERE id = ?");
            $update_image->execute([$image, $service_id]);
            move_uploaded_file($image_tmp_name, $image_folder);

            if ($old_image != $image && !empty($old_image)) {
                $old_path = '../uploaded_files/services/' . $old_image;
                if (file_exists($old_path)) {
                    unlink($old_path);
                }
            }
            $success_msg[] = 'image updated';
        }
    }
}

// DELETAR SERVIÇO
if (isset($_POST['delete'])) {
    $service_id = $_POST['service_id'];
    $delete_image = $conn->prepare("SELECT * FROM `services` WHERE id = ?");
    $delete_image->execute([$service_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

    if (!empty($fetch_delete_image['image'])) {
        $img_path = '../uploaded_files/services/' . $fetch_delete_image['image'];
        if (file_exists($img_path)) {
            unlink($img_path);
        }
    }

    $delete_service = $conn->prepare("DELETE FROM `services` WHERE id = ?");
    $delete_service->execute([$service_id]);

    header('location:view_services.php');
    exit;
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
        <section class="post-editor">
            <div class="heading">
                <h1><img src="../images/separator.png">Editar Serviço<img src="../images/separator.png"></h1>
            </div>
            <div class="box-container">
                <?php
                $select_service = $conn->prepare("SELECT * FROM `services` WHERE id = ?");
                $select_service->execute([$get_id]);

                if ($select_service->rowCount() > 0) {
                    while ($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="form-container">
                    <form action="" method="post" enctype="multipart/form-data" class="register">
                        <input type="hidden" name="old_image" value="<?= htmlspecialchars($fetch_service['image']); ?>">
                        <input type="hidden" name="service_id" value="<?= htmlspecialchars($fetch_service['id']); ?>">

                        <div class="input-field">
                            <p>Estado de serviço <span>*</span></p>
                            <select name="status" class="box">
                                <option selected value="<?= htmlspecialchars($fetch_service['status']); ?>"><?= htmlspecialchars($fetch_service['status']); ?></option>
                                <option value="ative">ative</option>
                                <option value="deative">deative</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <p>Nome do serviço <span>*</span></p>
                            <input type="text" name="name" value="<?= htmlspecialchars($fetch_service['name']); ?>" class="box-input">
                        </div>
                        <div class="input-field">
                            <p>Preço do serviço <span>*</span></p>
                            <input type="number" name="price" value="<?= htmlspecialchars($fetch_service['price']); ?>" class="box-input">
                        </div>
                        <div class="input-field">
                            <p>Descrição do serviço <span>*</span></p>
                            <textarea name="content" class="box-input"><?= htmlspecialchars($fetch_service['service_detail']); ?></textarea>
                        </div>
                        <div class="input-field">
                            <p>Imagem do serviço <span>*</span></p>
                            <input type="file" name="image" accept="image/*" class="box-input">
                            <?php if (!empty($fetch_service['image'])) { ?>
                                <img src="../uploaded_files/services/<?= htmlspecialchars($fetch_service['image']); ?>" class="image">
                            <?php } ?>
                        </div>
                        <div class="flex-btn">
                            <button type ="submit" name ="update" class ="btn">update service</button>   
                            <button type="submit" name="delete" class="btn" onclick="return confirm('Deseja deletar este serviço?');">Deletar</button>
                            <a href="view_services.php" class="btn">Voltar</a>
                        </div>
                    </form>
                </div>
                <?php
                    }
                } else {
                    echo '
                    <div class="empty">
                        <p>Sem serviços ainda!<br>
                        <a href="add_service.php" class="btn" style="margin-top: 1rem;">Adicionar serviço</a></p>
                    </div>';
                }
                ?>
            </div>
        </section>
    </div>
    <div class="em">
        <!--sweetalert cdn link--> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <!--custom js file link-->
        <?php include('../componentes/alert.php'); ?>
        <script type="text/javascript" src="../js/admin_script.js?v=<?php echo time(); ?>"></script>
    </div>
</body>
</html>
