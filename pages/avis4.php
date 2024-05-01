<?php 
	session_start() ;
    $IdEtu = $_SESSION['IdEtu'];
    $nomEtu = $_SESSION['nomEtu'];
    $IdLivre = $_SESSION['$IdLivre'];
  

?>


<!DOCTYPE html>
<!--[if IE 7 ]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8 oldie"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html> <!--<![endif]-->

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Avis</title>

    <link rel="stylesheet" type="text/css" media="screen" href="CoolBlue11/css/coolblue.css" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.6.1.min.js"><\/script>')</script>

    <script src="js/scrollToTop.js"></script>

</head>

<body id="top">

<!--header -->
<div id="header-wrap"><header>

 	<hgroup>
		<h1><a href="index.php">Bienvenue!</a></h1>
        <h3>Sélectionnez votre livre</h3>
    </hgroup>

    <nav>
		<ul>
			<li><a href="index.php">Home</a><span></span></li>
			<li><a href="type1.php">Type</a><span></span></li>
			<li><a href="auteur1.php">Auteur</a><span></span></li>
			<li id="current"><a href="avis1.php">Avis</a><span></span></li>
		</ul>
	</nav>

    <div class="subscribe">
	<a href="connexion1.php">Connecter</a> | <a href="inscrire1.php">S'inscrire</a> | <a href="deconnexion.php">Quitter</a>
    </div>


<!--/header-->
</header></div>
	
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main">

            <div class="main-content">

      	    <h2><a href="avis2.php">Partagez votre avis</a></h2>
			  <p class="post-info"><span>Quand on aime, on partage</span></p>
              <a id="returnLink" href="#">Retour à la page précédente</a>
                <script>
                document.getElementById('returnLink').addEventListener('click', function(event) {
                event.preventDefault();
                window.history.back();
                });
                </script>

              <div class="post-bottom-section">


                <h4>Dites-nous ce que vous en pensez</h4>

                <div class="primary">

                    <form action="#" method="GET" id="commentform">

                        <ul>
						 <?php

                        if (isset($_GET['IdLivre'])) {
                            $IdLivre = $_GET['IdLivre'];
                            $conn = mysqli_connect("localhost", "root", "");
                            mysqli_select_db($conn, "forum_db_yufei_sandra");
    
                            // 查询用户已借阅的书籍
                            $req = "SELECT Avis.*, Etudiant.nomEtu, Etudiant.prenomEtu
                                    FROM Avis, Etudiant
                                    WHERE Avis.IdLivre = $IdLivre AND Avis.IdEtu = Etudiant.IdEtu ;";
                            $res = mysqli_query($conn, $req);
                            $row = mysqli_fetch_array($res);

                            echo '</br>ID du livre: ' . $IdLivre .'';

                            $reqLivre = "SELECT * FROM Livre WHERE IdLivre = $IdLivre;";
                            $resLivre = mysqli_query($conn, $reqLivre);

                            if ($rowLivre = mysqli_fetch_array($resLivre)) {
                                echo '</br>Titre du livre: ' . $rowLivre['titreLivre'] . '';
                                echo '</br>La note: ' . $row['noteAvis'] .'';
                                echo '</br>Qui a laissé le commentaire: ' . $row['prenomEtu']." ".$row['nomEtu'] .'';
                                //echo $row['imageAvis'];
                                echo '</br>Images commentées: <img src="' . $row['imageAvis'] . '" alt="Avis Image" width="300" height="300">';
                                echo '</br>Commentaires: ' . $row['commentaireAvis'] .'';
                            }
                            
                        } else {
                            echo "Erreur dans methode GET";
                        }
                   		 ?>
                        </ul>
                                                          
                </form>

                </div>

         </div>

			
					

					
          

        <!-- /main -->
        </div>

    <!-- content -->
	</div>

<!-- /content-out -->
</div>
		
</body>
</html>
