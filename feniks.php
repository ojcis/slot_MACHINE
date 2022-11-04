<?php
$symbolsChancesValues=
    [
        ['!',4,5],
        ['*',2,100],
        ['$',1,500],
        ['7',3,10]
    ];//here you can change/add symbols, chance and value
$lines=[
    [[0,0],[0,1],[0,2],[0,3],[0,4]],
    [[1,0],[1,1],[1,2],[1,3],[1,4]],
    [[2,0],[2,1],[2,2],[2,3],[2,4]],
    [[0,0],[1,1],[2,2],[1,3],[0,4]],
    [[2,0],[1,1],[0,2],[1,3],[2,4]],
    [[0,0],[0,1],[1,2],[2,3],[2,4]],
    [[2,0],[2,1],[1,2],[0,3],[0,4]],
    [[1,0],[0,1],[1,2],[2,3],[1,4]],
    [[1,0],[2,1],[1,2],[0,3],[1,4]],
    [[0,0],[1,1],[1,2],[1,3],[2,4]],
    [[2,0],[1,1],[1,2],[1,3],[0,4]]
];//wining line

$symbolsChance=[];
foreach ($symbolsChancesValues as [$symbol,$chance,$value]){
    for ($i=1;$i<=$chance;$i++){
        array_push($symbolsChance, $symbol[0]);
    }
}
ADD_MONEY:
$money=readline('Insert your money: $');
START:
$money=$money-1;
for ($i=0;$i<3;$i++) {
    for ($j=0;$j<5;$j++) {
        $screen[$i][$j] = $symbolsChance[array_rand($symbolsChance)];
    }
}//create screen

function outputScreen(array $screen){
    foreach ($screen as $row){
        foreach ($row as $symbol){
            echo "[$symbol]";
        }
        echo PHP_EOL;
    }
}

outputScreen($screen);
$winingSymbols=[];

foreach ($symbolsChancesValues as [$symbol,$chance,$value]){
    foreach ($lines as $line){
        $count=0;
        foreach ($line as [$x,$y]){
            if ($symbol!==$screen[$x][$y]){
                break;
            }
            $count++;
        }
        if ($count==5){
            array_push($winingSymbols, $symbol);
        }
    }
}//outputs array of wining lines

if (count($winingSymbols)>0){
    $winnings=0;
    foreach ($symbolsChancesValues as [$symbol,$chance,$value]){
            foreach ($winingSymbols as $winingSymbol) {
            if ($symbol==$winingSymbol){
                $winnings = $winnings + $value;
            }
        }
    }
    echo "YOU WON $$winnings".PHP_EOL;
    $money=$money+$winnings;
} else{
    echo "maybe next time...".PHP_EOL;
}
echo "Your balance: $$money".PHP_EOL;

if ($money==0){
    $addMoney=readline('You are out of money. Do you want add more money?[y/n]: ');
    if ($addMoney=='y'){
        goto ADD_MONEY;
    }
    exit("BYE! COME AGAIN!".PHP_EOL);
}
$spinOrEnd=readline("Press enter to spin. Press space and enter to cash out");
if ($spinOrEnd==null){
    goto START;
}
echo "BYE! COME AGAIN!".PHP_EOL;
