<?php


$pattern = "GA0a!b1|cBdN@efg2hCih3'jkD#1P40mM%n^JVo\Q5pRE_<q=)SIK9rs6&tT*uUF,L-(vZ/7w~Wx+8yX>zy";

$length = strlen($pattern)-1;

$password = [];

for($i=0;$i<8;$i++)
{
    $index = rand(0,$length);

    $password[] = $pattern[$index];
}

echo implode($password);


?>