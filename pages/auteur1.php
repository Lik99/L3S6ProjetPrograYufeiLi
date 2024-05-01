<?php 
	session_start() ;

	// $titreLivre = $_SESSION['titreLivre'];
	// $IdAuteur = $_SESSION['IdAuteur'];
	// $IdLivre = $_SESSION['IdLivre'];
	// $dateEmprunt = $_SESSION['dateEmprunt'];
	// $dateRetour = $_SESSION['dateRetour'];
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

    <title>Auteur</title>

    <link rel="stylesheet" type="text/css" media="screen" href="CoolBlue11/css/coolblue.css" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.6.1.min.js"><\/script>')</script>

    <script src="js/scrollToTop.js"></script>

</head>

<body Id="top">

<!--header -->
<div Id="header-wrap"><header>

 	<hgroup>
	 	<h1><a href="index.php">Bienvenue!</a></h1>
        <h3>Sélectionnez votre livre</h3>
    </hgroup>

    <nav>
	    <ul>
			<li><a href="index.php">Home</a><span></span></li>
			<li><a href="type1.php">Type</a><span></span></li>
			<li Id="current"><a href="auteur1.php">Auteur</a><span></span></li>
			<li><a href="avis1.php">Avis</a><span></span></li>
		</ul>
	</nav>

    <div class="subscribe">
	<a href="connexion1.php">Connecter</a> | <a href="inscrire1.php">S'inscrire</a> | <a href="deconnexion.php">Quitter</a>
    </div>

   <form Id="quick-search" method="get" action="auteur_recherche.php">
      <fieldset class="search">
         <label for="qsearch">Search:</label>
         <input class="tbox" Id="qsearch" type="text" name="qsearch" value="Recherche par nom d'auteur..." title="Start typing and hit ENTER" />
         <button class="btn" title="Submit Search">Search</button>
      </fieldset>
   </form>
   <script>
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.getElementById('qsearch');
        input.addEventListener('focus', function() {
            if (this.value === "Recherche par nom d'auteur...") {
                this.value = "";
            }
        });
    });
   </script>

<!--/header-->
</header></div>
	
