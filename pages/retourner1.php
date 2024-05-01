<?php 
	session_start() ;
    
    $titreLivre = $_GET['titreLivre']; // 通过链接获取书籍标题
    $IdAuteur = $_GET['IdAuteur']; // 通过链接获取作者ID
    $IdLivre = $_GET['IdLivre']; // 通过链接获取书籍ID     
 
    // 存储到SESSION中
	$_SESSION['titreLivre'] = $titreLivre;
	$_SESSION['IdAuteur'] = $IdAuteur;
	$_SESSION['IdLivre'] = $IdLivre;
	$_SESSION['dateEmprunt'] = $dateEmprunt;
	$_SESSION['dateRetour'] = $dateRetour;
    $IdEtu = $_SESSION['IdEtu'];
    $nomEtu = $_SESSION['nomEtu'];
	//echo' SESSION: '.' -1:'.$_SESSION['titreLivre'].' -2:'.$_SESSION['IdAuteur'].' -3:'.$_SESSION['IdLivre'].' -4:'.$_SESSION['dateEmprunt'].' -5:'.$_SESSION['dateRetour'];
    
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conn, "forum_db_yufei_sandra");
    $updateQuery = "UPDATE Emprunter SET retourne = true WHERE IdEtu = $IdEtu AND IdLivre = $IdLivre AND retourne = false";
    mysqli_query($conn, $updateQuery);
    mysqli_close($conn);
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

    <title>bibliothèque</title>

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
			<li id="current"><a href="auteur1.php">Auteur</a><span></span></li>
			<li><a href="avis1.php">Avis</a><span></span></li>
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

      	    <article class="post">

      		    <div class="primary">

                  <h3><p>Vous avez retourné le livre avec succès !</br></br><span style="color: red;"><?php echo $titreLivre; ?></span></p></h3>

                        <!-- 这里显示成功借阅的书籍信息和归还日期 -->
                        <?php
                            $conn = mysqli_connect("localhost", "root", "");
                            mysqli_select_db($conn, "forum_db_yufei_sandra");

                            $req = "SELECT * FROM Livre WHERE IdLivre = $IdLivre;";
                            $res = mysqli_query($conn, $req);

                            if ($row = mysqli_fetch_array($res)) {
                                echo '<p>Titre du livre: ' . $row['titreLivre'] . '</p>';
                                echo '<p>Date de publication: ' . $row['anneePubli'] . '</p>';
                                echo '<p>ID du livre: ' . $IdLivre . '</p>';
                            }

                            $reqAuteur = "SELECT * FROM Auteur WHERE IdAuteur = $IdAuteur;";
                            //echo $reqAuteur;
                            $resAuteur = mysqli_query($conn, $reqAuteur);

                            if ($rowAuteur = mysqli_fetch_array($resAuteur)) {
                                echo '<p>Auteur: ' . $rowAuteur['nomAuteur'] . ' ' . $rowAuteur['prenomAuteur'] . '</p>';
                            }

                            if (isset($_SESSION['IdEtu']) && isset($_SESSION['nomEtu'])) {
                                echo '<p>Emprunteur: ' . $_SESSION['nomEtu'] . '</p>';
                            }

                            mysqli_close($conn);
                            ?>		

                            <a id="returnLink" href="#">Retour à la page précédente</a>

                            <script>
                            document.getElementById('returnLink').addEventListener('click', function(event) {
                            event.preventDefault();
                            window.history.back();
                            });
                            </script>
                </div>

                <aside>
            	    <p class="dateinfo"><?php echo date('M')?><span><?php echo date('d')?></span></p>

               	    <div class="post-meta">
                  	    <h4>Info Personnelles</h4>
                     	<ul>
						 <?php
							if (isset($_SESSION['IdEtu']) && isset($_SESSION['nomEtu'])) {
								echo '<li class="user"><a href="#">'.$_SESSION['nomEtu'].'</a></li>';
								echo'<li class="permalink"><a href="#">'.$_SESSION['IdEtu'].'</a></li>';
							} else{
								echo" Vous n'êtes pas connecté";
							}
                   		 ?>
                           <!-- <li class="user"><a href="#">Inkown</a></li>
                           <li class="permalink"><a href="#">Inkown</a></li> -->
                        </ul>
					</div>
                </aside>
		    </article>           
        <!-- /main -->
        </div>
        

        
    <!-- content -->
	</div>
<!-- /content-out -->
</div>

</body>
</html>
