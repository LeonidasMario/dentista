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

 <div class="banner">
    <div class="detail">
        <h1>Sobre-nós</h1>
        <p>
        Somos uma clínica dedicada ao bem-estar e à saúde bucal dos nossos pacientes.<br>
        Nossa missão é oferecer atendimento humanizado, com profissionais qualificados e infraestrutura moderna.<br>
        Atuamos com responsabilidade, ética e inovação, buscando sorrisos mais saudáveis todos os dias.<br>
        Venha conhecer nossos serviços e fazer parte da família Uni-Sorriso!
</p>    
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt">Sobre-nós</i></span>
    </div>
 </div>
     
 <div class="about">
    <div class="box-container">
        <div class="box">
            <span>Mais sober a clínica</span>
            <h2>Especialista em cuidado bucal</h2>
        <p>Oferecemos atendimento personalizado para todas as idades, com profissionais qualificados, estrutura moderna e foco em prevenção, tratamento e bem-estar de nossos pacientes.</p>
        <p>Nossa missão é proporcionar experiências positivas em cada consulta, promovendo a confiança e o cuidado constante com a saúde bucal dos nossos pacientes.</p>
    </div>
    <div class="box">
        <img src="images/about.avif" >
    </div>
    </div>
 </div>
    <div class="event">
        <div class="heading">
            <h1><span> Dentes &  Controle de rotina</span> 
            </h1><p>inovção de ideias o odontologia</p>
        </div>
        <div class="box-container">
            <div class="box">
                <img src="images/about.png" alt="">
            </div>
            <div class="box">
                <h2>pesquisa atual sobre saúde bucal</h2>
                <p>Estudos recentes mostram que a saúde bucal está diretamente ligada ao bem-estar geral, <br>sendo essencial manter bons hábitos de higiene,
                 realizar visitas regulares ao dentista e adotar uma alimentação equilibrada para prevenir doenças.</p>
            </div>
        </div>
        <div class="box-container">
           
            <div class="box">
                <h2>hygine oral - circulo da lavagem de boca</h2>
                <p>Estudos recentes mostram que a saúde bucal está diretamente ligada ao bem-estar geral, <br>sendo essencial manter bons hábitos de higiene,
                 realizar visitas regulares ao dentista e adotar uma alimentação equilibrada para prevenir doenças.</p>
            </div>
             <div class="box">
                <img src="images/about0.png" alt="">
            </div>
        </div>
    </div>
     <div class="role">
        <div class="box-container">
            <div class="box">
                <h1>A roda dos implantes dentais</h1>
                <p>Os implantes dentários revolucionaram o tratamento odontológico,<br>
                 permitindo a reposição de dentes perdidos com eficiência, conforto e estética natural.<br>
                  São indicados para quem busca recuperar o sorriso e a funcionalidade da mastigação de forma segura e duradoura.</p>
                </div>
        <div class="box">
                <img src="images/about1.jpg" alt="">
            </div>
        </div>
            <div class="box-container">
                 <div class="box">
                <img src="images/about2.jpg" alt="">
            </div>
            <div class="box">
                <h1>implantes na clínica</h1>
                <p>Os implantes dentários revolucionaram o tratamento odontológico,<br>
                 permitindo a reposição de dentes perdidos com eficiência, conforto e estética natural.<br>
                  São indicados para quem busca recuperar o sorriso e a funcionalidade da mastigação de forma segura e duradoura.</p>
                </div>
        </div>
     </div>
     <div class="skill-container">
        <div class="heading">
            <span>Fora dos serviços dentais</span>
            <h1>em números</h1>
            <p>Mais de 3 bilhões de pessoas no mundo apresentam algum tipo de doença bucal. <br>
                O impacto da saúde bucal vai além do consultório, influenciando autoestima, 
                rendimento escolar e produtividade. Ações de prevenção podem reduzir em até 90% os casos de cáries e infecções bucais.</p>
        </div>
        <div class="container">
            <!--barra de progresso incio-->
            <div class="progress-bar">
                <div class="progress">
                    <span class="title timer" data-form="0" data-to="99" data-speed="1800">
                        <img src="images/counter (1).png"></span>
                        <div class="overlay"></div>
                        <div class="left"></div>
                        <div class="right"></div>
                </div>
                <h1>99%</h1>
                <h4>satisfação do cliente</h4>
            </div>
            <!--barra de progresso incio-->
            <div class="progress-bar">
                <div class="progress">
                    <span class="title timer" data-form="0" data-to="70" data-speed="1500">
                        <img src="images/icon (7).png"></span>
                        <div class="overlay"></div>
                        <div class="left"></div>
                        <div class="right"></div>
                </div>
                <h1>97%</h1>
                <h4>intervensão com sucesso</h4>
            </div>
            <!--barra de progresso incio-->
            <div class="progress-bar">
                <div class="progress">
                    <span class="title timer" data-form="0" data-to="100" data-speed="1500">
                        <img src="images/counter (3).png"></span>
                        <div class="overlay"></div>
                        <div class="left"></div>
                        <div class="right"></div>
                </div>
                <h1>100%</h1>
                <h4>Feliz com a equipe</h4>
            </div>
            <!--barra de progresso incio-->
            <div class="progress-bar">
                <div class="progress">
                    <span class="title timer" data-form="0" data-to="85" data-speed="1800">
                        <img src="images/counter (2).png"></span>
                        <div class="overlay"></div>
                        <div class="left"></div>
                        <div class="right"></div>
                </div>
                <h1>97%</h1>
                <h4>recuperação rápida</h4>
            </div>
            <!--barra de progresso incio-->
        </div>
     </div>


        <div class="testimonial-container">
            <div class="heading">
                <span>Clíentes com</span>
                <h1>Razão para sorrir</h1>
            </div>
            <div class="container">
                <div class="testimonial-item active">
                    <i class="bx bxs-quote-right" id ="quote"></i>
                    <img src="images/ima1.jpeg" >
                    <h1>john smith</h1>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Sequi quo expedita eveniet laborum officiis accusantium,
                     nesciunt consequatur eos vitae natus eum tempora possimus, 
                     fuga ea quidem veritatis, perferendis alias ducimus?
                </div>
                 <div class="testimonial-item ">
                    <i class="bx bxs-quote-right" id ="quote"></i>
                    <img src="images/ima2.jpeg" >
                    <h1>jAIJAVA PEE</h1>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Sequi quo expedita eveniet laborum officiis accusantium,
                     nesciunt consequatur eos vitae natus eum tempora possimus, 
                     fuga ea quidem veritatis, perferendis alias ducimus?
                </div>
                <div class="testimonial-item">
                    <i class="bx bxs-quote-right" id ="quote"></i>
                    <img src="images/ima3.avif" >
                    <h1>Selena Arsi</h1>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Sequi quo expedita eveniet laborum officiis accusantium,
                     nesciunt consequatur eos vitae natus eum tempora possimus, 
                     fuga ea quidem veritatis, perferendis alias ducimus?
                </div>
                <div class="testimonial-item">
                    <i class="bx bxs-quote-right" id ="quote"></i>
                    <img src="images/ima4.webp" >
                    <h1>Alweena Arsi</h1>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Sequi quo expedita eveniet laborum officiis accusantium,
                     nesciunt consequatur eos vitae natus eum tempora possimus, 
                     fuga ea quidem veritatis, perferendis alias ducimus?
                </div>
                <div class="left-arrow" onclick="leftSlide()"><i class="bx bx-left-arrow-alt"></i></div>
                <div class="right-arrow" onclick="rightSlide()"><i class="bx bx-right-arrow-alt"></i></div>

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
