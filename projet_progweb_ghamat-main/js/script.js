function login(email,password) {
    const xhttp = new XMLHttpRequest();
    let info = document.getElementById('info');
    xhttp.onload = function() {
      if (this.responseText == 1) {
        info.innerHTML = '<div class="noti success"><span class="en">Logged In successfully!<br>Redirecting...</span><span class="fr">Connexion réussie !<br>Redirection...</span></div>';
        setTimeout(() => {
          window.location = 'admin.php';
        }, 2000);
      }else{
        info.innerHTML = '<div class="noti error"><span class="en">Incorrect Email or Password!</span><span class="fr">Email ou mot de passe incorrect!</span></div>';
      }
    }
    xhttp.open("POST", "classes.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email="+email+"&password="+password+"&login=1");
  }


  function show_films(lang) {
    const xhttp = new XMLHttpRequest();
    let show = document.getElementById('show');
    xhttp.onload = function() {
      if (this.responseText == 0) {
        console.log(this.responseText);
        show.innerHTML = '<div class="noti error"><span class="en">No films present!</span><span class="fr">Aucun film présent !</span></div>';
      }else{
        show.innerHTML = this.responseText;
      }
    }
    xhttp.open("POST", "classes.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("web_lang="+ lang +"&show=1");
  }
  
  function get_film(id) {
    const xhttp = new XMLHttpRequest();
    let show = document.getElementById('show1');
    xhttp.onload = function() {
      if (this.responseText == 0) {
        show.innerHTML = '<div class="noti error"><span class="en">No films present!</span><span class="fr">Aucun film présent !</span></div>';
      }else{
        show.innerHTML = this.responseText;
      }
      // console.log(this.responseText);
    }
    xhttp.open("POST", "classes.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id="+id);
  }

  function get_about(page) {
    const xhttp = new XMLHttpRequest();
    let info = document.getElementById('info1');
    xhttp.onload = function() {
      if (this.responseText == 0) {
        info.innerHTML = '<div class="noti error"><span class="en">About is empty!</span><span class="fr">A propos est vide !</span></div>';
      }else{
        let text = this.responseText;
        if (page == 1) {
          text = text.replaceAll("<br />", "");
        }
        console.log(text);
        document.getElementById('about').innerHTML = text;
      }
    }
    xhttp.open("POST", "classes.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("get_about=1");
  }
  
  function get_about1(page) {
    const xhttp = new XMLHttpRequest();
    let info = document.getElementById('info1');
    xhttp.onload = function() {
      if (this.responseText == 0) {
        info.innerHTML = '<div class="noti error"><span class="en">About is empty!</span><span class="fr">A propos est vide !</span></div>';
      }else{
        let text = this.responseText;
        if (page == 1) {
          text = text.replaceAll("<br />", "");
        }
        console.log(text);
        document.getElementById('about1').innerHTML = text;
      }
    }
    xhttp.open("POST", "classes.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("get_about1=1");
  }

  function edit_about(about,about1) {
    const xhttp = new XMLHttpRequest();
    let info = document.getElementById('info1');
    xhttp.onload = function() {
      if (this.responseText == 1) {
        info.innerHTML = '<div class="noti success"><span class="en">About text updated successfully!</span><span class="fr">À propos du texte mis à jour avec succès !</span></div>';
      }else{
        info.innerHTML = '<div class="noti error"><span class="en">An error occurred!</span><span class="fr">Une erreur s\'est produite !</span></div>';
      }
      // console.log(this.responseText);
    }
    xhttp.open("POST", "classes.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("about="+about+"&about1="+about1+"&edit=1");
  }
  let login_form = document.getElementById('login-form');
  if (login_form) {
    login_form.addEventListener('submit',function (e) {
      let info = document.getElementById('info');
      let email = document.getElementById('email').value;
      let password = document.getElementById('password').value;
      if (email == '') {
        info.innerHTML = '<div class="noti error"><span class="en">Email cannot be empty!</span><span class="fr">L\'e-mail ne peut pas être vide !</span></div>';
      }else if (password == '') {
        info.innerHTML = '<div class="noti error"><span class="en">Password cannot be empty!</span><span class="fr">Le mot de passe ne peut pas être vide !</span></div>';
      }else{
        login(email,password);
      }
      e.preventDefault();
    })
  }

  let add_form = document.getElementById('add-form');
  if (add_form) {
    add_form.addEventListener('submit',function (e) {
      e.preventDefault();
      let info = document.getElementById('info');
      let title = document.getElementById('title').value;
      let director = document.getElementById('director').value;
      let year = document.getElementById('year').value;
      let language = document.getElementById('language').value;
      let actors = document.getElementById('actors').value;
      let description = document.getElementById('description').value;
      let web_lang = document.getElementById('web_lang').value;
      let image = document.getElementById('image').files[0];
      if (title == '') {
        info.innerHTML = '<div class="noti error">Title field cannot be empty!</div>';
      }else if (director == '') {
        info.innerHTML = '<div class="noti error">Director field cannot be empty!</div>';
      }else if (year == '') {
        info.innerHTML = '<div class="noti error">Year field cannot be empty!</div>';
      }else if (language == '') {
        info.innerHTML = '<div class="noti error">Language field cannot be empty!</div>';
      }else if (actors == '') {
        info.innerHTML = '<div class="noti error">Actors field cannot be empty!</div>';
      }else if (description == '') {
        info.innerHTML = '<div class="noti error">Description field cannot be empty!</div>';
      }else if (image == undefined) {
        info.innerHTML = '<div class="noti error">Upload an image please!</div>';
      }else{
        add_films(title,director,year,language,actors,description,image,web_lang);
      }
      e.preventDefault();
    })
}


function add_films(title,director,year,language,actors,description,image,web_lang) {
  var fd = new FormData();
  fd.append('title',title);
  fd.append('director',director);
  fd.append('year',year);
  fd.append('language',language);
  fd.append('actors',actors);
  fd.append('description',description);
  fd.append('web_lang',web_lang);
  fd.append('image',image);
  fd.append('add',"1");
  // fd.append()
  // console.log(fd);
  const xhttp = new XMLHttpRequest();
  let info = document.getElementById('info');
  xhttp.onload = function() {
    if (this.responseText == 1) {
      info.innerHTML = '<div class="noti success"><span class="en">Film added successfully!</span><span class="fr">Film ajouté avec succès !</span></div>';
      document.getElementById('add-form').reset();
    }else if(this.responseText == 2){
      info.innerHTML = '<div class="noti error"><span class="fr">L\'image doit être au format PNG, JPEG ou JPG !</span><span class="en">Image should be either PNG, JPEG or JPG!</span></div>';
    }else if(this.responseText == 3){
      info.innerHTML = '<div class="noti error"><span class="fr">L\'image ne doit pas dépasser 5 Mo !</span><span class="en">Image should not be more than 5 MB!</span></div>';
    }else{
      info.innerHTML = '<div class="noti error"><span class="en">An error occurred!</span><span class="fr">Une erreur s\'est produite !</span></div>';
    }
    console.log(this.responseText);
  }
  xhttp.open("POST", "classes.php");
  // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // xhttp.setRequestHeader("Content-type","multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2));
  // xhttp.send("director="+director+"&year="+year+"&language="+language+"&actors="+actors+"&description="+description+"&image="+image+"&web_lang="+web_lang+"&add=1");
  xhttp.send(fd);
}

let edit_form = document.getElementById('edit-form');
if (edit_form) {
  edit_form.addEventListener('submit',function (e) {
    e.preventDefault();
    let about = document.getElementById('about').value;
    let about1 = document.getElementById('about1').value;
    let info = document.getElementById('info1');
    if (about == '') {
      info.innerHTML = '<div class="noti error">About field cannot be empty!</div>';
    }else if (about1 == '') {
      info.innerHTML = '<div class="noti error">Le champ À propos ne peut pas être vide !</div>';
    }else{
      edit_about(about,about1);
    }
    e.preventDefault();
  })
}

function changeLang(lang) {
  let select = document.querySelectorAll('.nav-items select');
  select[0].value = lang;
  let current = document.getElementsByClassName(lang);
  let other;
  
  if (lang == 'en') {
    other = document.getElementsByClassName('fr');
    
  } else {
    other = document.getElementsByClassName('en');
  }
  for (let i = 0; i < current.length; i++) {
    current[i].style.display = 'inline-block';
  }
  for (let j = 0; j < other.length; j++) {
    other[j].style.display = 'none';
  }
  localStorage.setItem('lang',lang);
  if (page == 1) {
    show_films(lang);
  }
  console.log(this.value);
}

function redirect() {
    window.location = 'index.php';
}

lang = localStorage.getItem('lang');
if (lang != null) {
  changeLang(lang);
  if (page == 2) {
    setTimeout(() => {
      changeLang(lang);
    }, 1000);
  }
}