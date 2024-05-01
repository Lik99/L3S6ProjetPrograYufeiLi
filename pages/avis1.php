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

   <!-- <form id="quick-search" method="GET
   " action="index.html">
      <fieldset class="search">
         <label for="qsearch">Search:</label>
         <input class="tbox" id="qsearch" type="text" name="qsearch" value="Recherche par titre de livre..." title="Start typing and hit ENTER" />
         <button class="btn" title="Submit Search">Search</button>
      </fieldset>
   </form>
   <script>
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.getElementById('qsearch');
        input.addEventListener('focus', function() {
            if (this.value === "Recherche par livre...") {
                this.value = "";
            }
        });
    });
   </script> -->

<!--/header-->
</header></div>
	
<!-- content-wrap -->
<div id="content-wrap">
    <!-- content -->
    <div id="content" class="clearfix">
	<div Id="sidebar">
				<div class="sidemenu">
				<h3>Vos précédents commentaires</h3>
					<ul>
						<?php
						if (isset($_SESSION['IdEtu'])&&isset($_SESSION['nomEtu'])){
							// 连接数据库
							$conn = mysqli_connect("localhost", "root", "");
							mysqli_select_db($conn, "forum_db_yufei_sandra");
	
							// 查询用户已借阅的书籍
							$req = "SELECT Avis.IdEtu, Avis.noteAvis, Avis.IdLivre, Livre.titreLivre
									FROM Avis
									INNER JOIN Livre ON Avis.IdLivre = Livre.IdLivre
									WHERE Avis.IdEtu = $IdEtu ;";
							$res = mysqli_query($conn, $req);
	
							// 显示用户借阅的书籍
							if (mysqli_num_rows($res) > 0) {
								while ($row = mysqli_fetch_array($res)) {
									$_SESSION['$IdLivre'] = $row['IdLivre'];
									echo '<li>'."ID livre: " .$row['IdLivre']."</br>". $row['titreLivre'] ."</br>". ' ( note: ' . $row['noteAvis'] . ')';
									echo '</br><a href="avis4.php?IdLivre=' . $row['IdLivre'] . '&titreLivre=' . $row['titreLivre'] . '">Voir </a> | <a href="avis_supprimer.php?IdLivre=' . $row['IdLivre'] . '">Supprimer</a></li>';
								}
							} else {
								echo "Vous n'avez pas encore donné votre avis sur le livre.";
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

   	    <!-- main -->
        <div id="main">

            <div class="main-content">

      	    <h2><a href="avis1.php">Partagez votre avis</a></h2>
			  <p class="post-info"><span>Quand on aime, on partage</span></p>

					<div class="navigation clearfix">
						<div><a href="avis2.php" >Laisser mon avis &raquo; </a></div>
					</div>

					<ul class="archive">

						<?php
						$conn = mysqli_connect("localhost", "root", "");
						mysqli_select_db($conn, "forum_db_yufei_sandra");
						
						$commentsPerPage = 6;// 每页显示的评论数量
						$reqTotalPage = "SELECT COUNT(*) AS totalComments FROM Avis;";// 查询数据库获取评论总数
						$resTotalPage = mysqli_query($conn, $reqTotalPage);
						$rowTotalPage = mysqli_fetch_assoc($resTotalPage);
						$totalComments = $rowTotalPage['totalComments'];
						$totalPages = ceil($totalComments / $commentsPerPage);// 计算总页数
						$page = isset($_GET['page']) ? intval($_GET['page']) : 1;// 获取当前页码，默认为第一页
						$page = max(min($page, $totalPages), 1);// 确保页码在有效范围内
						$offset = ($page - 1) * $commentsPerPage;// 计算 OFFSET 值

						// 查询用户已评论过的书籍
						$req = "SELECT Livre.titreLivre, Livre.IdLivre, Livre.IdAuteur, 
										Avis.noteAvis, Avis.commentaireAvis, 
										Etudiant.nomEtu, Etudiant.prenomEtu, 
										Auteur.nomAuteur, Auteur.prenomAuteur
								FROM Livre, Etudiant, Avis, Auteur
								WHERE Etudiant.IdEtu = Avis.IdEtu AND Avis.IdLivre = Livre.idlivre AND Livre.IdAuteur = Auteur.IdAuteur
								LIMIT $commentsPerPage OFFSET $offset;";
						$res = mysqli_query($conn, $req);

						while ($row = mysqli_fetch_array($res)) {
							$IdLivre  = $row['IdLivre'];
							//$_SESSION['IdLivre'] = $IdLivre;
							echo '<li>
									<div class="post-title"><a href="avis4.php?IdLivre='.$IdLivre.'">'.$row['commentaireAvis'].'</a></div>
									<div class="post-details" methode = "GET">Titre de livre: <a href="#">'.$row['titreLivre'].'</a> <span>|</span> Auteur: <a href="auteur2.php?IdAuteur='.$row['IdAuteur'].'">'.$row['nomAuteur']." ".$row['prenomAuteur'].'</a></div>
								</li>';	
							//echo $_SESSION['IdLivre'];			
						}
						
						?>
						

					</ul>
					<?php
					echo '<div class="navigation clear">';
					if ($page < $totalPages) { // 显示“Page suivante”链接
						echo '<div><a href="avis1.php?page=' . ($page + 1) . '">Page suivante &raquo;</a></div>';
					}
					if ($page > 1) { // 显示“Page précédente”链接
						echo '<div><a href="avis1.php?page=' . ($page - 1) . '">&laquo; Page précédente</a></div>';
					}
					echo "</div>";
					?>

					<!-- <div class="navigation clear">
						<div><a href="#" >&laquo; Page suivante</a></div>
						<div><a href="#" >Page précédente &raquo; </a></div>
					</div> -->

          

        <!-- /main -->
        </div>
		

    <!-- content -->
	</div>

<!-- /content-out -->
</div>
		
</body>
</html>
