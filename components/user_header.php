<header class="header">
    <section class="flex">
        <a href="home.php" class="logo"><img src="images/beng.png" width="150"></a>
        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="service.php">serviços</a>
            <a href="contact.php">agendar</a>
            <a href="book_appointment.php">agendamentos</a>
             <a href="team.php">Profissionais</a>
            <a href="about.php">sobre</a>
        </nav>
        <form action="search_service.php" method="post" class="search-form">
            <input type="text" name="search_service" placeholder="search_service..." required maxlength="100">
            <button type="submit" class="bx bx-search-alt-2" name="search_service_btn"></button>
        </form>
        <div class="icons">
            <div id="menu-btn" class="bx bx-menu"></div>
            <div id="search-btn" class="bx bx-search-alt-2"></div>
            <div id="user-btn" class="bx bxs-user"></div>
        </div>
        <div class="profile" style="background-image: none;">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);

            if ($select_profile->rowCount() > 0) {
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
                <img src="uploaded_files/<?= htmlspecialchars($fetch_profile['image']); ?>">
                <h3 style="margin-bottom: 1rem;"><?= htmlspecialchars($fetch_profile['name']); ?></h3>
                <div class="flex-btn">
                    <a href="profile.php" class="btn">Ver perfil</a>
                    <a href="components/user_logout.php" onclick="return confirm('Sair do site');" class="btn">Sair</a>
                </div>
            <?php
            } else {
            ?>
                <img src="images/man.png">
                <h3 style="margin-bottom: 1rem;">Faça login ou se registre</h3>
                <div class="flex-btn">
                    <a href="login.php" class="btn">Ver perfil</a>
                    <a href="register.php" class="btn">Registrar</a>
                </div>
            <?php } ?>
        </div>
    </section>
</header>
