  <?php
     include_once('../componentes/conect.php');
     
       $admin_id = $_COOKIE['admin_id']?? '';
       if (empty($admin_id)){  
           header('location:login.php');
           exit;
          } 

        if (isset($_POST['add_service'])){
          $id = unique_id();

          $name = $_POST['name'];
          $name = filter_var($name, FILTER_SANITIZE_STRING);

          $price = $_POST['price'];
          $price = filter_var($price, FILTER_SANITIZE_STRING);

          $service_detail = $_POST['service_detail'];
          $service_detail = filter_var($service_detail, FILTER_SANITIZE_STRING);

          $image = $_FILES['image']['name'];
          $image = filter_var($image, FILTER_SANITIZE_STRING);
          $image_size = $_FILES['image']['size']; 
          $image_tmp_name = $_FILES['image']['tmp_name'];
          $image_folder = '../images/services/'.$image;
         
          $status = 'active';

          $select_image = $conn->prepare("SELECT * FROM `services` WHERE image = ?");
          $select_image->execute([$image]);

          if (isset($image)){ 
            if ($select_image->rowCount() > 0){
            $warning_msg[] = 'A imagem do serviço já existe!';
          }elseif ($image_size > 2000000) {
            $warning_msg[] = 'O tamanho da imagem é muito grande!';
          }else{
            move_uploaded_file($image_tmp_name, $image_folder);
          }
        }else{
            $image = '';
        }
           if($select_image->rowCount() > 0 AND $image != ''){
            $warning_msg[] = 'O nome da imagem do serviço já existe!';
        }else{
          $insert_service = $conn->prepare("INSERT INTO `services`(id, name, price, service_detail, image, status) VALUES(?,?,?,?,?,?)");
          $insert_service->execute([$id, $name, $price, $service_detail, $image, $status]);
          $success_msg[] = 'Novo serviço adicionado!';
        
      }
    }
    if (isset($_POST['draft'])){
          $id = unique_id();

          $name = $_POST['name'];
          $name = filter_var($name, FILTER_SANITIZE_STRING);

          $price = $_POST['price'];
          $price = filter_var($price, FILTER_SANITIZE_STRING);

          $service_detail = $_POST['service_detail'];
          $service_detail = filter_var($service_detail, FILTER_SANITIZE_STRING);

          $image = $_FILES['image']['name'];
          $image = filter_var($image, FILTER_SANITIZE_STRING);
          $image_size = $_FILES['image']['size']; 
          $image_tmp_name = $_FILES['image']['tmp_name'];
          $image_folder = '../images/services/'.$image;
         
          $status = 'deactive';

          $select_image = $conn->prepare("SELECT * FROM `services` WHERE image = ?");
          $select_image->execute([$image]);

          if (isset($image)){ 
            if ($select_image->rowCount() > 0){
            $warning_msg[] = 'A imagem do serviço já existe!';
          }elseif ($image_size > 2000000) {
            $warning_msg[] = 'O tamanho da imagem é muito grande!';
          }else{
            move_uploaded_file($image_tmp_name, $image_folder);
          }
        }else{
            $image = '';
        }
           if($select_image->rowCount() > 0 AND $image != ''){
            $warning_msg[] = 'O nome da imagem do serviço já existe!';
        }else{
          $insert_service = $conn->prepare("INSERT INTO `services`(id, name, price, service_detail, image, status) VALUES(?,?,?,?,?,?)");
          $insert_service->execute([$id, $name, $price, $service_detail, $image, $status]);
          $success_msg[] = 'Novo serviço adicionado!';
        
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


            <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
            <link rel="stylesheet" type="text/css" href="../css/admi_style.css?v=<?php echo time(); ?> ">  



        </head>
        <body style ="padding-left:0;">
        <div class= "main-container">
            <?php include_once('../admin/admin_header.php'); ?>
       <section class="dashboard">
        <div class="heading">
          <h1><img src="../images/separator.png" >Adicionar Serviço<img src="../images/separator.png"></h1>
        </div>
        <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data" class="register">
              <div class="input-field">
              <p>Nome do Serviço <span>*</span></p>
              <input type="text" name="name" required maxlength="100" placeholder="Digite o nome do serviço" class="box-input">
              </div>
              <div class="input-field">
              <p>Preço do Serviço <span>*</span></p>
              <input type="number" name="price" required placeholder="Digite o preço do serviço" class="box-input">
              </div>
              <div class="input-field">
              <p>Descrição do Serviço <span>*</span></p>
              <textarea name="service_detail" required placeholder="Digite a descrição do serviço" class="box-input" cols="30" rows="10"></textarea>
              </div>
              <div class="input-field">
              <p>Imagem do Serviço <span>*</span></p>
              <input type="file" name="image" required accept="image/*" class="box-input">
              </div>
              <div class="flex-btn">
                <button type="submit" name="add_service" class="btn">Adicionar Serviço</button>
                <button type="submit"  name= "draft" class="btn">Salvar como Rascunho</button>
              </div>
            </form>
       </section>
        </div>

             <!--sweetalert cdn link--> 

           <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
           <!--custom js file link-->
           
              <?php include('../componentes/alert.php'); ?>
        </body>
        <script type="text/javascript" src="../js/admin_script.js?v=<?php echo time(); ?>"></script>
     </html>
