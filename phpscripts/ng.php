<?

$url = "http://192.168.88.14/sec/?pt=35&ws=";

function rgb_smooth()
{
	global $url;
	$limit = 30;
	$loop_cnt = 0;
	while(true)
	{

		$cmd_rgb = "";
		$color_sum = 0;
		for ( $i = 0; $i < 12; $i++ )
		{
			for ( $j = 0; $j < 3; $j ++ )
			{
				if ( $color_now[$j][$i] == $color_steps[$j][$i] )
				$color_steps[$j][$i] = rand(0, 80);

				if ( $j == 0 && ( (abs($color_steps[0][$i] - $color_steps[1][$i]) <= $limit) || (abs($color_steps[0][$i] - $color_steps[2][$i]) <= $limit) ) )
				$color_steps[0][$i] = 0;
				else if ( $j == 1 && ( (abs($color_steps[1][$i] - $color_steps[0][$i]) <= $limit) || (abs($color_steps[1][$i] - $color_steps[2][$i]) <= $limit) ) )
				$color_steps[1][$i] = 0;
				else if ( $j == 2 && ( (abs($color_steps[2][$i] - $color_steps[0][$i]) <= $limit) || (abs($color_steps[2][$i] - $color_steps[1][$i]) <= $limit) ) )
				$color_steps[2][$i] = 0;

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
	
				if ( $color[$j][$i] >= 80 )
				{
					$color[$j][$i] = 80;
					$color_now[$j][$i] = $color_steps[$j][$i];
				}
				if ( $color[$j][$i] < 0 )
				{
					$color[$j][$i] = 1;
					$color_now[$j][$i] = $color_steps[$j][$i];
				}


				if ( strlen(dechex($color[$j][$i])) == 1 )
				$cmd[$j][$i] = "0".dechex($color[$j][$i]);
				else
				$cmd[$j][$i] = dechex($color[$j][$i]);
			}
			$cmd_rgb .= $cmd[0][$i].$cmd[1][$i].$cmd[2][$i];
		}

		file_get_contents($url.$cmd_rgb);
		$loop_cnt++;
		if ( $loop_cnt == 1300 )
		return;

		//echo $cmd_rgb." - color-steps=$color_steps[0]/$color_steps[1]/$color_steps[2]; color_now=$color_now[0]/$color_now[1]/$color_now[2]; color=$color[0]/$color[1]/$color[2]\n";
		//echo hexdec($cmd[0][0])."-".$color_steps[0][0]."\n";
		//usleep(50000);
	}
}

function rgb_wheel()
{

	global $url;
	$loop_cnt = 0;
	$color = "ff0000";
	while(true)
	{

		$cmd = "";
		for ( $i = 0; $i < 6; $i++ )
		{
			if ( $i == $cnt )
			//$cmd .= $cmd_list[$color].$cmd_list[$color];
			$cmd .= $color.$color;
			else
			$cmd .= "000000000000";
		}
	
		if ( $cmd == "000000000000000000000000000000000000000000000000000000000000000000000000" )
		$cmd = $color.$color."000000000000000000000000000000000000000000000000000000000000";

		$cnt++;

		if ( $cnt == 12 )
		{
			$cnt = 0;
			$r = 0;
			$g = 0;
			$b = 0;
			for ( $i = 0; $i < 3; $i++ )
			{
				$r = dechex(rand(0, 50));
				$g = dechex(rand(0, 50));
				$b = dechex(rand(0, 50));

				if ( strlen($r) == 1 )
				$r = "0".$r;
				if ( strlen($g) == 1 )
				$g = "0".$g;
				if ( strlen($b) == 1 )
				$b = "0".$b;
				$color = $r.$g.$b;

			}
			//$color = rand(0,3);
		}
		file_get_contents($url.$cmd);
		//echo "$cmd-".strlen($cmd)."\n";
		
		usleep(50000);

		$loop_cnt++;
		if ( $loop_cnt == 200 )
		return;
	}

}

