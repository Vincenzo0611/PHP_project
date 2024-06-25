<!DOCTYPE html>
<html lang="pl">
    <head>
		<meta charset="UTF-8" lang="pl">
    <title>Kuchnia włoska</title>
		<?php include "includes/head.inc.php"; ?>
	</head>
    <body>
      <header id="header" class = "header">
        <div id="home"><a href="/" id="active" class="kolor">HOME</a></div>
        <nav>
          <ol>
            <li><a href="/wyszukiwarka">Wyszukiwarka</a></li>
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
      </header>
        <section id="content" class="content">
          <h1 class="title">KUCHNIA WŁOSKA</h1>
          <p class = "paragraf">Kuchnia włoska - jedna z dwóch najbardziej popularnych kuchni europejskich obok kuchni francuskiej.</p>
          <hr class = "separator_rounded">
          <p class = "paragraf">Kuchnia włoska charakteryzuje się korzystaniem z dużej ilości warzyw i przypraw takich jak oregano, bazylia, pieprz, estragon, tymianek, rozmaryn, a także używaniem parmezanu. W kuchni tej dość powszechnie stosuje się też oliwę, pomidory oraz cebulę i czosnek, a także oliwki. Kuchnia włoska wyspecjalizowała się szczególnie w potrawach mącznych oraz w rybnych i owocach morza. Charakterystyczną cechą kuchni włoskiej jest przygotowywanie dań świeżych ze składników dostępnych w okolicy, o danej porze roku. Włosi pod względem zasad kulinarnych są bardzo przywiązani do swojej tradycji. W kuchni włoskiej nie ma miejsca na ustępstwa pod względem jakości składników lub dodatków. Pewną tradycją jest także stała w całych Włoszech pora spożywania poszczególnych posiłków w ciągu dnia. </p>
          <hr class = "separator_rounded">
          <p class = "paragraf">Kuchnia włoska jest bardzo różnorodna. Na północy je się ryż i polentę, częściej stosuje się masło, na południu przeważają niezliczone gatunki makaronów i oliwa. Każdy z 20 regionów oraz wiele miast mają swoje kulinarne specjały. Emilia-Romania to ojczyzna faszerowanych pierożków, Sycylia i Siena słyną z deserów, rejon Dolina Aosty z fondue, Florencja szczyci się befsztykiem i wieloma innymi daniami mięsnymi, Turyn kurczakami, Bolonia sosem mięsnym (bolognese), a Neapol – tradycyjną pizzą.</p>
          <hr class = "separator_rounded">
          <p class = "paragraf">Wiele potraw takich jak spaghetti, pizza i risotto stało się bardzo popularne najpierw w USA, a potem razem z "eksportem" kultury amerykańskiej w większości państw przemysłowych, od Korei po Argentynę.</p>
          <hr class = "separator_rounded">
          <p class = "paragraf">Tradycyjny posiłek włoski składa się z <span lang="it">antipasto</span> (przystawka), <span lang="it">primo piatto</span> (zazwyczaj pasta lub inne danie mączne, zupa); <span lang="it">secondo piatto</span>: główne danie to ryby, mięso albo drób wzbogacone sałatką. Taki posiłek zakończony jest deserem, np. panna cotta lub tiramisu.</p>
          <hr class = "separator_rounded">
          <h3 class = "subtitle">Historia</h3>
          <p class = "paragraf">Kuchnia włoska rozwijała się na przestrzeni wieków, sięgając swoich początków czasów starożytnych. Chociaż Włochy jako państwo zjednoczyły się dopiero w XIX wieku to kuchnia tego kraju ma swoje korzenie już w IV wieku p.n.e. Powstała dzięki historycznym wpływom kulturowym sąsiednich regionów, licznych narodów, które w przeszłości zamieszkiwały teren Włoch oraz nowo odkrytych terenów (kraje Nowego Świata).</p>
          <hr class = "separator_rounded">
          <p class = "paragraf">W epoce renesansu we Włoszech umiejętność przygotowywania różnych potraw została podniesiona do rangi sztuki. <span lang="it">Bartolomeo Platina</span>, włoski pisarz i bibliotekarz w Bibliotece Watykańskiej, stworzył pierwszą wydrukowaną książkę kucharską <span lang = "it">"De honesta voluptate et valetudine"</span>. Zawarte w niej przepisy są autorstwa <span lang="it">Martina da Como</span>. Po raz pierwszy dzieło ukazało się w Rzymie. Florenccy kupcy natomiast przeznaczali ogromne pieniądze na zakładanie szkół sztuki kulinarnej.</p>
          <hr class = "separator_rounded">
          <p class = "paragraf">Dziś kuchnia włoska popularna jest na całym świecie, a tradycyjne włoskie potrawy wchodzą powoli w kulturę innych państw.</p>
        </section>
        <footer id="footer" class = "footer"> <div class = "podpis">Vincenzo Piras</div>
          <a href ="#" class = "powrot">
            <div class="przycisk_powrotu">Powrót</div>
          </a>
        </footer>
    </body>
</html>
