<?php
while(true)
{
    $cmd_rgb = "";
    for ( $i = 0; $i < 12; $i++ )
    {
        for ( $j = 0; $j < 3; $j ++ )
        {
            if ( $color_now[$j][$i] == $color_steps[$j][$i] )
            $color_steps[$j][$i] = rand(0, 100);

            if ( $color_now[$j][$i] < $color_steps[$j][$i] )
            {
                $color_now[$j][$i]++;
                $color[$j][$i]++;
            }
            else
            {
                $color_now[$j][$i]--;
                $color[$j][$i]--;
            }
    
            if ( $color[$j][$i] > 255 )
            $color[$j][$i] = 254;
            if ( $color[$j][$i] < 0 )
            $color[$j][$i] = 1;

            if ( strlen(dechex($color[$j][$i])) == 1 )
            $cmd[$j][$i] = "0".dechex($color[$j][$i]);
            else
            $cmd[$j][$i] = dechex($color[$j][$i]);
        }
        $cmd_rgb .= $cmd[0][$i].$cmd[1][$i].$cmd[2][$i];
    }

    file_get_contents("http://192.168.88.14/sec/?pt=35&ws=$cmd_rgb");
}