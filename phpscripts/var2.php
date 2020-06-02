<?php
$cmd_list = array("FF0000", "00FF00", "0000FF", "FFFFFF", "000000");
while(true)
{

    $cmd = $cmd_list[rand(0,4)].$cmd_list[rand(0,4)].$cmd_list[rand(0,4)];
    file_get_contents("http://192.168.88.14/sec/?pt=35&ws=$cmd");
    sleep(1);
}
