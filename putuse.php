<?php
require 'vendor/autoload.php';
$f3 = Base::instance();
$db = new \DB\Jig('data/');
$pass = md5('123');
$users = array(
    0 => array('username' => 'admin', 'password' => $pass),
);
$db->write('users', $users);
$db->read('users');