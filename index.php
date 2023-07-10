<?php
require 'vendor/autoload.php';
$f3 = Base::instance();
$base_url = $f3->get('BASE');
$f3->set('AUTOLOAD', 'app/');
$arbo = new \arborescence('files');
$f3->set('arbo', $arbo);
session_start();
$f3->route(
    'GET /',
    function ($f3) {
        $islog = $f3->get('SESSION.logged');
        echo Template::instance()->render('templates/login.html');

    }
);
$f3->route(
    'POST /login',
    function ($f3) {
        //var_dump($f3->POST);
        $db = new \DB\Jig('data/');
        $user = new \DB\Jig\Mapper($db, 'users');
        $auth = new \Auth($user, array('id' => 'username', 'pw' => 'password'));
        $login_result = $auth->login($f3->POST["login"], md5($f3->POST["password"]));
        if ($login_result) {
            $f3->set('SESSION.logged', true);
            echo Template::instance()->render('templates/index.html');

        } else {
            $f3->reroute("/");
        }
    }
);
$f3->route(
    'GET /logout',
    function ($f3) {
        session_destroy();
        echo Template::instance()->render('templates/login.html');
    }
);
$f3->route(
    'GET /fichiers',
    function ($f3) {
        $arbo = $f3->get('arbo');
        $islog = $f3->get('SESSION.logged');
        if ($islog) {
            $fileList = $arbo->charge();
            $f3->set('files', $fileList);
            echo Template::instance()->render('templates/listfich.html');
        } else {
            echo Template::instance()->render('templates/login.html');
        }
    }
);
$f3->route(
    'POST /supprime',
    function ($f3) {
        $islog = $f3->get('SESSION.logged');
        if ($islog) {
            $result = unlink("files/" . $f3->POST['Name']);
            if ($result) {
                $f3->set('message', array('texte' => 'Fichier supprimé', 'style' => 'message_reussite'));
                $arbo = $f3->get('arbo');
                $fileList = $arbo->charge();
                $f3->set('files', $fileList);
                echo Template::instance()->render('templates/listfich.html');
            } else {
                $f3->set('message', array('texte' => 'Erreur lors de la suppression', 'style' => 'message_erreur'));
                echo Template::instance()->render('templates/listfich.html');
            }
        } else {
            echo Template::instance()->render('templates/login.html');
        }
    }
);
$f3->route(
    'GET /telecharge',
    function ($f3) {
        $islog = $f3->get('SESSION.logged');
        if ($islog) {
            $f3->set('SESSION.message', array('texte' => '', 'style' => 'message_reussite'));
            echo Template::instance()->render('templates/telecharger.html');
        } else {
            echo Template::instance()->render('templates/login.html');
        }
    }
);
$f3->route(
    'POST /chargef',
    function ($f3) {
        $islog = $f3->get('SESSION.logged');
        if ($islog) {
            if (isset($f3->FILES['fichier'])) {
                $nfich = $f3->FILES['fichier'];
                if ($nfich['name'] != "") {
                    move_uploaded_file($nfich['tmp_name'], "files/" . $nfich["name"]);
                    $f3->set('SESSION.message', array('texte' => 'Le fichier a été chargé', 'style' => 'message_reussite'));
                    $f3->reroute('/fichiers');
                } else {
                    $f3->set('SESSION.message', array('texte' => 'Pas de fichier choisi', 'style' => 'message_erreur'));
                    echo Template::instance()->render('templates/telecharger.html');
                }

            }
        } else {
            echo Template::instance()->render('templates/login.html');
        }
    }
);
$f3->route(
    'GET /apropos',
    function ($f3) {
        echo Template::instance()->render('templates/apropos.html');
    }
);
$f3->run();