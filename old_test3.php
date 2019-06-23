<?php

while (fscanf(STDIN, "%s", $str))

 {

 	$factorial = 1;
	$repeat_char_factorial = 1;
	$repeat_char_count_array = array();
	$repeat_char_array = array();

	$str_len = strlen($str);

	for ($i = $str_len; $i > 0; $i--) {
		$factorial = bcmul($factorial, $i);
	} 	

	$str_wrap = wordwrap($str, 1, ",", true);
	$str_array = explode(',', $str_wrap);


	for ($j = 0; $j < count($str_array); $j++) {
		$char = $str_array[$j];
		if ( ! in_array($char, $repeat_char_array)) {
			array_push($repeat_char_array, $char);
		} else {
			continue;
		}
	}

	
	for ($k = 0; $k < count($repeat_char_array); $k++) {
		$count_repeat_char = 0;
		$char = $repeat_char_array[$k];
		for ($l = 0; $l < count($str_array); $l++) {
			if ($char == $str_array[$l]) {
				$count_repeat_char++;
			}
		}
		if ($count_repeat_char > 1) {
			array_push($repeat_char_count_array, $count_repeat_char);
		}
			
	}

	for ($m = 0; $m < count($repeat_char_count_array); $m++) {
		$num_char = $repeat_char_count_array[$m];
		for ($i = $num_char; $i > 0; $i--) {
			$repeat_char_factorial = bcmul($repeat_char_factorial, $i);
		}
	}
	

	if ($repeat_char_factorial > 1) {
		$res = bcdiv($factorial, $repeat_char_factorial);
	} else {
		$res = $factorial;
	}
	printf($res);
}
?>