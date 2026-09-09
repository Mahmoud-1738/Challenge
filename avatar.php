<?php
require 'vendor/autoload.php';

use LasseRafn\InitialAvatarGenerator\InitialAvatar;

$name = $_GET['name'] ?? '?';

$avatar = new InitialAvatar();
$image = $avatar->generate($name);

header('Content-Type: image/png');
echo $image->encode('png');