<?php

$output = array();

$stdin = fopen('php://stdin', 'r');
$totalTests = trim(fgets($stdin));
$maxLengthNumber = 10;

for ($i = 0; $i < $totalTests; $i++) {

    $totalNumbers = trim(fgets($stdin));

    $list = array();
    $numbers = array();

    // 1. Group the numbers by length in an array
    for ($a = 0; $a < $totalNumbers; $a++) {
        $phone = trim(fgets($stdin));
        $numbers[] = $phone;
        $digits = strlen($phone);
        $list[$digits][] = $phone;
    }

    if ($totalNumbers != count(array_flip($numbers))) {
        // 2. Check for doubles, if there is a double then it's not consistent
        $isConsistent = false;
    } else {
        $isConsistent = true;
        // 3. Iterate over the the array
        $keys = array_keys($list);
        sort($keys);
        $keys = array_reverse($keys, SORT_NUMERIC);
        $max_key = max($keys);
        foreach ($keys as $index => $key) {

            $totalItems = count($list[$key]);

            // 3.1. Check for doubles, and if there are it's not consistent, so break
            if ($totalItems != count(array_flip($list[$key]))) {
                $isConsistent = false;
                break;
            }

            // 3.2. If MAX_NUMBER_LENGTH = CURRENT_NUMBER_LENGTH || $key == $max_key, then we continue as it's consistent and there are no duplicates
            if ($maxLengthNumber == $key || $key == $max_key) {
                $isConsistent = true;
                continue;
            }

            // 3.3. Build the array from the previous data set and merge into current so we can keep the results
            $prevCut = array();
            $prev = array();
            $currentListIndex = $keys[$index];
            $prevListIndex = $keys[$index + 1];

            // 3.4. Create an array the we gonna use to compare
            foreach ($list[$prevListIndex] as $idx => &$val) {
                $prevCut[$idx] = substr($val, 0, $key);
                $prev[$idx] = $val; // point it as a reference for faster memory access
            }

            // 3.5. Check if the keys are present in the array
            $prevCutKeys = array_flip($prevCut);
            foreach ($list[$currentListIndex] as $idx => $val) {

                if (isset($prevCutKeys[$val])) {
                    $isConsistent = false;
                    break;
                } else {
                    $isConsistent = true;
                }

            }

            // 3.6. Break if we detected a match
            if (!$isConsistent) {
                break;
            }

            // 3.7. Add the values to current index, so we can compare with previous one on the next run
            foreach ($prev as $val) {
                $list[$currentListIndex][] = $val;
            }

        }
    }
    array_push($output, $isConsistent ? "YES" : "NO");

}

$out = fopen('php://output', 'w'); //output handler
fputs($out, join("\n", $output) . "\n"); //writing output operation
fclose($out);