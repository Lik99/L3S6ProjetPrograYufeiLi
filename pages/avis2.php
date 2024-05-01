<?php 
	session_start() ;
    $IdEtu = $_SESSION['IdEtu'];
    $nomEtu = $_SESSION['nomEtu'];
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

   
   <script>
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.getElementById('qsearch');
        input.addEventListener('focus', function() {
            if (this.value === "Recherche par livre...") {
                this.value = "";
            }
        });
    });
   </script>

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

                    <form action="avis3.php" method="post" id="commentform" enctype="multipart/form-data">

                        <ul>
						 <?php
                         // IdEtu
							if (isset($_SESSION['IdEtu']) && isset($_SESSION['nomEtu'])) {
								echo '<div><label for="name">Votre nom:</br>' .$nomEtu. '<span></span></label></div>';
			  					echo'<div><label for="id">Votre ID:</br>'.$IdEtu. '<span></span></label></div>';
                                
                                // 连接数据库
                                $conn = mysqli_connect("localhost", "root", "");
                                mysqli_select_db($conn, "forum_db_yufei_sandra");
                                
                                // req pour afficher tous les livres empruntés par l'utilisateur
                                $req = "SELECT Livre.titreLivre, Livre.anneePubli, Livre.IdLivre, Livre.IdAuteur
                                        FROM Livre
                                        INNER JOIN Emprunter ON Livre.IdLivre = Emprunter.IdLivre
                                        WHERE Emprunter.IdEtu = $IdEtu AND Emprunter.retourne = false;";
                                $res = mysqli_query($conn, $req);
                                
                                // Afficher tous les livres empruntés par l'utilisateur et en sélectionner un
                                if (mysqli_num_rows($res) > 0) {

                                    // list deroulant pour les livres pas encore doonée en avis
                                    echo '<div>
                                    <label for="titreLivre">Sélectionner un livre </br>(Afficher uniquement ceux que vous n\'avez pas commentés.)</label>
                                    <select id="titreLivre" name="titreLivre" tabindex="2">';
                                    
                                     // 查询已评价的书籍
                                    $livreDejaAvis = [];
                                    $livre_checkQuery = "SELECT IdLivre FROM Avis WHERE IdEtu = $IdEtu";
                                    $livre_checkResult = mysqli_query($conn, $livre_checkQuery);
 
                                    if(mysqli_num_rows($livre_checkResult) > 0) {
                                        while ($row = mysqli_fetch_assoc($livre_checkResult)) {
                                            $livreDejaAvis[] = $row['IdLivre'];
                                        }
                                    }

                                    // Interroger les titres de livres dans l'ensemble de résultats et les afficher sous forme d'options déroulantes.
                                    while ($row = mysqli_fetch_array($res)) {
                                        $titreLivre = $row['titreLivre'];
                                        $IdLivre = $row['IdLivre'];
                                        // 检查书籍是否已评价，若已评价则跳过
                                        if (!in_array($row['IdLivre'], $livreDejaAvis)) {
                                            echo '<option value="' . $titreLivre . '">' . $IdLivre.": ".$titreLivre . '</option>';
                                        }
                                    }
                                    echo '</select>
                                        </div>';
                                } else {
                                    echo "<div><label>Vous n'avez pas emprunté de livres.</label></div>";
                                }
                                mysqli_close($conn);
                                // noteAvis
                                echo '<div>
                                  <label for="Note">Note sur 10</label>
                                  <input id="Note" name="noteAvis" type="text" tabindex="3" />
                                </div>';
                                //commentaireAvis
                                echo '<div>
                                    <label for="message">Votre commentaire <span></span></label>
                                    <textarea id="message" name="commentaireAvis" rows="10" cols="18" tabindex="4"></textarea>
                                </div>';
                                // imageAvis
                                echo '<input type="hidden" name="MAX_FILE_SIZE" value=100000>';
                                echo '<div>
                                    <label for="commentImage">Image de commentaire</label>
                                    <input type="file" id="commentImage" name="imageAvis" accept="image/*" tabindex="6">
                                </div>';
                                echo '<div class="no-border">
                                    <input class="button" type="submit" value="Envoyer" tabindex="5" />
                                </div>';
							} else{
								echo" Vous n'êtes pas connecté ";
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
