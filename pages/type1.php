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

    <title>Type</title>

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
			<li id="current"><a href="type1.php">Type</a><span></span></li>
			<li><a href="auteur1.php">Auteur</a><span></span></li>
			<li><a href="avis1.php">Avis</a><span></span></li>
		</ul>
	</nav>

    <div class="subscribe">
	<a href="connexion1.php">Connecter</a> | <a href="inscrire1.php">S'inscrire</a> | <a href="deconnexion.php">Quitter</a>
    </div>

   <form id="quick-search" method="get" action="type_recherche.php">
      <fieldset class="search">
         <label for="qsearch">Search:</label>
         <input class="tbox" id="qsearch" type="text" name="qsearch" value="Recherche par type..." title="Start typing and hit ENTER" />
         <button class="btn" title="Submit Search">Search</button>
      </fieldset>
   </form>
   <script>
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.getElementById('qsearch');
        input.addEventListener('focus', function() {
            if (this.value === "Recherche par type...") {
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

      	    <article class="post">

      		    <div class="primary">

                    <h2><a href="type1.html">Quel type recherchez-vous?</a></h2>

                    <p class="post-info"><span>Des livres pour tous les goûts</span></p>

					<form action="type2.php" method="GET">
					<?php
						if (isset($_SESSION['IdEtu']) && isset($_SESSION['nomEtu'])) {
						$conn = mysqli_connect("localhost", "root", "");
						mysqli_select_db($conn, "forum_db_yufei_sandra");
						
						$typesPerPage = 6;// 每页显示的评论数量
						$reqTotalPage = "SELECT COUNT(*) AS totalType FROM Type;";// 查询数据库获取评论总数
						$resTotalPage = mysqli_query($conn, $reqTotalPage);
						$rowTotalPage = mysqli_fetch_assoc($resTotalPage);
						$totalType = $rowTotalPage['totalType'];
						$totalPages = ceil($totalType / $typesPerPage);// 计算总页数
						$page = isset($_GET['page']) ? intval($_GET['page']) : 1;// 获取当前页码，默认为第一页
						$page = max(min($page, $totalPages), 1);// 确保页码在有效范围内
						$offset = ($page - 1) * $typesPerPage;// 计算 OFFSET 值

						// 查询所有种类
						$req = "SELECT *
								FROM Type LIMIT $typesPerPage OFFSET $offset;";
						$res = mysqli_query($conn, $req);

						while ($row = mysqli_fetch_array($res)) {
							$nomType = $row['nomType'];
							$IdType = $row['IdType'];
							//$_SESSION['IdType'] = $IdType;
							echo '<div class="image-section">';
							echo '<p><a href="type2.php?IdType='.$IdType.'">'.$nomType.'</a></p>';	
							echo '</div>';
							//echo $_SESSION['IdType'];			
						}
					}else{
						echo "Veuillez vous connecter pour voir les type.";
					 }
						?>
					</form>
					
                    

					<?php
					if ($page < $totalPages) { // 显示“Page suivante”链接
						echo '<p><a class="more" href="type1.php?page=' . ($page + 1) . '">Page suivante &raquo;</a></p>';
					}
					if ($page > 1) { // 显示“Page précédente”链接
						echo '<p><a class="more" href="type1.php?page=' . ($page - 1) . '">&laquo; Page précédente</a></p>';
					}
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
