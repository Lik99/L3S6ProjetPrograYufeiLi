<?php 
	session_start() ;

    // 获取存储在SESSION中的值
	// $titreLivre = $_SESSION['titreLivre'];
	// $IdAuteur = $_SESSION['IdAuteur'];
	// $_SESSION['IdLivre'];
	// $dateEmprunt = $_SESSION['dateEmprunt'];
	// $dateRetour = $_SESSION['dateRetour'];
    $IdEtu = $_SESSION['IdEtu'];
 //echo ' IdEtu '.$_SESSION['IdEtu'].' titreLivre'.$_SESSION['titreLivre'].' IdAuteur'.$_SESSION['IdAuteur'].' IdLivre'.$_SESSION['IdLivre'].' dateEmprunt'.$_SESSION['dateEmprunt'].' dateRetour'.$_SESSION['dateRetour'];
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
	
 
<!--/header-->
</header></div>
	
<!-- content-wrap -->
<div Id="content-wrap">
    <!-- content -->
    <div Id="content" class="clearfix">
   	    <!-- main -->
        <div Id="main">

      	    <article class="post">

      		    <div class="primary">

                  <!-- Afficher le nom de l'auteur     -->
                  <?php
                  if (isset($_SESSION['IdEtu']) && isset($_SESSION['nomEtu'])) {
                        // 连接数据库
                        $conn = mysqli_connect("localhost", "root", "");
                        mysqli_select_db($conn, "forum_db_yufei_sandra");

                        // 获取从auteur1.php传递的作者ID
                        if(isset($_GET['IdAuteur'])) {
                            $IdAuteur = $_GET['IdAuteur'];

                            // 查询指定作者的信息
                            $req = "SELECT * FROM Auteur WHERE IdAuteur = $IdAuteur;";
                            $res = mysqli_query($conn, $req);

                            // 显示作者信息
                            while ($row = mysqli_fetch_array($res)) {
                                echo '<div class="author-info">';
                                echo '<p><h2>'. $row['nomAuteur'] . ' ' . $row['prenomAuteur'] .'</h2></p>';
                                echo '<p><h5>'. $row['introAuteur'] .'</h5></p>';
                                echo '</div>';
                            }
                        } 

                        // 关闭数据库连接
                        mysqli_close($conn);
                    } else{
                        echo "Veuillez vous connecter avant de visualiser les informations sur l'auteur";
                    }
                    ?>

                    <!-- Afficher les livres de cet auteur -->
                    
					 <?php			
					// 连接数据库
					$conn = mysqli_connect("localhost", "root", "");
					mysqli_select_db($conn, "forum_db_yufei_sandra");
                    if(isset($_GET['IdAuteur'])) {
                        $IdAuteur = $_GET['IdAuteur'];
                    
                        // 默认按照标题排序
                        $orderBy = "titreLivre";
                    
                        // 检查是否触发了按照年份排序的按钮
                        if(isset($_GET['sort']) && $_GET['sort'] === 'annee') {
                            if($_GET['sort'] === 'annee'){
                                $orderBy = "anneePubli";
                            } else if($_GET['sort'] === 'titre'){
                                $orderBy = "titreLivre";
                            }
                            
                        }
                    
                        // 查询与作者相关的书籍，并按照指定顺序排序
                        $req = "SELECT IdAuteur,IdLivre, titreLivre, anneePubli FROM Livre WHERE IdAuteur = $IdAuteur ORDER BY $orderBy;";
                        $res = mysqli_query($conn, $req);
                    
                        // 开始表格
                        echo '<table>';
                        echo '<tr><th>Titre Livre<a href="auteur2.php?IdAuteur=' . $IdAuteur . '&sort=titre" style="color: gray;"></br>Classer par titre</a></th>
                                  <th>Année de Publication <a href="auteur2.php?IdAuteur=' . $IdAuteur . '&sort=annee" style="color: gray;"></br>Classer par année</a></th></tr>';
                    
                        // 显示作者信息
                        while ($row = mysqli_fetch_array($res)) {
                            echo '<tr>';
                            echo '<td>' . $row['titreLivre'] . '</td>';
                            echo '<td>' . $row['anneePubli'] . '</td>';
                            // 检查当前用户是否已经借阅了该书籍
                            $reqCheck = 'SELECT * FROM Emprunter WHERE IdEtu = '.$_SESSION['IdEtu'].' AND IdLivre = ' . $row['IdLivre'] . ' AND retourne = false;';
                            $resCheck = mysqli_query($conn, $reqCheck);
                            $isBorrowed = mysqli_num_rows($resCheck);

                            if ($isBorrowed == 1 ) {
                                echo '<td><a href="retourner1.php?IdLivre=' . $row['IdLivre'] . '&titreLivre=' . $row['titreLivre'] . '&IdAuteur=' . $row['IdAuteur'] . '">Retour</a></td>';
                            }else if($isBorrowed == 0) {
                                echo '<td><a href="emprunter1.php?IdLivre=' . $row['IdLivre'] . '&titreLivre=' . $row['titreLivre'] . '&IdAuteur=' . $row['IdAuteur'] . '">Emprunter</a></td>';
                            }
                            echo '</tr>';
                        }
                    
                        // 结束表格
                        echo '</table>';
                    }

					// 关闭数据库连接
					mysqli_close($conn);
					?>
					
                    <a href="auteur1.php">Retour à voir tous les auteurs</a>
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
        <!-- sidebar -->
		<div Id="sidebar">
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
