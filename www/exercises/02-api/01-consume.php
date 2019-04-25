<pre>
<?php

$url = 'https://randomuser.me/api/';
$file_content = file_get_contents($url);

var_dump($file_content);

$person = json_decode($file_content);

var_dump($person);
