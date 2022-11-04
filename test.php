<?php
$symbolsChancesValues=
    [
        $a=['!',4,5],
        $b=['*',2,100],
        $c=['$',1,500],
        $d=['7',3,10]
    ];
foreach ($symbolsChancesValues as [$symbol,$chance,$value]){ //kāpēc pasvītrojās sarkans, php versija ir 7.4
    echo "$symbol, $chance, $value".PHP_EOL;
}