 <header>
    <div class="logo">
        <img src="../images/logo.png" width="200">

    </div>
    <div class="right">
        <div class="bx bx-user" id="user-btn"></div>
        <div class="toggle-btn"> <i class = "bx bx-menu"></i></div>

    </div>
    <div class ="profile-detail">
        <?php
        $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
        $select_profile->execute([$admin_id]);
        if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        }
       ?>
       <div class= "profile">
        <img src="../uploaded_files/<?= $select_profile['image']; ?>">
        </div>
        
    </div>
    </header>