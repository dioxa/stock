<?php
$url = 'http://finance.yahoo.com/q?s=msft';
        
$start = '<div class="title"><h2>';
$finish = '</span></span></div><div>';

$dsn = 'mysql:dbname=main;host=127.0.0.1:3300';
$user = ;
$pass = ;
$PDO = new PDO($dsn, $user, $pass); 
 
function parse($name, $start,$finish) {
  $position = strpos($name, $start);
 
  $name = substr($name, $position);
  $position = strpos($name, $finish);
  
  $name = substr($name, 0, $position);
  $name = strip_tags($name);

  $position = "";
  return $name;
} 

  $content = file_get_contents($url);  
  $position = strpos($content, $start);
 
  $content = substr($content, $position);
  $position = strpos($content, $finish);
  
  $content = substr($content, 0, $position);
  $info[] = substr(parse($content, '<div class="title"><h2>', '</h2> <span class="rtq_exch">'), 0 ,-6);
  $info[] = substr(parse($content, '<div class="title"><h2>', '</h2> <span class="rtq_exch">'), -5, 4);
  $info[] = substr(parse($content, '<span class="rtq_dash">-</span>', '</span><span class="wl_sign">'), 1);
  $info[] = parse($content, '<div> <span class="time_rtq_ticker">', '</span></span>');
  $info[] = date("Y-m-d");

  echo $info[0]. ' ' . $info[1]. ' ' . $info[2]. ' ' . $info[3]. ' ' . $info[4];
  
  $stmt = $PDO->prepare("INSERT INTO stock_info(name, subname, market, price, date) VALUES (:name, :subname, :mark, :pric, :date)");
  $stmt->bindParam(':name',$info[0]);
  $stmt->bindParam(':subname',$info[1]);
  $stmt->bindParam(':mark',$info[2]);
  $stmt->bindParam(':pric',$info[3]);
  $stmt->bindParam(':date',$info[4]);
  $stmt->execute();

?>