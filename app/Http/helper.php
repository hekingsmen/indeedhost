<?php
 
function getCurrentRouteName(){
    $routeName = \Request::route()->getName();
    return $routeName;
}

function user(){
    return Auth::user();
}


?>
