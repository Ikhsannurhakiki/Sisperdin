<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'sisperdin');

$konek = new mysqli(HOST, USER, PASS, DB) or die('Connection Error to the Database');
