<?php

function connect($action, $string){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://cis3760f23-08.socs.uoguelph.ca./api.php');
    $request = 'action='.$action.'&'.$action.'='.$string;
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET' );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $result = curl_exec($ch);
    
    //foreach ($arr as &$value)
    curl_close($ch);
    return $result;

    
}


$string = json_decode($_GET['data']);
echo ( connect($string->action, $string->body) );


?>