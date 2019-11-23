<?php 
    require_once'buy.php';
    $idProduct=$_GET['id'];
    $newProduct=array();
    foreach ($product as $val){
        $newProduct[$val['id']]=$val;
    }

?>