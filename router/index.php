<?php
$url = '';
if (isset($_POST['mission'])) {
    $url = explode('/', $_POST['mission']);
}

if ($url == 'Bulgarian Umbrella') {
    require 'page.php';
}
