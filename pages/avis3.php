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


<!--/header-->
</header></div>
	
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main">

            <div class="main-content">

      	    <h2><a href="avis2.php">Partagez votre avis</a></h2>
			  <p class="post-info"><span>Quand on aime, on partage</span></p>
              <a id="returnLink" href="avis1.php">Retour à la page Avis</a>

              <div class="post-bottom-section">


                <h4>Dites-nous ce que vous en pensez</h4>

                <div class="primary">

                    <form action="avis3.php" method="post" id="commentform">

                        <ul>
						 <?php
                         // 1. Vérifier si la soumission a été reçue
							if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // 2. Vérifier le titre de livre, le note, les comments
                                if (isset($_POST['titreLivre'])&& isset($_POST['noteAvis']) && isset($_POST['commentaireAvis'])) {
                                    // 3. Vérifier si la note est comprise entre 0 et 10
                                    if(($_POST['noteAvis'] <= 10) && ($_POST['noteAvis'] >= 0) ){
                                        // 4. Vérifier les téléchargements d'images
                                        if (isset($_FILES['imageAvis']) && $_FILES['imageAvis']['error'] === UPLOAD_ERR_OK) {
                                            $uploadDir = 'imageAvis/'; // 保存图片的目录
                                            $tmpFilePath = $_FILES['imageAvis']['tmp_name'];
                                            $fileName = $_FILES['imageAvis']['name'];
                                            $filePath = $uploadDir . uniqid() . '_' . $fileName;

                                            // echo "tmpFilePath: " . $tmpFilePath . "</br></br>";
                                            // echo "fileName: " . $fileName . "</br></br>";
                                            // echo "filePath: " . $filePath . "</br></br>";
                                    
                                            // Déplacement des fichiers temporaires vers le chemin de destination 将临时文件移动到目标路径
                                            if (move_uploaded_file($tmpFilePath, $filePath)) {
                                                // téléchargé avec succès 文件成功上传，显示成功
                                                echo "L'image a été téléchargée avec succès.</br></br>";
                                                // 获取通过POST方法发送的数据
                                                $titreLivre = $_POST['titreLivre'];
                                                $noteAvis = $_POST['noteAvis'];
                                                $commentaireAvis = $_POST['commentaireAvis'];
                                                
                                                $conn = mysqli_connect("localhost", "root", "");
                                                mysqli_select_db($conn, "forum_db_yufei_sandra");
                                                
                                                // req pour afficher tous les livres empruntés par l'utilisateur
                                                $req = "SELECT * FROM Livre WHERE titreLivre LIKE '%" . $titreLivre . "%';";
                                                // echo $req; // pour verfier le req
                                                $res = mysqli_query($conn, $req);
                                                $row = mysqli_fetch_array($res);
                                                $IdLivre = $row['IdLivre'];
                                        
                                                echo "Votre ID: ".$IdEtu. "<br>";
                                                echo "Votre nom: ".$nomEtu. "<br>";
                                                echo "ID du livre: " . $IdLivre . "<br>";
                                                echo "Titre du livre: " . $titreLivre . "<br>";
                                                echo "Note: " . $noteAvis . "<br>";
                                                echo "Message: " . $commentaireAvis . "<br>";
                                                // Insérer les données des commentaires dans le tableau Avis
                                                $insertQuery = "INSERT INTO Avis (imageAvis, commentaireAvis, noteAvis, IdEtu, IdLivre) 
                                                VALUES ('$filePath', '$commentaireAvis', '$noteAvis', '$IdEtu', '$IdLivre');";
                                                // echo $insertQuery;
                                                // Exécution d'insertion
                                                if (mysqli_query($conn, $insertQuery)) {
                                                    echo "</br></br><p>Votre avis a été enregistré avec succès.";
                                                } else {
                                                    echo "Erreur lors de l'enregistrement de votre avis. ";
                                                }

                                            } else {
                                                // téléchargé avec NON succès 文件没有成功上传，显示不成功
                                                echo "Erreur lors du téléchargement de l'image,
                                                Assurez-vous que le dossier que vous choisissez pour enregistrer vos images 
                                                a des droits d'accès suffisants pour permettre aux scripts PHP d'y écrire.</p></br>";
                                                echo "move " . (move_uploaded_file($tmpFilePath, $filePath) ? 'success' : 'failed');
                                            }
                                        }
                                    } else {
                                        echo "La note doit être comprise entre 0 et 10";
                                    }
                                } else {
                                    echo "Certaines données sont manquantes.";
                                }
                            } else {
                                echo "Aucune donnée n'a été soumise.";
                            }
                            mysqli_close($conn);
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
