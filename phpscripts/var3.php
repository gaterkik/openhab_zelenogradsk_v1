<?php
$cmd_list = array("FF0000", "00FF00", "0000FF", "FFFFFF", "000000");
$color = 0;

while(true)
{
    $cmd = "";
    for ( $i = 0; $i < 9; $i++ )
    {
        $color = dechex(rand(0,100));
        if ( strlen($color) == 1 )
        $color = "0".$color;
        $cmd .= $color;
    }
    file_get_contents("http://192.168.88.14/sec/?pt=35&ws=$cmd");
    sleep(1);
}
