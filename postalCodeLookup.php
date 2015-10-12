<?php

require_once 'common.inc.php';

$postalcode= GET_or_NULL('postalcode');
$country = GET_or_NULL('country');
$token = GET_or_NULL('token');
$maxRows = min(max(GET_or_NULL("maxRows"), 10), 99);

if ($country === 'FR') {
    require_once 'frenchPostalCodes.inc.php';
    $towns = $frenchPostalCodes[$postalcode];
    if (!$towns) {
        $towns = $allTowns;
    }
    if ($token) {
        $token = strtoupper($token);
        $r1 = array();
        $r2 = array();
        foreach ($towns as $town) {
            $pos = strpos($town, $token);
            if ($pos !== FALSE) {
                if ($pos === 0)
                    $r1[] = $town;
                else
                    $r2[] = $town;
            }
        }
        $towns = array_merge($r1, $r2);
    }
    $towns = array_slice($towns, 0, $maxRows);
    echoJson(array("towns" => $towns));
}
