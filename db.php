<?php
	$connection = mysqli_connect('localhost', 'root', 'root', 'task');

    if ($connection == false) {
        echo 'Не удалось подключиться к БД';
        echo mysqli_connect_error();
        exit();
    }

    session_start();
