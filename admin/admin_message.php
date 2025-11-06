  <?php
     include_once('../componentes/conect.php');
     
       $admin_id = $_COOKIE['admin_id']?? '';
       if (empty($admin_id)){  
           header('location:login.php');
           exit;
          } 
          if(isset($_POST['delete'])){
            $delete_id=$_POST['delete_id'];
            $delete_id =filter_var($delete_id, FILTER_SANITIZE_STRING);

            $verify_delete= $conn->prepare("SELECT * FROM `message` WHERE id = ?");
            $verify_delete->execute([$delete_id]);

            if($verify_delete-> rowCount() > 0){
                $delete_msg = $conn->prepare("DELETE FROM `message` WHERE id =?");
                $delete_msg->execute([$delete_id]);

                $success_msg[]='mensagem deletada!';
            }else{
                $warning_msg[] ='message já foi deletada!';
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
        <body class="dashboard-bg" style ="padding-left:0;">

        <div class= "main-container">
            <?php include_once('../admin/admin_header.php'); ?>
       <section class="message-container">
        <div class="heading">
          <h1><img src="../images/separator.png" >Mensagens do usuário<img src="../images/separator.png"></h1>
        </div>
           <div class="box-container">
            <?php 
            $select_msg = $conn->prepare("SELECT * FROM `message`");
            $select_msg->execute();

            if($select_msg->rowCount() > 0){
                while($fetch_msg = $select_msg->fetch(PDO::FETCH_ASSOC)){


                    ?>
                    <div class="box">
                        <h3 class="name"><?= $fetch_msg['name'];?></h3>
                        <h4><?= $fetch_msg['subject'];?></h4>
                        <p><?= $fetch_msg['message'];?></p>
                        <form action="" method="post">
                            <input type ="hidden" name="delete_id" value="<?= $fetch_msg['id'];?>">
                            <button type="submit" name="delete" class="btn" onclick="return confirm('delete this message');">deletar</button>

                        </form>
                    </div>
                    <?php
                }
            }else {
                    echo '
                    <div class="empty">
                        <p>Sem mensagens ainda!</p>
                    </div>';
                }
            ?>
           </div>
       </section>
        </div>

             <!--sweetalert cdn link--> 

           <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
           <!--custom js file link-->
           
              <?php include('../componentes/alert.php'); ?>
        </body>
        <script type="text/javascript" src="../js/admin_script.js?v=<?php echo time(); ?>"></script>
     </html>
