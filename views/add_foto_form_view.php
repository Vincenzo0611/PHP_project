<!DOCTYPE html>
<html lang="pl">
    <head>
		<meta charset="UTF-8" lang="pl">
    <title>Kuchnia włoska</title>
    <?php include "includes/head.inc.php"; ?>
	</head>
  <body>
    <header id="header" class = "header">
      <div id="home"><a href="/" class="kolor">HOME</a></div>
      <nav>
      <ol>
            <li><a href="/wyszukiwarka">Wyszukiwarka</a></li>
            <li><a href="/galery">Galeria</a></li>
            <li><a href="/wybrane">Wybrane zdjecia</a></li>
            <li><a href="/add_foto_form" id="active">Dodawanie</a></li>
            <?php if($loged == false):?>
              <li><a href="/logowanie">Logowanie</a></li>
            <?php else:?>
              <li><a href="/wyloguj">Wyloguj</a></li>
            <?php endif?>
          </ol>
      </nav>
    </header>
        <section id="content" class="content">
          <h1 class = "title">Dodaj zdjęcie</h1>
          <hr class="separator_rounded_kon1">
          <br><br>
          <?php if(isset($added) && $added == 1):?>
          <div class = "alert">
            Zdjęcie pomyślnie przesłane
          </div>
          <br>
          <?php endif;?>
          <?php if(isset($added) && $added == 0):?>
          <div class = "alert">
            Zdjęcie nie zostało przesłane
          </div>
          <br>
          <?php endif;?>
          <form method="post" enctype="multipart/form-data" action="/add_foto">
            <fieldset>
              <label for="foto">Zdjęcie</label>
              <input type="file" id= "foto"name="foto" required>
              <label for="water">Znak wodny</label>
              <input type="text" name="water" id="water" maxlength = "15" required>
              <label for="title">Tytuł</label>
              <input type="text" name="title" id="title" maxlength = "50" required>
              <label for="author">Autor</label>
              <input type="text" name="author" id="author" maxlength = "30" required
              <?php 
                if($loged)
                {
                    $user = get_element_by_id('users', $_SESSION['id']);
                    echo 'value="'. $user['login'] . '"';
                }
              ?>>
              <?php if($loged):?>
                <label for ="public">Publiczne</label>
                <input id="public" type="radio" value="public" name="view" required>
                <label for ="private">Prywatne</label>
                <input id="public" type="radio" value="private" name="view" required>
              <?php endif?>
            </fieldset>
            <input class = "button" type="submit" value="Wyślij zdjęcie">
            <input class = "button" type="reset">
          </form>



        </section>
        <footer id="footer" class = "footer"> <div class = "podpis">Vincenzo Piras</div>
          <a href ="#" class = "powrot">
            <div class="przycisk_powrotu">Powrót</div>
          </a>
        </footer>
    </body>
    <script>
        var Uploadfoto = document.getElementById("foto");
        var bool = false;
        Uploadfoto.onchange = function(){
          if(this.files[0].size > 1048576){
            alert("File is too big");
            bool = true;
          };
          var type = (this.value.substr(this.value.lastIndexOf(".") + 1, this.value.length)).toLowerCase();
          console.log(type);
          if(type != "png" && type != "jpg"){
            alert("Wrong type file, only png and jpg accpeted");
            this.value = "";
          };
          if(bool === true)
          {
            this.value ="";
            bool = false;
          }
        };
    </script>
</html>