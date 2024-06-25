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
              <li><a href="/wyszukiwarka" id="active">Wyszukiwarka</a></li>
              <li><a href="/galery">Galeria</a></li>
              <li><a href="/wybrane">Wybrane zdjecia</a></li>
              <li><a href="/add_foto_form">Dodawanie</a></li>
              <?php if($loged == false):?>
                <li><a href="/logowanie">Logowanie</a></li>
              <?php else:?>
                <li><a href="/wyloguj">Wyloguj</a></li>
              <?php endif?>
            </ol>
        </nav>
        <script type="text/javascript">
          var req;

          function encodeRFC5987ValueChars (str) {
            return encodeURIComponent(str).replace(/['()]/g, escape).replace(/\*/g, '%2A').replace(/%(?:7C|60|5E)/g, unescape);
          }

          function validate() {
            //odczytanie parametru z formularza
            var nameField = document.getElementById("name");
            //utworzenie ciągu-do kogo wysyłam+parametr wysyłany dodatkowo zakodowany aby przeszły polskie ogonki
            var url = "/wyszukiwarka_search?name=" + encodeRFC5987ValueChars(escape(nameField.value));
            
            //utworzenie obiektu żądania asynchronicznego w przeglądarce
            if (window.XMLHttpRequest) {
                req = new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            }
            req.onreadystatechange = callback;  //przypięcie funkcji zwrotnej wykonywanej po otrzymaniu odpowiedzi
            req.open("GET", url, true);
            req.send();   //wysłanie żądania
          }


          //funkcja zwrtona
          /* req.readyState Holds the status of the XMLHttpRequest.
            0: request not initialized
            1: server connection established
            2: request received
            3: processing request
            4: request finished and response is ready
          */
          function callback() {
              if (req.readyState == 4) {
                  if (req.status == 200) {
                  // możemy czytać z req.responseXML - gdy serwer ustawił odpowiedź jako XML w nagłówkach ;
                  // lub req.responseText jeżeli serwer odsyła nam tekst -domyślnie;
                  var result = req.response;
                  setMessage(result);
                  }
              }
          }

          //funkcja odpowiedzialna za umieszczenie w stronie nadesłanej odpowiedzi lub 
          //dokonanie odpowiedniej modyfikacji drzewa DOM  w zależności od otrzymanej wartości odpowiedzi

          function setMessage(message) {
              var searchResultElement = document.getElementById("result");   
              searchResultElement.innerHTML = message;
          }

          </script>
        </header>
        <section id="content" class="content">
          <h1 class="title">Wyszukiwarka</h1>
            <div class="div">
              <form class="search">
                <input type="text"   size="50"  id="name"   name="name" onkeyup="validate();"  >            
              </form>
            </div>
            <div id="result"></div>
        </section>
        <footer id="footer" class = "footer"> <div class = "podpis">Vincenzo Piras</div>
          <a href ="#" class = "powrot">
            <div class="przycisk_powrotu">Powrót</div>
          </a>
        </footer>
    </body>
</html>