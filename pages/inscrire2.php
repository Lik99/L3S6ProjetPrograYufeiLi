<?php 
	session_start() ;
    $_SESSION['IdEtu'];
	$_SESSION['nomEtu'];
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

    <title>page inscrire</title>

    <link rel="stylesheet" type="text/css" media="screen" href="CoolBlue11/css/coolblue.css" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.6.1.min.js"><\/script>')</script>

    <script src="js/scrollToTop.js"></script>

</head>

<body id="top">

<!--header -->
<div id="header-wrap"><header>

 	<hgroup>
    </hgroup>
		

    <nav>
	</nav>

<!--/header-->
</header></div>
	
<!-- content-wrap -->
<div id="content-wrap">
    <!-- content -->
    <div id="content" class="clearfix">
   	    <!-- main -->
        <div id="main">

      	    <article class="post">

      		    <div class="primary">

                    <h2>Validation de l'inscription</h2>
                    <p class="post-info"><span>C'est presque fini, attendez un peu...</span></p>

                    <?php
                        if (isset($_SESSION['IdEtu']) AND $_SESSION['IdEtu'] != "") {
                            die('Vous êtes déjà connecté !! <a href="index.php">Retour à l\'accueil</a>');
                            
                        }
                    ?>

               	    <div>
                       <?php
                            // vérification que tous les champs sont remplis
                            if (empty($_POST["IdEtu"]) && empty($_POST["pass1"]) && empty($_POST["pass2"]) && empty($_POST["nomEtu"]) && empty($_POST["prenomEtu"])) {
                                echo "1";
                                die("Vous devez remplir TOUS les champs !");
                            } else {
                                // tous les champs sont remplis, je récupère les données
                                $IdEtu = $_POST["IdEtu"];
                                $pass1 = $_POST["pass1"];
                                $pass2 = $_POST["pass2"];
                                $nomEtu = $_POST["nomEtu"];
                                $prenomEtu = $_POST["prenomEtu"];

                                // test de la cohérence des mots de passe
                                if ($pass1 != $pass2) {
                                    die("Les deux mots de passe doivent être identiques !");
                                } else {
                                    // tout va bien
                                    
                                    // Vérification du transfert
                                    if ($_FILES['nom_du_fichier']['error']) {
                                        die("Erreur lors du transfert de l'image !");
                                    }
                                    
                                    // Transfert de l'image dans le répertoire avatars
                                    if (isset($_FILES['nom_du_fichier']['name']) && ($_FILES['nom_du_fichier']['error'] == UPLOAD_ERR_OK)) {
                                        $chemin_destination = 'avatars/';
                                        move_uploaded_file($_FILES['nom_du_fichier']['tmp_name'], $chemin_destination.$_FILES['nom_du_fichier']['name']);
                                    }
                                        
                                    //Connexion à la base
                                    $connexion=mysqli_connect("localhost", "root", "") ;
                                    mysqli_select_db($connexion,"forum_db_yufei_sandra");
                                    
                                    // Création de la requête
                                    // ATTENTION ! les chaînes de caractères (le pseudo, le mot de passe et le mail) doivent être entourées de  " " 
                                    // car c'est du texte, sinon l'ajout ne se fera pas du côté de la base de données (Possibilité de jouer sur les ' et ")
                                    $req= 'INSERT INTO Etudiant (IdEtu, nomEtu, prenomEtu, passEtu, Avatar) VALUES ("'.$IdEtu.'", "'.$nomEtu.'", "'.$prenomEtu.'","'.$pass1.'", "'.$_FILES['nom_du_fichier']['name'].'");';
                                    //echo $req; //à décommenter pour avoir l'affichage de la requête pour vérifier la syntaxe SQL dans PHPMyAdmin
                                    //Envoi de la requête 
                                    mysqli_query($connexion, $req); 
                                    // ici pas de stockage dans $res car il s'agit d'une requête insertion qui n'a pas de résultats a proprement parler      
                                    //Fermeture de la connexion
                                    mysqli_close($connexion) ;
                                    //Affichage d'un message de confirmation et d'un lien de retour à l'accueil
                                    echo 'Vous avez bien été enregistré.e avec le ID '.$IdEtu.' avec le nom '.$nomEtu.'.';
                                    
                                }
                            }
                        ?>
                        <a href="index.php">Retour à la page d'accueil</a>
         	        </div>
                </div>
		    </article>           
        <!-- /main -->
        </div>
    <!-- content -->
	</div>
<!-- /content-out -->
</div>
</body>
</html>
