<?php 

function String2Hex($string){
    $hex='';
    for ($i=0; $i < strlen($string); $i++){
        $hex .= dechex(ord($string[$i]));
    }
    return $hex;
}
$hexStr = String2Hex("45855");
    $res =  base_convert($hexStr,16,10);
    echo $res;
 ?>