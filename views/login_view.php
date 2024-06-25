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
                <li><a href="/add_foto_form">Dodawanie</a></li>
                <?php if($loged == false):?>
                <li><a href="/logowanie" id="active">Logowanie</a></li>
                <?php else:?>
                <li><a href="/wyloguj">Wyloguj</a></li>
                <?php endif?>
            </ol>
        </nav>
        </header>
        <section id="content" class="content">
            <?php if(isset($zalogowano)):?>
                <div class = "alert">
                    <?php echo $error_msg?>
                </div>
                <br>
            <?php endif;?>
            <?php if(!isset($zalogowano)):?>
            <div class="center in-row content">

                <!-- Okno logowania -->
                <div class="form-container">

                    <!-- LEWY box -->
                    <div class="box">  
                        
                            <form action="/rejestruj" method="post">

                                <!-- Tytuł -->
                                <div class="in-row form-input-sep form-title">
                                    Rejestracja nowego konta
                                </div>

                                <?php if(isset($error_msg_re)):?>
                                <div class = "alert">
                                <?php echo $error_msg_re?>
                                </div>
                                <br>
                                <?php endif;?>
                            
                                <!-- Nazwa użytkownika / login -->
                                <div class="in-row form-input-sep">
                                    <div class="logon-icon-box"><img src="static/img/logon-icon-user.png" alt="User" class="logon-icon"></div>
                                    <div class="form-input-box width-250">
                                        <input type="text" name="username" class="form-input width-250" maxlength="16 required placeholder="Login">
                                    </div>                        
                                    <div class="logon-icon-box"></div>
                                </div>

                                <!-- E-mail -->
                                <div class="in-row form-input-sep30">
                                    <div class="logon-icon-box"><img src="static/img/logon-icon-user.png" alt="User" class="logon-icon"></div>
                                    <div class="form-input-box width-350">
                                        <input type="email" name="email" class="form-input width-350" maxlength="200" placeholder="Adres e-mail">
                                    </div>                        
                                    <div class="logon-icon-box"></div>
                                </div>

                                <!-- Hasło -->
                                <div class="in-row form-input-sep30">
                                    <div class="logon-icon-box"><img src="static/img/logon-icon-pass.png" alt="Password" class="logon-icon"></div>
                                    <div class="form-input-box width-250">
                                        <input type="password" name="password" class="form-input width-250" maxlength="32" required placeholder="Hasło">
                                    </div>
                                </div>        
                                
                                <!-- Hasło -->
                                <div class="in-row form-input-sep30">
                                    <div class="logon-icon-box"><img src="static/img/logon-icon-pass.png" alt="Password" class="logon-icon"></div>
                                    <div class="form-input-box width-250">
                                        <input type="password" name="passwordre" class="form-input width-250" maxlength="32" required placeholder="Powtórz hasło">
                                    </div>
                                </div>  

                                <!-- Submit -->
                                <div class="in-row">
                                    <div class="logon-icon-box"></div>
                                    <div class="form-input-box">
                                        <input type="submit" value="Rejestruj" class="form-submit width-120">
                                        <input type="button" value="Anuluj" class="form-button width-100">
                                    </div>
                                    <div class="logon-icon-box"></div>
                                </div>

                            </form>
                    </div>
                        
                            
            <!-- PRAWY box -->
            <div class="box">
                
                <!-- Formularz logowania + przypomnienie hasła -->
                <div class="form-box">

                    <!-- Logowanie -->
                    <form action="/login" method="post">

                        <div class="in-row form-input-sep form-title">
                            Logowanie
                        </div>
                    
                        <?php if(isset($error_msg)):?>
                        <div class = "alert">
                        <?php echo $error_msg?>
                        </div>
                        <br>
                        <?php endif;?>

                        <div class="in-row form-input-sep">
                            <div class="logon-icon-box"><img src="static/img/logon-icon-user.png" alt="User" class="logon-icon"></div>
                            <div class="form-input-box">
                                <input type="text" name="username" class="form-input" maxlength="16" required placeholder="Login">
                            </div>
                        </div>

                        <div class="in-row form-input-sep">
                            <div class="logon-icon-box"><img src="static/img/logon-icon-pass.png" alt="Password" class="logon-icon"></div>
                            <div class="form-input-box">
                                <input type="password" name="password" class="form-input" maxlength="16" required placeholder="Hasło">
                            </div>
                        </div>

                        <div class="in-row form-input-sep">
                            <div class="logon-icon-box"></div>
                            <div class="form-input-box">
                                <input type="submit" value="OK" class="form-submit">    
                            </div>
                        </div>

                    </form>
                        
                    </div>

                </div>

            </div>
            <?php endif;?>
        </section>
        <footer id="footer" class = "footer"> <div class = "podpis">Vincenzo Piras</div>
          <a href ="#" class = "powrot">
            <div class="przycisk_powrotu">Powrót</div>
          </a>
        </footer>
    
    </body>
</html>
