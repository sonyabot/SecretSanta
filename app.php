<?php

require_once('SecretSanta.php');

$api_key = (string)readline('API Key: ');
$file_path = (string)readline('Enter your santa list filepath');
$santa = new SecretSanta($api_key, $file_path);
$santa->run();
