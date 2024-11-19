<?php
session_start();
?>


<!DOCTYPE html>
<html lang="pt-br   ">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fonte do google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- fim da fonte -->
    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- fim icons-->
    <link rel="stylesheet" href="style.css">
    <title>MISTURA FINA FESTAS</title>
</head>

<body>
    <header>
        <div class="interface">
            <div class="logo">
                <a href="index.php">
                    <img src="imagens/logo.png" alt="" height="100" width="230">
                </a>
            </div>

            <nav class="menu-desktop">
                <ul>
                    <li><a href="#">Início </a></li>
                    <li><a href="view/brinquedos.php">Brinquedos </a></li>
                    <li><a href="view/sobre.php">Sobre </a></li>
                </ul>
            </nav>
            <?php
                    if(isset($_SESSION['nome'])){
                        echo "<div class='btn'>
                        <a href='view/login.php'>
                            <button>"."Bem vindo, ".$_SESSION['nome']."</button>
                        </a>
                    </div>";
                    }else{
                        echo "<div class='btn'>
                <a href='view/login.php'>
                    <button>Logar-se</button>
                </a>
            </div>"; 
                    }
                ?>
            
        </div>
    </header>
    <main>
        <section class="topo-do-site">
            <div class="interface">
                <div class="flex">
                    <div class="txt-topo-site">
                        <h1>
                            TODOS OS SEUS SONHOS DIVERTIDOS SE TORNAM REALIDADE COM NOSSOS BRINQUEDOS, CADA SORRISO É
                            UMA AVENTURA INESQUECÍVEL<span>!</span>
                        </h1>
                        <p></p>

                    </div>

                </div>
                <?php
                    if(isset($_SESSION['nome'])){
                        echo "<div>
                                <a href='view/brinquedos.php' style='font-size:25px'>
                                    <span>"."Agendar"."</span>
                                </a>
                              </div>";
                    }else{
                        echo "<div>
                        <a href='view/criaLogin.php' style='font-size:25px'>
                            <span>Registrar-se</span>
                        </a>
                      </div>"; 
                    }
                ?>
                <div class="img-inicial-site">
                    <img src="imagens/joaotouro.png" alt="eu">
                </div>
            </div>
        </section>
        <footer>
            <div class="interface">
                <div class="line-footer">
                    <div class="flex">
                    </div>
                </div>

                <div class="line-footer borda" />

                <div class="btn-btn">
                    <div class="btn-social">
                        <a href="https://www.instagram.com/joaosz_silva/">
                            <button>
                                <i class="bi bi-instagram"></i>
                            </button>
                        </a>
                        <a href="https://www.youtube.com/channel/UC8JcCOh-2ephQE_e4OaaH1Q"><button><i
                                    class="bi bi-facebook"></i></button></a>
                        <a href="https://www.linkedin.com/in/joaosyndrowski/"><button><i
                                    class="bi bi-whatsapp"></i></button></a>
                        <a href="https://twitter.com/jao_wick_"><button><i class="bi bi-envelope"></i></button></a>
                    </div>
                </div>
                <img src="imagens/logo.png" alt="logo" height="100" width="230">

            </div>
        </footer>