function rgb_flag()
{
	global $url;
	$loop_cnt = 0;
	$cmd = "";
	$code = "";
	$cmd = "";

	while(true)
	{
		for ( $i = 0; $i < 90; $i++ )
		{
			$code = dechex($i);
			if ( $i < 16 )
			$code = "0".$code; 

			$cmd = "";
			$color_w = "";
			$color_b = "";
			$color_r = "";
			$white = "";
			for ( $j = 0; $j < 3; $j++ )
			{
				$color_w .= $code.$code.$code;
				$color_b .= "00".$code."00";
				$color_r .= $code."0000";
			}
			
			$cmd = $color_w.$color_b.$color_r;

			file_get_contents($url.$cmd);
			//echo $cmd."\n";
			//usleep(50000);
		}

		for ( $i = 90; $i > 0; $i-- )
		{
			$code = dechex($i);
			if ( $i < 16 )
			$code = "0".$code; 

			$cmd = "";
			$color_w = "";
			$color_b = "";
			$color_r = "";

			for ( $j = 0; $j < 3; $j++ )
			{
				$color_w .= $code.$code.$code;
				$color_b .= "00".$code."00";
				$color_r .= $code."0000";
			}

			$cmd = $color_w.$color_b.$color_r;

			file_get_contents($url.$cmd);
			//echo $cmd."\n";
			//usleep(50000);
		}

		$loop_cnt++;
		if ( $loop_cnt == 5 )
		return;

	}
}

function rgb_flag2()
{
	global $url;
	$loop_cnt = 0;
	$cmd = "";
	$code = "";
	$cmd = "";

	while(true)
	{
		for ( $i = 0; $i < 80; $i++ )
		{
			$code = dechex($i);
			if ( $i < 16 )
			$code = "0".$code; 

			$cmd = "";
			$color_w = "";
			$color_b = "";
			$color_r = "";
			$white = "";
			for ( $j = 0; $j < 33; $j++ )
			{
				$color_w .= $code.$code.$code;
				$color_b .= "00".$code."00";
				$color_r .= $code."0000";
			}
			
			$cmd = $color_w.$color_b.$color_r;

			file_get_contents($url.$cmd);
			//echo $cmd."\n";
			//usleep(50000);
		}

		for ( $i = 80; $i > 0; $i-- )
		{
			$code = dechex($i);
			if ( $i < 16 )
			$code = "0".$code; 

			$cmd = "";
			$color_w = "";
			$color_b = "";
			$color_r = "";

			for ( $j = 0; $j < 33; $j++ )
			{
				$color_w .= $code.$code.$code;
				$color_b .= "00".$code."00";
				$color_r .= $code."0000";
			}

			$cmd = $color_w.$color_b.$color_r;

			file_get_contents($url.$cmd);
			//echo $cmd."\n";
			//usleep(50000);
		}

		$loop_cnt++;
		if ( $loop_cnt == 5 )
		return;

	}
}


function rgb_rline()
{
	global $url;
	$loop_cnt = 0;
	$cmd = "";
	$code = "";
	$cmd = "";
	$r = 0;
	$b = 0;
	$g = 0;

	while(true)
	{
		$color_r = rand(0, 80);
		$color_b = rand(0, 80);
		$color_g = rand(0, 80);

		for ( $i = 0; $i < 90; $i++ )
		{
			if ( $r < $color_r )
			$r = dechex($i);
			if ( $b < $color_b )
			$b = dechex($i);
			if ( $g < $color_g )
			$g = dechex($i);

			if ( strlen($r) == 1 )
			$r = "0".$r;
			if ( strlen($b) == 1 )
			$b = "0".$b;
			if ( strlen($g) == 1 )
			$g = "0".$g;

			$cmd = $r.$b.$g;

			file_get_contents($url.$cmd);

			//echo "$cmd - $i\n";
		}

		$color_r = hexdec($r);
		$color_b = hexdec($b);
		$color_g = hexdec($g);

		for ( $i = 90; $i > 0; $i-- )
		{

			//if ( $color_r > 0 )
			$r = dechex($color_r);
			//if ( $color_b > 0 )
			$b = dechex($color_b);
			//if ( $color_g > 0 )
			$g = dechex($color_g);

			if ( strlen($r) == 1 )
			$r = "0".$r;
			if ( strlen($b) == 1 )
			$b = "0".$b;
			if ( strlen($g) == 1 )
			$g = "0".$g;

			$cmd = $r.$b.$g;

			file_get_contents($url.$cmd);
			//echo "$cmd\n";

			if ( $color_r > 0 )
			$color_r--;
			if ( $color_b > 0 )
			$color_b--;
			if ( $color_g > 0 )
			$color_g--;

		}

		$loop_cnt++;
		if ( $loop_cnt == 5 )
		return;

	}
}

