<?php
for ( $i = 0; $i < 256; $i++ )
{
    $r = dechex($i);
    if ( $i < 16 )
    $r = "0".$r;
    file_get_contents("http://192.168.88.14/sec/?pt=35&ws=".$r."0000");
}
