<?php
include_once('../componentes/conect.php');

$admin_id = $_COOKIE['admin_id'] ?? '';
if (empty($admin_id)) {  
    header('location:login.php');
    exit;
}

// Recebe o parâmetro pelo GET
$get_id = $_GET['post_id'] ?? '';

// ATUALIZAR FUNCIONÁRIO
if (isset($_POST['update'])) {
    $employee_id = $_POST['employee_id'];
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $profession = filter_var($_POST['profession'], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

    // Atualiza dados do funcionário
    $update_employee = $conn->prepare("UPDATE `employee` SET name = ?, email = ?, profession = ?, number = ?, profile_dec = ?, status = ? WHERE id = ?");
    $update_employee->execute([$name, $email, $profession, $number, $content, $status, $employee_id]);
    $success_msg[] = 'employee updated successfully';

    // Atualiza imagem do funcionário
    $old_image = $_POST['old_image'] ?? '';
    $image = $_FILES['image']['name'] ?? '';
    $image_size = $_FILES['image']['size'] ?? 0;
    $image_tmp_name = $_FILES['image']['tmp_name'] ?? '';
    $image_folder = '../images/services/' . $image;

    if (!empty($image)) {
        $select_image = $conn->prepare("SELECT * FROM `employee` WHERE profile = ?");
        $select_image->execute([$image]);

        if ($image_size > 2000000) {
            $warning_msg[] = 'image size is too large';
        } elseif ($select_image->rowCount() > 0 && $image != '') {
            $warning_msg[] = 'please rename your image';
        } else {
            $update_image = $conn->prepare("UPDATE `employee` SET profile = ? WHERE id = ?");
            $update_image->execute([$image, $employee_id]);
            move_uploaded_file($image_tmp_name, $image_folder);

            if ($old_image != $image && !empty($old_image)) {
                $old_path = '../images/services/' . $old_image;
                if (file_exists($old_path)) {
                    unlink($old_path);
                }
            }
            $success_msg[] = 'image updated';
        }
    }
}

// DELETAR FUNCIONÁRIO
if (isset($_POST['delete'])) {
    $employee_id = $_POST['employee_id'];
    $delete_image = $conn->prepare("SELECT * FROM `employee` WHERE id = ?");
    $delete_image->execute([$employee_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

    if (!empty($fetch_delete_image['profile'])) {
        $img_path = '../images/services/' . $fetch_delete_image['profile'];
        if (file_exists($img_path)) {
            unlink($img_path);
        }
    }

    $delete_employee = $conn->prepare("DELETE FROM `employee` WHERE id = ?");
    $delete_employee->execute([$employee_id]);

    header('location:view_employee.php');
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
                <h1><img src="../images/separator.png">Editar Funcionário<img src="../images/separator.png"></h1>
            </div>
            <div class="box-container">
                <?php
                $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE id = ?");
                $select_employee->execute([$get_id]);

                if ($select_employee->rowCount() > 0) {
                    while ($fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="form-container">
                    <form action="" method="post" enctype="multipart/form-data" class="register">
                        <input type="hidden" name="old_image" value="<?= htmlspecialchars($fetch_employee['profile']); ?>">
                        <input type="hidden" name="employee_id" value="<?= htmlspecialchars($fetch_employee['id']); ?>">

                        <div class="input-field">
                            <p>Estado <span>*</span></p>
                            <select name="status" class="box">
                                <option selected value="<?= htmlspecialchars($fetch_employee['status']); ?>"><?= htmlspecialchars($fetch_employee['status']); ?></option>
                                <option value="active">active</option>
                                <option value="deactive">deactive</option>
                            </select>
                        </div>
                        <div class="flex">
                            <div class="col">
                                <div class="input-field">
                                    <p>Nome <span>*</span></p>
                                    <input type ="text" name ="name" value="<?= htmlspecialchars($fetch_employee['name']); ?>" class="box-input" required>
                                </div>
                                <div class="input-field">
                                    <p>Email <span>*</span></p>
                                    <input type ="email" name ="email" value="<?= htmlspecialchars($fetch_employee['email']); ?>" class="box-input" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-field">
                                    <p>Profissão <span>*</span></p>
                                    <input type ="text" name ="profession" value="<?= htmlspecialchars($fetch_employee['profession']); ?>" class="box-input" required>
                                </div>
                                <div class="input-field">
                                    <p>Número <span>*</span></p>
                                    <input type ="number" name ="number" value="<?= htmlspecialchars($fetch_employee['number']); ?>" class="box-input" required>
                                </div>
                            </div>
                        </div>
                        <div class ="input-field">
                            <p>Descrição de perfil<span>*</span></p>
                            <textarea name="content" class="box-input"><?= htmlspecialchars($fetch_employee['profile_dec']); ?></textarea>
                        </div>
                        <div class="input-field">
                            <p>Imagem do funcionário <span>*</span></p>
                           <input type="file" name="image" accept="image/*" class="box-input">
                           <?php if (!empty($fetch_employee['profile'])) { ?>
                             <img src="../images/services/<?= htmlspecialchars($fetch_employee['profile']); ?>" 
                                class="image" 
                                style="width:250px; height:250px; object-fit:cover; border-radius:8px; display:block; margin-left:auto; margin-right:auto;">
                            <?php } ?>
                        </div>
                        <div class="flex-btn">
                            <button type="submit" name="update" class="btn">Atualizar funcionário</button>
                            <button type="submit" name="delete" class="btn" onclick="return confirm('Deseja deletar este funcionário?');">Deletar</button>
                            <a href="view_employee.php" class="btn">Voltar</a>
                        </div>
                    </form>
                </div>
                <?php
                    }
                } else {
                    echo '
                    <div class="empty">
                        <p>Sem funcionários ainda!<br>
                        <a href="add_employee.php" class="btn" style="margin-top: 1rem;">Adicionar funcionário</a></p>
                    </div>';
                }
                ?>
            </div>
        </section>
    </div>
    <div class="em">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <?php include('../componentes/alert.php'); ?>
        <script type="text/javascript" src="../js/admin_script.js?v=<?php echo time(); ?>"></script>
    </div>
</body>
</html>
