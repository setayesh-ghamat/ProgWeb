<?php
session_start();
if (!isset($_SESSION['login']) && $_SESSION['login'] != true) {
    header('index.php');
    die();
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
                    <a href="index.php"><span class="en">Home</span><span class="fr">Page d'accueil</span></a>
                </li>
                <li>
                    <a href="about.php"><span class="en">About</span><span class="fr">À propos de</span></a>
                </li>
                <?php
                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                    echo '<li>
                            <a href="admin.php" class="active"><span class="en">Admin</span><span class="fr">Administrateur</span></a>
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
                    <select class="inp" onchange="changeLang(this.value)">
                        <option value="" selected disabled>Choose Language</option>
                        <option value="en">English</option>
                        <option value="fr">French</option>
                    </select>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container admin-section">
            <div class="films-section">
                <h1 class="center title"><span class="en">Add Films</span><span class="fr">Ajouter des films</span></h1>
                <div class="login-box">
                    <form action="" id="add-form">
                        <div id="info"></div>
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="inp" id="title">
                        </div>
                        <div class="form-group">
                            <label for="director">Director:</label>
                            <input type="text" class="inp" id="director">
                        </div>
                        <div class="form-group">
                            <label for="year">Year:</label>
                            <input type="number" class="inp" id="year">
                        </div>
                        <div class="form-group">
                            <label for="language">Language:</label>
                            <input type="text" class="inp" id="language">
                        </div>
                        <div class="form-group">
                            <label for="actors">Actors:</label>
                            <input type="text" class="inp" id="actors">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea type="text" class="inp" id="description" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" class="inp" id="image">
                        </div>
                        <div class="form-group">
                            <label for="web_lang">Choose Language:</label>
                            <select type="text" class="inp" id="web_lang">
                                <option value="en">English</option>
                                <option value="fr">French</option>
                            </select>
                        </div>
                        <div class="form-group center">
                            <button type="submit" class="btn btn-main"><span class="en">Add Films</span><span class="fr">Ajouter des films</span></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="about-section">
                <h1 class="center title"><span class="en">Update About</span><span class="fr">Mettre à jour</span></h1>
                <div class="login-box">
                    <form action="" id="edit-form">
                        <div id="info1"></div>
                        <div class="form-group">
                            <label for="about">About:</label>
                            <textarea type="text" class="inp" id="about" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="about1">À propos de:</label>
                            <textarea type="text" class="inp" id="about1" rows="5"></textarea>
                        </div>
                        <div class="form-group center">
                            <button type="submit" class="btn btn-main"><span class="en">Update About</span><span class="fr">Mettre à jour</span></button>
                        </div>
                    </form>
                </div>
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
    let page = 0;
</script>
<script src="js/script.js"></script>
<script>
    get_about(1);
    get_about1(1);
</script>
</html>