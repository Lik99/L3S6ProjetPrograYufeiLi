<?php 
	session_start() ;
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
			<li id="current"><a href="index.php">Home</a><span></span></li>
			<li><a href="type1.php">Type</a><span></span></li>
			<li><a href="auteur1.php">Auteur</a><span></span></li>
			<li><a href="avis1.php">Avis</a><span></span></li>
		</ul>
	</nav>

    <div class="subscribe">
	<a href="connexion1.php">Connecter</a> | <a href="inscrire1.php">S'inscrire</a> | <a href="deconnexion.php">Quitter</a>
    </div>
	
   <!-- <form id="quick-search" method="get" action="index.html">
      <fieldset class="search">
         <label for="qsearch">Search:</label>
         <input class="tbox" id="qsearch" type="text" name="qsearch" value="Search..." title="Start typing and hit ENTER" />
         <button class="btn" title="Submit Search">Search</button>
      </fieldset>
   </form> -->

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

                    <h2><a href="index.php">Les nouveautés livres</a></h2>

                    <p class="post-info"><span>Ça vient de sortir !</span></p>

               	    <!-- <div class="image-section"> -->
              		    <!-- <img src="images/img-post.jpg" alt="image post" height="206" width="498"/> -->
						  <?php
							// 连接数据库
							$conn=mysqli_connect("localhost", "root", "") ;
							mysqli_select_db($conn,"forum_db_yufei_sandra");
							// 从数据库中随机选择一本书的图片链接
							$req = "SELECT titreLivre FROM Livre ORDER BY RAND() LIMIT 1;";						
							//$req = "SELECT titreLivre FROM Livre WHERE titreLivre = 'Le Dernier Jour d_un condamné';";
							$res =  mysqli_query($conn, $req); 
							// gestion des erreur
							if (!$res) {
								die('Erreur MySQL : ' . mysqli_error($conn));
							}
							$row = mysqli_fetch_array($res);

							$_SESSION['titreLivre'] = $row['titreLivre'];

							// 格式化书名以构建有效文件名
							if ($_SESSION['titreLivre']) {
								$bookTitle = $_SESSION['titreLivre'];
								$fileName = str_replace(' ', '_', $bookTitle); // 替换空格为下划线（或其他适当字符）
								$filePath = "images_livres/" . $fileName . ".jpg"; // 构建文件路径

								// 检查文件是否存在
								if (file_exists($filePath)) {
									echo '<div class="image-section">';
									echo '<img src="' . $filePath . '" alt="Avis Image" width="300" height="400"/>';
									echo '</div>';
								} else {
									echo "Aucune image trouvée ce livre, vous pouvez rafraîchir la page pour découvrir un autre livre: </br>";
								}
							} else {
								echo "Aucun titre de livre n'a été trouvé dans la session.";
							}
							echo $_SESSION['titreLivre'];
							

							// 关闭数据库连接
							$conn->close();
							?>
					

                    
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
		    </article>           
        <!-- /main -->
        </div>

        <!-- sidebar -->
		<div id="sidebar">

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

		<h3>Notre sélection</h3>

		<ul>
			<?php
			if (isset($_SESSION['IdEtu']) && isset($_SESSION['nomEtu'])) {	
			// 连接数据库
			$conn = mysqli_connect("localhost", "root", "");
			mysqli_select_db($conn, "forum_db_yufei_sandra");

			// 随机查询五个作者
			$req = "SELECT IdType, nomType FROM Type ORDER BY RAND() LIMIT 5;";
			$res = mysqli_query($conn, $req);
			// 显示随机的五个作者信息
			while ($row = mysqli_fetch_array($res)) {
			
				echo '<li><a href="type2.php?IdType=' . $row['IdType'] . '">' . $row['nomType'] . '</a>';
				
				// 查询作者写的一本随机书籍
				$req1 = "SELECT IdType, titrelivre FROM Livre WHERE IdType =" . $row['IdType'] . " ORDER BY RAND() LIMIT 2;";
				$res1 = mysqli_query($conn, $req1);

				// 如果有相关书籍，则显示书的信息
				if($res1){
					while ($row1 = mysqli_fetch_array($res1)) {
						echo '<br/><span>' . $row1['titrelivre'] . '</span>';
					} 
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


        <!-- /sidebar -->
		</div>

    <!-- content -->
	</div>
<!-- /content-out -->
</div>

</body>
</html>
