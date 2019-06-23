<?php
$i = 0;
$dn1 = '';
$dna2 = '';

while (fscanf(STDIN, "%s", $number1))

 {


 	if ($i == 0) {
 		$dna1 = $number1;

 	} elseif ($i == 1) {
 		$dna2 = $number1;
 		$diff = 0;
		$new_dna1 = wordwrap($dna1, 2, " ", true);
		$new_dna2 = wordwrap($dna2, 2, " ", true);
		$new_dna1 = explode(' ', $new_dna1);
		$new_dna2 = explode(' ', $new_dna2);

		$count_dna1 = count($new_dna1);
		$count_dna2 = count($new_dna2);
		$max = max(array($count_dna1, $count_dna2));
		for ($count = 0; $count < $max; $count++) {
			if (@$new_dna1[$count] != @$new_dna2[$count]) {
				$diff++;
			}
		}
		fprintf(STDOUT, "%d", $diff);
		$i = -1;
 	}

	
	$i++;
	
}


?>
