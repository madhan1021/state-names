<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__.'/vendor/autoload.php';

$generalFunction = new \STATENAME\Common\GeneralFunctions;
if ($generalFunction->addCORHeaders()) {
  exit();
}
$generalFunction->addGeneralHeaders();

switch (true){
    case (isset($_GET['stname']) && $_GET['stname']);
      $data = file_get_contents('php://input');
      $postdata = json_decode($data);
      // var_dump($postdata);
      $stn= new \STATENAME\Master\User();
      echo  json_encode($stn->STN ($postdata));
      break;



  case (isset($_GET['table']) && $_GET['table']);
    $data = file_get_contents('php://input');
    $postdata = json_decode($data);
    // var_dump($postdata);
    $tab= new \STATENAME\Master\User();
    echo  json_encode($tab->TABLE($postdata));
        break;

  case (isset($_GET['edit']) && $_GET['edit']);
    $data = file_get_contents('php://input');
    $postdata = json_decode($data);
    // var_dump($postdata);
    $edit= new \STATENAME\Master\User();
    echo  json_encode($edit->EDIT($postdata));
    break;
      
  case (isset($_GET['remove']) && $_GET['remove']);
    $data = file_get_contents('php://input');
    $postdata = json_decode($data); 
    
    $remove= new \STATENAME\Master\User();
    echo  json_encode($remove->REMOVE($postdata));
    break;

  default :
    header($_SERVER['SERVER_PROTOCOL']." 404 Not Found", false, 404); // HTTP/1.1 404 Not Found
    die();
}
?>