<!-- content-wrap -->
<div Id="content-wrap">

    <!-- content -->
    <div Id="content" class="clearfix">

   	    <!-- main -->
        <div Id="main">

            <!-- post -->
      	    <article class="post single">

                <!-- primary -->
         	    <div class="primary">

            	    <h2><a href="auteur1.php">Les auteurs en vue</a></h2>

                    <p class="post-info"><span>Sur le devant de la scène</span></p>

					<form action="auteur2.php" method="GET">
					 <?php
					 if (isset($_SESSION['IdEtu']) && isset($_SESSION['nomEtu'])) {			

						// 连接数据库
						$conn = mysqli_connect("localhost", "root", "");
						mysqli_select_db($conn, "forum_db_yufei_sandra");

						// 查询作者表
						$req = "SELECT IdAuteur, nomAuteur, prenomAuteur FROM Auteur;";
						$res = mysqli_query($conn, $req);

						// 显示作者信息
						while ($row = mysqli_fetch_array($res)) {
							echo '<div class="image-section">';
							echo '<p><a href="auteur2.php?IdAuteur=' . $row['IdAuteur'] . '">' . $row['nomAuteur'] . ' ' . $row['prenomAuteur'] . '</a></p>';
							echo '</div>';
						}

						// 关闭数据库连接
						mysqli_close($conn);
				     } else{
						echo "Veuillez vous connecter pour voir les auteurs.";
					 }
					?>
					</form>

					 

                <!-- /primary -->
                </div>
				
				<aside>
            	    <p class="dateinfo"><?php echo date('M')?><span><?php echo date('d')?></span></p>

               	    <div class="post-meta">
                  	    <h4>Info Personnelles</h4>
                     	<ul>
						 <?php
							if (isset($_SESSION['IdEtu']) && isset($_SESSION['nomEtu'])) {
								echo '<li class="user"><a href="#">Votre nom: '.$_SESSION['nomEtu'].'</a></li>';
								echo'<li class="permalink"><a href="#">Votre ID: '.$_SESSION['IdEtu'].'</a></li>';
							} else{
								echo" Vous n'êtes pas connecté ";
							}
                   		 ?>
                        </ul>
					</div>
                </aside>

        <!-- /post -->
        </div>

        <!-- sidebar -->
		<div Id="sidebar">
			<div class="sidemenu">

				<h3>Notre sélection</h3>

                <ul>
					<?php
					if (isset($_SESSION['IdEtu']) && isset($_SESSION['nomEtu'])) {	
					// 连接数据库
					$conn = mysqli_connect("localhost", "root", "");
					mysqli_select_db($conn, "forum_db_yufei_sandra");

					// 随机查询五个作者
					$req = "SELECT IdAuteur, nomAuteur, prenomAuteur FROM Auteur ORDER BY RAND() LIMIT 5;";
					$res = mysqli_query($conn, $req);
					// 显示随机的五个作者信息
					while ($row = mysqli_fetch_array($res)) {
					
						echo '<li><a href="auteur2.php?IdAuteur=' . $row['IdAuteur'] . '">' . $row['nomAuteur'] . ' ' . $row['prenomAuteur'] . '</a>';
						
						// 查询作者写的一本随机书籍
						$req1 = "SELECT IdAuteur, titrelivre FROM Livre WHERE IdAuteur =" . $row['IdAuteur'] . " ORDER BY RAND() LIMIT 1;";
						$res1 = mysqli_query($conn, $req1);
				
						// 如果有相关书籍，则显示第一本书的信息
						if ($res1 && $row1 = mysqli_fetch_array($res1)) {
							echo '<br/><span>' . $row1['titrelivre'] . '</span>';
						} else {
							echo '<br/><span>Aucun livre pour l\'instant...</span>';
						}
				
						echo '</li>';
					}

					// 关闭数据库连接
					mysqli_close($conn);
					} else{
						echo "Veuillez vous connecter pour voir notre sélection.";
					}
					?>
				</ul>

			</div>

			<div class="sidemenu">

			<h3>Mes emprunts</h3>
				<ul>
                    <?php
                    if (isset($_SESSION['IdEtu'])&&isset($_SESSION['nomEtu'])){
                        // 连接数据库
						$conn = mysqli_connect("localhost", "root", "");
						mysqli_select_db($conn, "forum_db_yufei_sandra");

						// 查询用户已借阅的书籍
						$req = "SELECT Livre.titreLivre, Livre.anneePubli, Livre.IdLivre, Livre.IdAuteur
								FROM Livre
								INNER JOIN Emprunter ON Livre.IdLivre = Emprunter.IdLivre
								WHERE Emprunter.IdEtu = $IdEtu AND Emprunter.retourne = false;";
						$res = mysqli_query($conn, $req);

						// 显示用户借阅的书籍
						if (mysqli_num_rows($res) > 0) {
							while ($row = mysqli_fetch_array($res)) {
								echo '<li>' . $row['titreLivre'] . ' (' . $row['anneePubli'] . ')';
                                echo '</br><a href="retourner1.php?IdLivre=' . $row['IdLivre'] . '&titreLivre=' . $row['titreLivre'] . '&IdAuteur=' . $row['IdAuteur'] . '">Retour</a></li>';
							}
						} else {
							echo "Vous n'avez pas emprunté de livres.";
						}

						// 关闭数据库连接
						mysqli_close($conn);
					} else {
						echo "Veuillez vous connecter pour voir vos emprunts.";
                    }
                    ?>
				</ul>
			</div>
        <!-- /sidebar -->
		</div>

    <!-- content -->
	</div>

<!-- /content-out -->
</div>
		
</body>
</html>
