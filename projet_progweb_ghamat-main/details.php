<?php
session_start();
if (isset($_REQUEST['id'])) {
    $info = 'get_film('.$_REQUEST['id'].')';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php" class="logo">Films</a>
            <ul class="nav-items">
                <li>
                    <a href="index.php" class="active"><span class="en">Home</span><span class="fr">Page d'accueil</span></a>
                </li>
                <li>
                    <a href="about.php"><span class="en">About</span><span class="fr">À propos de</span></a>
                </li>
                <?php
                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                    echo '<li>
                            <a href="admin.php"><span class="en">Admin</span><span class="fr">Administrateur</span></a>
                        </li>
                        <li>
                            <a href="logout.php"><span class="en">Logout</span><span class="fr">Se déconnecter</span></a>
                        </li>';
                }else{
                    echo '<li>
                            <a href="login.php"><span class="en">Login</span><span class="fr">Connexion</span></a>
                        </li>';
                }
                ?>
                <li>
                    <select class="inp" onchange="changeLang(this.value); redirect();">
                        <option value="" selected disabled>Choose Language</option>
                        <option value="en">English</option>
                        <option value="fr">French</option>
                    </select>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="films details" id="show1">
                
            </div>
        </div>
    </main>
    <footer>
        <p class="center">
            &copy; <span class="en">Copyright 2022 - FILMS</span><span class="fr">Copyright 2022 - FILMS</span>
        </p>
    </footer>
</body>
<script>
    let page = 2;
</script>
<script src="js/script.js"></script>
<script>
    <?php echo $info; ?>
</script>
</html>