<header>
  <div class="logoo">
    <img src="../images/beng.png" width="150">
  </div>
  <div class="right">
    <div class="bx bxs-user" id="user-btn"></div>
    <div class="toggle-btn"><i class="bx bx-menu"></i></div>
  </div>
  <div class="profile-detail">
    <?php
    // Garante que $conn e $admin_id vieram do dashboard.php
    if (!empty($admin_id)) {
        $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
        $select_admin->execute([$admin_id]);
        if ($select_admin->rowCount() > 0) {
            $fetch_profile = $select_admin->fetch(PDO::FETCH_ASSOC);
            echo '<div class="profile">';
            echo '<img src="../uploaded_files/perfil.png" width="150" alt="Foto de perfil" class="logo-img">';
            echo '</div>';
        } else {
            echo '<p>Admin não encontrado!</p>';
        }
    } else {
        echo '<p>ID do admin está vazio!</p>';
    }
    ?>
    <div class="flex-btn">
      <a href="profile.php" class="btn">Ver Perfil</a>
      <a href="../componentes/admin_logout.php" class="btn" onclick="return confirm('Sair do sistema?');">Sair</a>
    </div>
  </div>
</header>

<div class="side-container">
  <div class="sidebar">
    <?php
    // Garante que $conn e $admin_id vieram do dashboard.php
    if (!empty($admin_id)) {
        $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
        $select_admin->execute([$admin_id]);
        if ($select_admin->rowCount() > 0) {
            $fetch_profile = $select_admin->fetch(PDO::FETCH_ASSOC);
            echo '<div class="profile">';
            echo '<img src="../uploaded_files/perfil.png" width="150" alt="Foto de perfil" class="logo-img">';
            echo '<p class="admin-name" style="margin-top:1rem;">' . htmlspecialchars($fetch_profile['name']) . '</p>';
            echo '</div>';
        } else {
            echo '<p>Admin não encontrado!</p>';
        }
    } else {
        echo '<p>ID do admin está vazio!</p>';
    }
    ?>
    <h5>Menu</h5>
    <ul>
      <li><a href="dashboard.php"><i class="bx bx-right-arrow-alt"></i>Dashboard</a></li>
      <li><a href="add_service.php"><i class="bx bx-right-arrow-alt"></i>Adicionar Serviço</a></li>
      <li><a href="view_services.php"><i class="bx bx-right-arrow-alt"></i>Ver Serviços</a></li>
      <li><a href="add_employee.php"><i class="bx bx-right-arrow-alt"></i>Adicionar Funcionários</a></li>
      <li><a href="view_employee.php"><i class="bx bx-right-arrow-alt"></i>Ver Funcionários</a></li>
      <li><a href="admin_message.php"><i class="bx bx-right-arrow-alt"></i>Mensagens dos usuários</a></li>
       <li><a href="user_account.php"><i class="bx bx-right-arrow-alt"></i>Usuários</a></li>
      <li><a href="admin_logout.php" onclick="return confirm('Sair do sistema?');"><i class="bx bx-right-arrow-alt"></i>Sair</a></li>
    </ul>
  </div>
</div>
