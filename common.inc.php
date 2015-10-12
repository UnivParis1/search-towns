<?php

function GET_or($name, $default) {
    return isset($_GET[$name]) ? $_GET[$name] : $default;
}
function GET_or_NULL($name) {
    return GET_or($name, NULL);
}

function echoJson($o) {

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
    }
   
  header('Content-type: application/json; charset=UTF-8');
  if (isset($_GET["callback"]))
    echo $_GET["callback"] . "(" . json_encode($o) . ");";
  else
    echo json_encode($o);  
}

function fatal($msg) {
   header("HTTP/1.0 400 $msg");
   echoJson(array("error" => $msg));
   exit(0);
}
