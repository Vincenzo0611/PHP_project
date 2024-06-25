<?php
    require_once 'business.php';

    function add_foto(&$model)
    {
        if(isset($_SESSION['id']) && !empty($_SESSION['id']))
            $loged = true;
        else
            $loged= false;

        $model['loged'] = $loged;
        $image_name = basename($_FILES['foto']['name']);
        $image_type = $_FILES['foto']['type'];
        $water = $_POST['water'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $number = 0;
        $image_name_test = $image_name;
        while(file_exists("images/photo/" . $image_name_test))
        {
            $number = $number + 1;
            $image_name_test = $number . $image_name;
        }
        $image_name = $image_name_test;
        $uploaddir = "images/photo/" . $image_name;
        if(move_uploaded_file($_FILES['foto']['tmp_name'], $uploaddir))
        {
            if($image_type == "image/jpeg")
            {
                $im = imagecreatefromjpeg($uploaddir);
                $ima = imagecreatefromjpeg($uploaddir);
            };
            if($image_type == "image/png")
            {
                $im = imagecreatefrompng($uploaddir);
                $ima = imagecreatefrompng($uploaddir);
            };
    
            $x = imagesx($im);
            $y = imagesy($im);
            $stamp = imagecreatetruecolor($x, $y);
            $black = imagecolorallocate($im, 0, 0, 0);
            imagesavealpha($stamp, true);
            $color = imagecolorallocatealpha($stamp, 0, 0, 0, 127);
            imagefill($stamp, 0, 0, $color);
            $x_string = 100;
            $y_string = 100;
            while($y_string < $y)
            {
                while(($x_string + strlen($water)) < $x)
                {
                    imagestring($stamp, 5, $x_string, $y_string, $water, $black);
                    $x_string = $x_string + 200;
                }
                $x_string = 100;
                $y_string = $y_string + 100;
                }
            imagecopy($im, $stamp, 0, 0, 0, 0, $x, $y);
            imagepng($im , 'images/watermark/' . $image_name);
            imagedestroy($im);
            $scale_image = imagecreatetruecolor(200, 125);
            imagecopyresampled($scale_image, $ima, 0, 0, 0, 0, 200, 125, $x, $y);
            imagepng($scale_image , 'images/mini/' . $image_name);
            imagedestroy($ima);
            imagedestroy($scale_image);
    
            if($loged)
            {
                $view = $_POST['view'];
                $photo = [
                    'name' => $image_name,
                    'mini' => 'images/mini/' . $image_name,
                    'watermark' => 'images/watermark/' . $image_name,
                    'title' => $title,
                    'author' => $author,
                    'view' => $view,
                    'id_user' => $_SESSION['id']
                ];
            }
            else
            {
                $view = 'public';
                $photo = [
                    'name' => $image_name,
                    'mini' => 'images/mini/' . $image_name,
                    'watermark' => 'images/watermark/' . $image_name,
                    'title' => $title,
                    'author' => $author,
                    'view' => $view,
                    'id_user' => []
                ];
            }
    
            add_element($photo, 'photos');
    
            $added = 1;
    
        }
        else
        {
            $added = 0;
        }

        $model['added'] = $added;

        return 'add_foto_form_view';
    }
    function galery(&$model)
    {
        if(isset($_SESSION['id']) && !empty($_SESSION['id']))
            $loged = true;
        else
            $loged= false;
        if(!empty($_GET['page_edit']))
        {
            $page = $_GET['page'];
            $page_edit = $_GET['page_edit'];
            if($page_edit === '1')
                $page = $_GET['page'] + 1;
            else if($page != 0)
                $page = $_GET['page'] - 1;
        }
        else
            $page = 0;

        $pageSize = 3;
        while(1){
            $opts = [
                'skip' => ($page) * $pageSize,                
                'limit' => $pageSize
            ];
            if($loged)
            {
                $query = [
                    '$or' => [
                        ['view' => 'public'],
                        ['id_user' => $_SESSION['id']]
                    ]
                ];
            }
            else
            {
                $query = [
                    'view' => 'public',
                ];
            }
            $photos = count_elements('photos', $query, $opts);
            if(!$photos)
            {
                if($page != 0)
                    $page = $page - 1;
                else
                {
                    $end = 1;
                    break;
                }
            }
            else
            {
                $photos = get_elements('photos', $query, $opts);
                break;
            }
        }

        $model['loged'] = $loged;
        $model['photos'] = $photos;
        $model['page'] = $page;
        if(isset($end))
            $model['end'] = $end;

        return 'galery_view';
    }

    function login(&$model)
    {
        $login = $_POST['username'];
        $password = $_POST['password'];
    
        $error_msg = "Zalogowano";
    
        $query = [
            'login' => $login,
        ];
        $result =  count_elements('users', $query, []);
        if($result)
        {  
            $result =  get_elements('users', $query, []); 
            foreach($result as $user)
            {
                // Sprawdzamy, czy hasło jest poprawne.
                if(!password_verify($password, $user['password']))
                {
                    $error_msg = "Niepoprawny login lub hasło";
                }
                else
                {
                    $zalogowano = 1;
                    session_regenerate_id();
                    $_SESSION['id'] = $user['_id'];
                    $_SESSION['login'] = $user['login'];
                }
            }
            
        }
        else {
            $error_msg = "Niepoprawny login lub hasło";
        }
        if(isset($_SESSION['id']) && !empty($_SESSION['id']))
            $loged = true;
        else
            $loged= false;

        $model['loged'] = $loged;
        if(isset($zalogowano))
            $model['zalogowano'] = $zalogowano;
        $model['error_msg'] = $error_msg;
        return 'login_view';
    }

    function rejestruj(&$model)
    {
        $login = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordre = $_POST['passwordre'];


        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $query = [
            'login' => $login,
        ];
        if($password == $passwordre)
        {
            $check_login =  count_elements('users', $query, []);
            if(!$check_login)
            {
                if($db = get_db())
                {
                    $user = [
                        'login' => $login,
                        'email' => $email,
                        'password' => $password_hash
                    ];

                    add_element($user, 'users');
                    $error_msg_re = "Pomyślnie zarejestrowany, zaloguj się";     
                }
            }
            else
            {
                $error_msg_re = "Zajęty login";
            }
        }
        else
        {
            $error_msg_re = "Dwa różne hasła";
        }

        $model['error_msg_re'] = $error_msg_re;
        $model['loged'] = false;

        return 'login_view';
    }

    function usun_wybor(&$model)
    {
        if(!isset($_SESSION['cart']))
            $_SESSION['cart'] = [];
        if(!empty($_POST['name']))
        {
            foreach($_POST['name'] as $id)
            {
                $j = count($_SESSION['cart']);
                for($i = 0; $i < $j; $i++)
                {
                    if($_SESSION['cart'][$i] == $id)
                    {
                        for($k = $i; $k < $j-1; $k++)
                        {
                            $_SESSION['cart'][$k] = $_SESSION['cart'][$k+1];
                        }
                        unset($_SESSION['cart'][$j-1]);
                        break;
                    }
                }
            }
        }

        return wybrane($model);
    }

    function wyloguj(&$model)
    {
        $_SESSION = [];
        session_destroy();
        $model['loged'] = false;
        return 'index_view';
    }

    function wyszukiwarka_search(&$model)
    {
        if(isset($_SESSION['id']) && !empty($_SESSION['id']))
            $loged = true;
        else
            $loged= false;
        function charset_utf_fix($string) {
    
            $utf = array(
                "%u0104" => "Ą",
            "%u0106" => "Ć",
            "%u0118" => "Ę",
            "%u0141" => "Ł",
            "%u0143" => "Ń",
            "%D3" => "Ó",
            "%u015A" => "Ś",
            "%u0179" => "Ź",
            "%u017B" => "Ż",
            "%u0105" => "ą",
            "%u0107" => "ć",
            "%u0119" => "ę",
            "%u0142" => "ł",
            "%u0144" => "ń",
            "%F3" => "ó",
            "%u015B" => "ś",
            "%u017A" => "ź",
            "%u017C" => "ż"
            );
            
            return str_replace(array_keys($utf), array_values($utf), $string);  
        }
        header ("content-type: text/html");
        header ("Cache-Control", "no-cache");
        
        echo '<div id="gal">';
    
        $name = $_GET['name'];
        $name_PL = charset_utf_fix($name);
    
        if (isset($name) && $name != '')
        {
            if($loged)
            {
                $query = [
                    '$and' => [
                        ['title' =>
                            ['$regex' => $name_PL, '$options' => 'i']],
                        ['$or' => [
                            ['view' => 'public'],
                            ['id_user' => $_SESSION['id']]
                            ]
                        ]
                    ]
                ];
            }
            else
            {
                $query = [
                    '$and' => [
                        ['title' =>
                            ['$regex' => $name_PL, '$options' => 'i']],
                            ['view' => 'public']
                    ]
                ];
            }
            if(count_elements('photos', $query, []) == 0)
                echo '<h1 class="title">Brak wyników</h1>';
            $photos = get_elements('photos', $query, []);
            foreach ($photos as $photo):?>
                <div class="gallery">
                    <a target="_blank" href=
                        <?php 
                            echo '"' . $photo['watermark']. '">';
                            echo '<img src="';
                            echo $photo['mini'] . '" alt="Photo">';
                        ?>
                    </a>
            </div>
        <?php endforeach;
        }
        else
        {
            echo '<h1 class="title">Brak wyników</h1>';
        }
        
        echo '</div>';
        return 'ajax';
    }

    function zapisz_wybor(&$model)
    {
        if(!isset($_SESSION['cart']))
            $_SESSION['cart'] = [];
        if(!empty($_POST['name']))
        {
            foreach($_POST['name'] as $id)
            {
                $j = count($_SESSION['cart']);
                for($i = 0; $i <= $j; $i++)
                {
                    if($i == $j)
                    {
                        $_SESSION['cart'][$i] = $id;
                        break;
                    }
                    if($_SESSION['cart'][$i] == $id)
                        break;
                }
            }
        }

        return galery($model);
    }
    function index(&$model)
    {
        if(isset($_SESSION['id']) && !empty($_SESSION['id']))
            $loged = true;
        else
            $loged= false;

        $model['loged'] = $loged;
        return 'index_view';
    }
    function add_foto_form(&$model)
    {
        if(isset($_SESSION['id']) && !empty($_SESSION['id']))
            $loged = true;
        else
            $loged= false;

        $model['loged'] = $loged;
        return 'add_foto_form_view';
    }

    function logowanie(&$model)
    {
        if(isset($_SESSION['id']) && !empty($_SESSION['id']))
            $loged = true;
        else
            $loged= false;

        $model['loged'] = $loged;
        return 'login_view';
    }

    function wyszukiwarka(&$model)
    {
        if(isset($_SESSION['id']) && !empty($_SESSION['id']))
            $loged = true;
        else
            $loged= false;

        $model['loged'] = $loged;
        return 'wyszukiwarka_view';
    }

    function wybrane(&$model)
    {
        if(isset($_SESSION['id']) && !empty($_SESSION['id']))
            $loged = true;
        else
            $loged= false;

        $model['loged'] = $loged;
        return 'wybrane_view';
    }
?>