function running_line()
{
	global $url;
	$loop_cnt = 0;

	while(true)
	{

		$base = rand(0, 2);

		if ( $base == 0 )
		$color_r = rand(40, 80);
		else
		$color_r = rand(0, 40);
		if ( $base == 1 )
		$color_b = rand(40, 80);
		else
		$color_b = rand(0, 40);
		if ( $base == 2 )
		$color_g = rand(40, 80);
		else
		$color_g = rand(0, 40);

		$color_r = hexdec($color_r);
		$color_b = hexdec($color_b);
		$color_g = hexdec($color_g);

		if ( strlen($color_r) == 1 )
		$color_r = "0".$color_r;
		if ( strlen($color_b) == 1 )
		$color_b = "0".$color_b;
		if ( strlen($color_g) == 1 )
		$color_g = "0".$color_g;

		for ( $i = 0; $i < 101; $i++ )
		{
			$cmd = "";
			for ( $j = 0; $j < 100; $j++ )
			{
				if ( $j < $i )
				$cmd .= $color_r.$color_b.$color_g;
				else
				$cmd .= "000000";
			}
			//echo "$cmd.\n\n";
			file_get_contents($url.$cmd);
			//usleep(10000);
		}

		for ( $i = 0; $i < 101; $i++ )
		{
			$cmd = "";
			for ( $j = 0; $j < 100; $j++ )
			{
				if ( $j < $i )
				$cmd .= "000000";
				else
				//$cmd .= "FF0000";
				$cmd .= $color_r.$color_b.$color_g;
			}
			//echo "$cmd.\n\n";
			file_get_contents($url.$cmd);
			//usleep(10000);
		}


		$loop_cnt++;
		if ( $loop_cnt == 3 )
		return;

	}
}

function rgb_babah()
{
	global $url;
	$loop_cnt = 0;

	for ( $i = 0; $i < 50; $i++ )
	{
		$sub_cmd = "";
		for ( $j = 0; $j < 50; $j++ )
		{
			if ( $j == $i )
			$sub_cmd .= "i";
			else
			$sub_cmd .= "o";
		}
		$sub_cmd .= strrev($sub_cmd);
		$cmd = str_replace("i", "0000FF", $sub_cmd);
		$cmd = str_replace("o", "000000", $cmd);
		//echo $cmd."\n";
		//usleep(50000);
		file_get_contents($url.$cmd);
	}

	file_get_contents($url."FF0000");
	file_get_contents($url."FFFFFF");
	file_get_contents($url."FF0000");
	file_get_contents($url."FF00FF"); // ������
	file_get_contents($url."FF0000");
	file_get_contents($url."FF00FF"); // ������
	file_get_contents($url."FFFFFF");
	file_get_contents($url."FF00FF"); // ������
	file_get_contents($url."FF0000");
	file_get_contents($url."FFFFFF");
	file_get_contents($url."FF0000");
	file_get_contents($url."FF0000");
	file_get_contents($url."FFFFFF");
	file_get_contents($url."FF0000");
	file_get_contents($url."FF00FF"); // ������
	file_get_contents($url."FF0000");
	file_get_contents($url."FF00FF"); // ������
	file_get_contents($url."FFFFFF");
	file_get_contents($url."FF00FF"); // ������
	file_get_contents($url."FF0000");
	file_get_contents($url."FFFFFF");
	file_get_contents($url."A00000");

	for ( $i = 159; $i > 0; $i-- )
	{
		$cmd = dechex($i);
		if ( $i < 17 )
		$cmd = "0".$cmd;
		//echo $cmd;
		file_get_contents($url.$cmd."0000");
	}

	file_get_contents($url."000000");
	sleep(3);

}

while(true)
{

	// �����������
	rgb_smooth();
	// ������� ��������
	rgb_wheel();
	// �����������
	rgb_smooth();
	// ������������� ���� ������
	rgb_flag();
	// �����������
	rgb_smooth();
	// ��������� �������
	rgb_rline();
	// �����������
	rgb_smooth();
	// ������� �����
	running_line();
	// �����������
	rgb_smooth();
	// ������� ���� ������
	rgb_flag2();
	// �����
	rgb_babah();

	if ( file_exists("/var/www/ws2818/ng-exit.tmp") )
	{
		file_get_contents($url."000000");
		unlink("/var/www/ws2818/ng-exit.tmp");
		exit();
	}

}

?>