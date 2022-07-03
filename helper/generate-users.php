<?php

session_start();

require_once(__DIR__ . '/../config.php');

require(ABSPATH . 'db.php');

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != "admin"){
    header('Location: ../login.php');
    exit();
}

$names = array(
    'Johnathon',
    'Anthony',
    'Erasmo',
    'Raleigh',
    'Nancie',
    'Tama',
    'Camellia',
    'Augustine',
    'Christeen',
    'Luz',
    'Diego',
    'Lyndia',
    'Thomas',
    'Georgianna',
    'Leigha',
    'Alejandro',
    'Marquis',
    'Joan',
    'Stephania',
    'Elroy',
    'Zonia',
    'Buffy',
    'Sharie',
    'Blythe',
    'Gaylene',
    'Elida',
    'Randy',
    'Margarete',
    'Margarett',
    'Dion',
    'Tomi',
    'Arden',
    'Clora',
    'Laine',
    'Becki',
    'Margherita',
    'Bong',
    'Jeanice',
    'Qiana',
    'Lawanda',
    'Rebecka',
    'Maribel',
    'Tami',
    'Yuri',
    'Michele',
    'Rubi',
    'Larisa',
    'Lloyd',
    'Tyisha',
    'Samatha',
    'Mischke',
    'Serna',
    'Pingree',
    'Mcnaught',
    'Pepper',
    'Schildgen',
    'Mongold',
    'Wrona',
    'Geddes',
    'Lanz',
    'Fetzer',
    'Schroeder',
    'Block',
    'Mayoral',
    'Fleishman',
    'Roberie',
    'Latson',
    'Lupo',
    'Motsinger',
    'Drews',
    'Coby',
    'Redner',
    'Culton',
    'Howe',
    'Stoval',
    'Michaud',
    'Mote',
    'Menjivar',
    'Wiers',
    'Paris',
    'Grisby',
    'Noren',
    'Damron',
    'Kazmierczak',
    'Haslett',
    'Guillemette',
    'Buresh',
    'Center',
    'Kucera',
    'Catt',
    'Badon',
    'Grumbles',
    'Antes',
    'Byron',
    'Volkman',
    'Klemp',
    'Pekar',
    'Pecora',
    'Schewe',
    'Ramage'
);

foreach($names as $k => $name){

    $email = strtolower($name) . '@gmail.com';

    $password = password_hash("protector994!", PASSWORD_DEFAULT);

    $role = "user";

    $dateTime = date('Y-m-d H:i:s');

    $sql = "INSERT INTO users(name, email, password, role, last_login, created, updated) 
            VALUES('$name', '$email', '$password', '$role', '$dateTime', '$dateTime', '$dateTime')";

    $conn->query($sql);
}

$conn->close();