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

                    <h2>Validation de la connexion</h2>
                    <p class="post-info"><span>C'est presque fini, attendez un peu...</span></p>

               	    <div>
                       <?php
                            if (!empty($_POST["IdEtu"]) and !empty($_POST["passEtu"])) {
                                $IdEtu = $_POST["IdEtu"];
                                $passEtu = $_POST["passEtu"];
                                
                                    //Connexion à la base
                                    $connexion=mysqli_connect("localhost", "root", "") ;
                                    mysqli_select_db($connexion,"forum_db_yufei_sandra");
                                    
                                    // Création de la requête
                                    $req= 'SELECT IdEtu, passEtu, nomEtu FROM Etudiant WHERE IdEtu="'.$IdEtu.'" AND passEtu ="'.$passEtu.'";';
                                    //echo $req; //à décommenter pour avoir l'affichage de la requête pour vérifier la syntaxe SQL dans PHPMyAdmin
                                    
                                    // Envoi de la requête et récupération du résultat dans $res
                                    $res=mysqli_query($connexion, $req); 
                                    
                                    // Comptage du nombre de résultats et test
                                    if (mysqli_num_rows($res)==1){  // attention pour test : ==1, le égal seul sert pour les affectations et non pour les comparaisons
                                        // Tout va bien, l'utilisateur existe et le bon mot de passe correspondant a été fourni
                                        echo 'Vous êtes bien connecté.e';
                                        $_SESSION['IdEtu'] = $IdEtu;
                                        $enreg_Etudiant=mysqli_fetch_array($res); // Récupération des indormations
                                        $_SESSION['nomEtu'] = $enreg_Etudiant['nomEtu'];
                                        $_SESSION['passEtu'] = $enreg_Etudiant['passEtu']; // Ajout de l'identifiant à la session

                                        echo"<br/>";
                                        echo"<br/>";
                                        echo 'Votre nom:  '.$_SESSION['nomEtu'];
                                        echo"<br/>";
                                        echo 'Votre id:  '.$_SESSION['IdEtu']."<br/>";
                                        echo"<br/>";
                                    }
                                    else {
                                        // Y'a une erreur
                                        echo '<br/><br/>Id Etutiant ou mot de passe incorrect!!!';
                                    }
                                                        
                                    // Fermeture de la connexion
                                    mysqli_close($connexion) ;
                                        
                                
                                
                            }
                            else {
                                die("Vous devez indiquer un nom d'utilisateur et un mot de passe !");
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
