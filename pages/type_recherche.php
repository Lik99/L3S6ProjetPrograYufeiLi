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
			<li><a href="index.php">Home</a><span></span></li>
			<li id="current"><a href="type1.php">Type</a><span></span></li>
			<li><a href="auteur1.php">Auteur</a><span></span></li>
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

                <h2><a href="auteur1.php">Quel type recherchez-vous?</a></h2>

                <p class="post-info"><span>Des livres pour tous les goûts</span></p>

                <?php
                if (isset($_SESSION['IdEtu']) && isset($_SESSION['nomEtu'])) {	
                // 连接数据库
                $conn = mysqli_connect("localhost", "root", "");
                mysqli_select_db($conn, "forum_db_yufei_sandra");

                // 获取搜索参数
                if(isset($_GET['qsearch'])) {
                    $searchTerm = $_GET['qsearch'];

                    // 根据搜索参数查询作者表
                    $req = "SELECT IdType, nomType FROM Type WHERE LOWER(nomType) = LOWER('%$searchTerm%');";
                    $res = mysqli_query($conn, $req);

                    // 显示匹配的作者信息
                    if ($row = mysqli_fetch_array($res)) {
						echo '<div class="image-section">';
						echo '<p><a href="type2.php?IdType=' . $row['IdType'] . '">' . $row['nomType'] . ' </a></p>';
						echo '</div>';                       
					}else {
                        echo "Nous n'avons pas trouvé le type que vous recherchiez";
                    }
                } 

                // 关闭数据库连接
                mysqli_close($conn);
                } else{
                    echo "Veuillez vous connecter et refaire une recherche !";
                }
                echo '<p><a href="type1.php"> Retour à la page du type </a></p>';
                ?>
                
                <!-- /primary -->
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
