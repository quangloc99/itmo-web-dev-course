<?php
$meme_id = file_get_contents('https://imgflip.com/ajax_img_flip?current_iid=0');
$url = 'https://imgflip.com/' . $meme_id;
$page = file_get_contents($url);

echo $page;
