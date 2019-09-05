<?php 
function stupid_safe_file_get_contents($url) {
  $data = file_get_contents($url);
  if ($data !== false) return $data;

  // Well, you may judge me, but this script will run on the server
  // which is not mine, and I cannot do anythings :(.
  // I have tried using file_get_contents above, which will return false on this server.
  // I found out that allow_url_fopen is true, but openssl is not installed. 
  // I have tried using curl, and got the same result, curl is not installed.
  // So, I think this hack will do the works :))).

  return shell_exec('./wget --no-check-certificate -qO - ' . $url . ' 2>&1');
}

//phpinfo();
$meme_id = stupid_safe_file_get_contents('https://imgflip.com/ajax_img_flip?current_iid=0');
$url = 'https://imgflip.com' . $meme_id;
$page = stupid_safe_file_get_contents($url);

echo $page;
