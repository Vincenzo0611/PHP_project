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
                <li><a href="/wybrane" id="active" >Wybrane zdjecia</a></li>
                <li><a href="/add_foto_form">Dodawanie</a></li>
                <?php if($loged == false):?>
                <li><a href="/logowanie">Logowanie</a></li>
                <?php else:?>
                <li><a href="/wyloguj">Wyloguj</a></li>
                <?php endif?>
            </ol>
        </nav>
        </header>
        <div id="content" class="content">
            <form method="post" action="/usun_wybor" >
                <div id="gal">
                    <?php 
                        if(empty($_SESSION['cart']))
                            echo '<h1 class="title">Brak wybranych</h1>';
                        else
                        {
                            $numberinsession = count($_SESSION['cart']);
                            for($i = 0; $i < $numberinsession; $i++)
                            {
                                $photo = get_element_by_id('photos', $_SESSION['cart'][$i]);
                            ?>
                                    <div class="gallery">
                                        <a target="_blank" href="
                                            <?php 
                                                echo $photo['watermark']. '">';
                                                echo '<img src="';
                                                echo $photo['mini'] . '"';
                                            ?>
                                            alt="Photo">
                                        </a>
                                    </div>
                                    <div>
                                        Tytuł: 
                                        <?php
                                            echo $photo['title'].'<br>Autor: ';
                                            echo $photo['author'].'<br><br>';
                                        ?>
                                        <input type="checkbox" name="name[]" value=
                                        <?php 
                                            echo '"'.$photo['_id'].'"';
                                        ?>
                                        >
                                    </div>
                                <?php 
                            }
                        }
                    ?> 
                </div>
                <?php if(!empty($_SESSION['cart'])):?>
                <input class = "button" type="submit" name="delete_from_cart" value="Usuń zaznaczone z zapamiętanych"/>
                <?php endif?>
            </form>
        </div>
        <footer id="footer" class = "footer"> <div class = "podpis">Vincenzo Piras</div>
          <a href ="#" class = "powrot">
            <div class="przycisk_powrotu">Powrót</div>
          </a>
        </footer>
    </body>
</html>