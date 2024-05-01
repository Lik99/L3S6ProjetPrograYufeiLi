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
		<a href="connexion1.php">Connecter</a> | <a href="inscrire1.php">Inscription</a>
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

      	    <h2><a href="avis2.php">Supprimer votre avis</a></h2>
			  <p class="post-info"><span>Nous nous félicitons de recevoir à nouveau votre avis !</span></p>
              <a id="returnLink" href="#">Retour à la page précédente</a>
                <script>
                document.getElementById('returnLink').addEventListener('click', function(event) {
                event.preventDefault();
                window.history.back();
                });
                </script>

              <div class="post-bottom-section">

                <div class="primary">

                    <form action="#" method="GET" id="commentform">

                        <ul>
						 <?php
                            if (isset($_GET['IdLivre'])) {
                                $IdLivre = $_GET['IdLivre'];
                            
                                
                                $conn = mysqli_connect("localhost", "root", "");// 连接数据库
                                mysqli_select_db($conn, "forum_db_yufei_sandra");
                            
                                // 删除评论
                                $req = "DELETE FROM Avis WHERE IdLivre = $IdLivre AND IdEtu = $IdEtu";
                                $res = mysqli_query($conn, $req);
                            
                                if ($res) {
                                    echo "Votre avis a été supprimé avec succès";
                                } else {
                                    echo "Erreur lors de la suppression de votre avis :" . mysqli_error($conn);
                                }
                            
                                // 关闭数据库连接
                                mysqli_close($conn);
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
