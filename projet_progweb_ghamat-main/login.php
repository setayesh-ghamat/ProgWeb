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
                <li>
                    <a href="login.php" class="active"><span class="en">Login</span><span class="fr">Connexion</span></a>
                </li>
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
        <div class="container">
            <h1 class="center title"><span class="en">Admin Login</span><span class="fr">Connexion administrateur</span></h1>
            <div class="login-box">
               <form action="" id="login-form">
                <div id="info">
                    
                </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="inp" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password"><span class="en">Password</span><span class="fr">Mot de passe</span>:</label>
                        <input type="password" class="inp" id="password">
                    </div>
                    <div class="form-group center">
                        <button type="submit" class="btn btn-main"><span class="en">Login</span><span class="fr">Connexion</span></button>
                    </div>
               </form>
            </div>
        </div>
    </main>
    <footer>
        <p class="center">
            &copy; <span class="en">Copyright 2022 - FILMS</span><span class="fr">Copyright 2022 - FILMS</span>
        </p>
    </footer>
</body>
<script src="js/script.js"></script>
</html>