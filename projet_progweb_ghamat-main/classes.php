<?php
session_start();
include('conn.php');
$func = new functions();

if (isset($_REQUEST['login'])) {
    $func->login($db);
}

if (isset($_REQUEST['add'])) {
    $func->add_films($db);
}

if (isset($_REQUEST['show'])) {
    $func->show_films($db);
}

if (isset($_REQUEST['edit'])) {
    $func->edit_about($db);
}

if (isset($_REQUEST['get_about'])) {
    $func->get_about($db);
}

if (isset($_REQUEST['get_about1'])) {
    $func->get_about1($db);
}

if (isset($_REQUEST['id'])) {
    $func->get_film($db);
}
// print_r($_REQUEST);
// print_r($_FILES);
class functions 
{
    public function login($db)
    {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $statement = $db->prepare("SELECT * from  `admin` WHERE `email` = ?");
        $statement->execute(array($email));
        $result = $statement->fetchAll();
        if (!empty($result)) {
            if (password_verify($password,$result[0]['password'])) {
                echo 1;
                $_SESSION['login'] = true;
            } else {
                echo 2;
            }
        }else{
            echo 0;
        }

    }
    
    public function add_films($db)
    {
        $title = $this->sanitize($_REQUEST['title']);
        $director = $this->sanitize($_REQUEST['director']);
        $year = $this->sanitize($_REQUEST['year']);
        $language = $this->sanitize($_REQUEST['language']);
        $actors = $this->sanitize($_REQUEST['actors']);
        $description = $this->sanitize($_REQUEST['description']);
        $web_lang = $this->sanitize($_REQUEST['web_lang']);
        
        if (!empty($_FILES['image']['name'])) {

            $target_dir = 'uploads/';
            $temp = $_FILES['image']['tmp_name'];
            $uniq = time() . rand(1000, 9999);
            $info = pathinfo($_FILES['image']['name']);

            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            //    Allow certain files formats
            if ($imageFileType !== "jpg" && $imageFileType !== "jpeg" && $imageFileType !== "png") {
                echo 2;
                die();
            }

            //  Check image size
            $size = $_FILES["image"]["size"];
            if ($size > 5000000) {
                echo 3;
                die();
            }
            $image_name = "image_" . $uniq . "." . $info['extension']; //with your created name
            if (file_exists($target_dir . $image_name)) {

                while (file_exists($target_dir)) {
                    $temp = $_FILES['image']['tmp_name'];
                    $uniq = time() . rand(1000, 9999);
                    $info = pathinfo($_FILES['image']['name']);
                    $image_name = "image_" . $uniq . "." . $info['extension']; //with your created name
                }

                move_uploaded_file($temp, $target_dir . $image_name);
            }

            move_uploaded_file($temp, $target_dir . $image_name);
            $image = $image_name;
            $attach = ", `image` = '{$image}'";
        } else {
            $image = "";
            $attach = "";
        }
        $statement1 = $db->prepare("INSERT INTO `films` (`id`,`title`, `director`, `year`, `lang`, `actors`, `description`, `image`, `web_lang`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement1->execute(array(NULL,$title,$director,$year,$language,$actors,$description,$image,$web_lang));
        if ($statement1 !== FALSE) {
            echo 1;
        }else{
            echo 0;
        }
    
    }
    public function edit_about($db)
    {
        $about = $this->sanitize($_REQUEST['about']);
        $about1 = $this->sanitize($_REQUEST['about1']);
        $id = 1;
        $statement = $db->prepare("UPDATE `about_page` SET `about`= ?, `about1`= ? WHERE `abt_id` = ?") ;
        $statement->execute([$about,$about1,$id]);
        if ($statement !== FALSE) {
            echo 1;
        }else{
            echo 0;
        }
    
    }

    public function get_about($db)
    {
        $id = 1;
        $statement = $db->prepare("SELECT * FROM `about_page` WHERE `abt_id` = ?") ;
        $statement->execute([$id]);
        $result = $statement->fetchAll();
        if (!empty($result)) {
            echo nl2br($result[0]['about']);
        }else{
            echo 0;
        }
    }
    
    public function get_about1($db)
    {
        $id = 1;
        $statement = $db->prepare("SELECT * FROM `about_page` WHERE `abt_id` = ?") ;
        $statement->execute([$id]);
        $result = $statement->fetchAll();
        if (!empty($result)) {
            echo nl2br($result[0]['about1']);
        }else{
            echo 0;
        }
    }

    public function show_films($db)
    {
        $show = '';
        $web_lang = $this->sanitize($_REQUEST['web_lang']);
        $statement = $db->prepare("SELECT * FROM `films` WHERE `web_lang` = ? ORDER BY `id` DESC") ;
        $statement->execute([$web_lang]);
        $result = $statement->fetchAll();
        if (!empty($result)) {
            $i = 0;
            foreach ($result as $film) {
                $img = '';
                if (!empty($film['image'])) {
                    $img = '<img class="f-img" src="uploads/'.$film['image'].'">';
                }else{
                    $img = '<img class="f-img" src="uploads/thumbnail.jpg">';
                }
                $show .= '<div class="film">
                <div class="f-top">
                    '.$img.'
                    <div class="f-title">
                        <h3>'.nl2br($film['title']).'</h3>
                    </div>
                    <div class="f-details">
                        <p class="f-desc">'.$film['description'].'</p>
                        </div>
                </div>
                <div class="f-bottom">
                    <a href="details.php?id='.$film['id'].'" class="btn btn-main"><span class="en">Details</span><span class="fr">Détails</span></a>
                </div>
            </div>';
            }
        }else{
            $show = 0;
        }
        echo $show;
        

    }
    public function get_film($db)
    {
        $show = '';
        $id = $this->sanitize($_REQUEST['id']);
        $statement = $db->prepare("SELECT * FROM `films` WHERE `id` = ?") ;
        $statement->execute([$id]);
        $result = $statement->fetchAll();
        // print_r($result);
        if (!empty($result)) {
            $i = 0;
            foreach ($result as $film) {
                $img = '';
                if (!empty($film['image'])) {
                    $img = '<img src="uploads/'.$film['image'].'">';
                }else{
                    $img = '<img src="uploads/thumbnail.jpg">';
                }
                $show .= '<div class="film '.$film['web_lang'].'">
                <div class="det-img">
                    '.$img.'
                </div>
            <div class="det-right">
                <div class="f-top">
                <div class="f-title">
                    <h3>'.nl2br($film['title']).'</h3>
                </div>
                </div>
            <div class="f-bottom">
                <div class="f-details">
                <div class="detail"><p><b>Director: </b>'.nl2br($film['director']).'</p></div>
                <div class="detail"><p><b>Year: </b>'.nl2br($film['year']).'</p></div>
                <div class="detail"><p><b>Language: </b>'.nl2br($film['lang']).'</p></div>
                <div class="detail"><p><b>Actors: </b>'.nl2br($film['actors']).'</p></div>
                </div>
                <p class="f-desc">'.nl2br($film['description']).'</p>
            </div></div>
            </div>';
            }
        }else{
            $show = 0;
        }
        echo $show;
        

    }
    
    public function sanitize($string)
    {
        $string = htmlspecialchars($string);
        $string = stripslashes($string);
        return $string;
    }

    // Creating Tables
    public function tableFilms($db)
    {
        
    $table1 =<<<EOF
            CREATE TABLE "films" (
                "id"	INTEGER NOT NULL,
                "title"	TEXT NOT NULL,
                "director"	TEXT NOT NULL,
                "year"	TEXT NOT NULL,
                "lang"	TEXT NOT NULL,
                "actors"	TEXT NOT NULL,
                "description"	TEXT NOT NULL,
                "image"	TEXT,
                "web_lang"	TEXT,
                PRIMARY KEY("id" AUTOINCREMENT)
            );
        EOF;
    
        $ret1 = $db->exec($table1);
        if(!$ret1){
            echo $db->lastErrorMsg();
        } else {
            echo "<br>Films Table created successfully\n";
        }
    
    }
    
    public function tableAdmin($db)
    {
        
        $table2 =<<<EOF
        CREATE TABLE "admin" (
            "a_id"	INTEGER NOT NULL,
            "email"	TEXT NOT NULL,
            "password"	TEXT NOT NULL,
            PRIMARY KEY("a_id" AUTOINCREMENT)
        );
        EOF;
        $ret2 = $db->exec($table2);
    
        
        if(!$ret2){
            echo $db->lastErrorMsg();
        } else {
            echo "<br>About Table created successfully\n";
        }
    
    }
    
    
    public function tableAbout_Page($db)
    {
        
        $table1 =<<<EOF
        CREATE TABLE "about_page" (
            "abt_id"	INTEGER,
            "about"	TEXT,
            "about1"	TEXT,
            PRIMARY KEY("abt_id" AUTOINCREMENT)
        );
        EOF;
$ret2 = $db->exec($table1);
    
        if(!$ret2){
            echo $db->lastErrorMsg();
        } else {
            echo "<br>About Table created successfully\n";
        }
    
    }
}
