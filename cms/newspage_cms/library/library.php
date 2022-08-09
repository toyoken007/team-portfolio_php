<?php 
function h($value)
{
  return htmlspecialchars($value, ENT_QUOTES);
}

/* DBへの接続 */
function dbconnect() {
    // $db = new mysqli('mysql206.phy.lolipop.lan', 'LAA1430303', '1986', 'LAA1430303-heartoyo1');
    $db = new mysqli('localhost', 'root', 'root', 'demosite_hear_toyo');

    if (!$db) {
      die($db->error);
    }

    return $db;
}