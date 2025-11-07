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

<!-- home slide aqui-->
<div class="slider-container">
    <div class="slide">

        <!-- Slide 1 -->
        <div class="slideBox active">
            <div class="textBox">
                <span>Comprometidos com a excelência</span>
                <h1>personalizados e <br> confortáveis</h1>
                <div class="card">
                    <div class="box">
                        <div><img src="images/icon (11).png" alt=""></div>
                        <div>
                            <h2>Projeção completa</h2>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing.</p>
                        </div>
                    </div>
                    <div class="box">
                        <div><img src="images/icon (12).png" alt=""></div>
                        <div>
                            <h2>Completa serviço completo</h2>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                </div>
                <div class="flex-btn">
                    <a href="service.php" class="btn">ver serviço</a>
                    <a href="service.php" class="btn">livro de depoimentos</a>
                </div>
            </div>
        </div>
        <!-- Fim Slide 1 -->

        <!-- Slide 2 -->
        <div class="slideBox">
            <div class="textBox">
                <span>Comprometidos com a excelência</span>
                <h1>personalizados e <br> comfortáveis</h1>
                <div class="card">
                    <div class="box">
                        <div><img src="images/icon (4).png" alt=""></div>
                        <div>
                            <h2>Projeção completa</h2>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisi</p>
                        </div>
                    </div>
                    <div class="box">
                        <div><img src="images/icon (5).png" alt=""></div>
                        <div>
                            <h2>Completa serviço completo</h2>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. </p>
                        </div>
                    </div>
                </div>
                <div class="flex-btn">
                    <a href="service.php" class="btn">ver serviço</a>
                    <a href="service.php" class="btn">livro de depoimentos</a>
                </div>
            </div>
        </div>
        <!-- Fim Slide 2 -->

        <!-- Slide 3 -->
        <div class="slideBox">
            <div class="textBox">
                <span>Comprometidos com a excelência</span>
                <h1>personalizados e <br> comfortáveis</h1>
                <div class="card">
                    <div class="box">
                        <div><img src="images/icon (1).png" alt=""></div>
                        <div>
                            <h2>Projeção completa</h2>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                    <div class="box">
                        <div><img src="images/icon (2).png" alt=""></div>
                        <div>
                            <h2>Completa serviço completo</h2>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. .</p>
                        </div>
                    </div>
                </div>
                <div class="flex-btn">
                    <a href="service.php" class="btn">ver serviço</a>
                    <a href="service.php" class="btn">livro de depoimentos</a>
                </div>
            </div>
        </div>
        <!-- Fim Slide 3 -->

    </div>

    <!-- CONTROLES DAS SETAS NO FINAL DO CONTAINER -->
    <ul class="controls">
        <li onclick="nextSlide();" class="next"><i class="bx bx-right-arrow-alt"></i></li>
        <li onclick="prevSlide();" class="prev"><i class="bx bx-left-arrow-alt"></i></li>
    </ul>
</div>
<!-- home slide aqui-->
 <div class="about-us">
    <div class="box-container">
        <div class="box">
            <div class="container">
                <div class="card">
                    <img src="images/ab-icon.png">
                    <h2>facíl acesso</h2>
                    <p>Consiga uma avalição em poucos clicks</p>
                </div>
                <div class="card">
                    <img src="images/ab-icon0.png">
                    <h2>facíl acesso</h2>
                    <p>Consiga uma avalição em poucos clicks</p>
                </div>
                <div class="card">
                    <img src="images/ab-icon1.png">
                    <h2>facíl acesso</h2>
                    <p>Consiga uma avalição em poucos clicks</p>
                </div>
                <div class="card">
                    <img src="images/ab-icon2.png">
                    <h2>facíl acesso</h2>
                    <p>Consiga uma avalição em poucos clicks</p>
                </div>
            </div>
        </div>
        <div class="box">
            <h1>Sobre nossa clínica</h1>
           <p>A Uni-Sorriso é especializada em odontologia moderna, dedicada a proporcionar experiências personalizadas e diagnósticos precisos. Nossa equipe de doutores oferece proteção completa e serviço de excelência, colocando o bem-estar do paciente em primeiro lugar.</p>
            <div class="box-card">
                <div class="detail">
                    <img src="images/about-us.jpg" >
                    <h2>Dr. Richard Smith</h2>
                    <span>Head Doctor, Orthodontist</span>
                     <p>Eu sou um Dr. dedicado a como especialista de 20 de experiência treinado em diagnóstico
                    completo para identificar necessidades e proporcionar tratamentos eficazes.
                     </p>
                </div>
            </div>
        </div>
    </div>
 </div>

 <div class="relax-container">
    <div class="detail">
        <h1>Relaxa... o seu dentista  sabe sempre</h1>
        <div class="box">
            <div class="img-box">
                <img src="images/icon (8).png" alt="">
            </div>
            <div>
                <h2>Nunca esqueça da sua higiene </h2>
                 <p>Garantimos rigorosa higiene e cuidados constantes para segurança e conforto de todos os pacientes durante cada atendimento.</p>
            </div>
        </div>
        <div class="box">
            <div class="img-box">
                <img src="images/icon (9).png" alt="">
            </div>
            <div>
                <h2> Não esqueça de da sua higiene </h2>
                 <p>Duas mãos limpas ajudam a proteger sua saúde e de quem você ama.</p>
            </div>
        </div>
        <div class="box">
            <div class="img-box">
                <img src="images/icon (10).png" alt="">
            </div>
            <div>
                <h2> visite  seu dentista em in 6 meses</h2>
                 <p>Garantimos rigorosa higiene e cuidados constantes para segurança e conforto de todos os pacientes durante cada atendimento.</p>
            </div>
        </div>
        <div class="box">
            <div class="img-box">
                <img src="images/icon (8).png" alt="">
            </div>
            <div>
                <h2>Nunca esqueça da sua higiene </h2>
                 <p>Garantimos rigorosa higiene e cuidados constantes para segurança e conforto de todos os pacientes durante cada atendimento.</p>
            </div>
        </div>
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
