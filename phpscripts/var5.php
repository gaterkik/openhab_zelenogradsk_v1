<?php
$cmd_list = array("500000", "005000", "000050", "505050", "000000");
$color = 0;

while(true)
{
    $cmd = "";
    for ( $i = 0; $i < 12; $i++ )
    {
        if ( $i == $cnt )
        $cmd .= $cmd_list[$color];
        $cmd .= "000000";
    }
    $cnt++;

    if ( $cnt == 12 )
    {
        $cnt = 0;
        $color = rand(0,3);
    }
    file_get_contents("http://192.168.88.14/sec/?pt=35&ws=$cmd");
    usleep(50000);
}