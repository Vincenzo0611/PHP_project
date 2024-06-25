<?php
  //  if(!isset($_SESSION))
  //    session_start();
  //  if(isset($_SESSION['id']) && !empty($_SESSION['id']))
   //   $loged = true;
   // else
  //    $loged= false;
?>
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
                <li><a href="/galery" id="active">Galeria</a></li>
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
        <div id="content" class="content">
            <form method="post" action="/zapisz_wybor" >
                <div id="gal">
                    <?php 
                        if(!isset($end))
                        {
                            foreach ($photos as $photo): ?>
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
                                        if($photo['view'] == 'private')
                                        echo '<h4 class = "litle_title">PRYWATNE</h4><br>';
                                    ?>
                                    <input type="checkbox" name="name[]" value=
                                    <?php 
                                        echo '"'.$photo['_id'].'"';
                                        
                                        if(isset($_SESSION['cart']))
                                        {
                                            for($i = count($_SESSION['cart']) - 1; $i >= 0; $i--)
                                            {
                                                if($_SESSION['cart'][$i] == $photo['_id'])
                                                    echo 'checked';
                                            }
                                        }
                                    ?>
                                    >
                                </div>
                        <?php endforeach;
                        }
                        else
                            echo '<h1 class="title">Brak zdjęć</h1>';
                        ?>
                </div>
                <div class="pagination">
                    <a href=
                    <?php
                        echo '/galery?page='.$page.'&page_edit=2';
                    ?>
                    >&laquo;</a>
                    <a href="#"><?php echo $page+1 ?></a>
                    <a href=
                    <?php
                        echo '/galery?page='.$page.'&page_edit=1';
                    ?>
                    >&raquo;</a>
                </div>
                <?php if(!isset($end)): ?>
                <input class = "button" type="submit" name="add_to_cart" value="Zapamiętaj wybrane"/>
                <?php endif ?>
            </form>
        </div>
        <footer id="footer" class = "footer"> <div class = "podpis">Vincenzo Piras</div>
          <a href ="#" class = "powrot">
            <div class="przycisk_powrotu">Powrót</div>
          </a>
        </footer>
    </body>
</html>