<?php

$a = array(1, 2, 4, 7, 1, 6, 2, 8);

$count_groups = 3;

// Сортируем массива по убыванию
rsort($a);

// Сумма элементов
$sum = 0;
for ($i = 0; $i < count($a); $i++)
{
    $sum += $a[$i];
}

// Примерная сумма группы
$group_sum = floor($sum / $count_groups);

$groups = array();
for ($i = 0; $i < $count_groups; $i++)
{   
    $sum = 0;
    for ($j = 0; $j < count($a); $j++)
    {        
        $sum = $sum + $a[$j];
               
        if ($sum == $group_sum)
        {
            $groups[$i][] = $a[$j];
            unset($a[$j]); $a = array_values($a);
            break;
        }
        
        if ($sum < $group_sum)
        {
            $groups[$i][] = $a[$j];
            unset($a[$j]); $a = array_values($a);
        }
        
        if ($sum > $group_sum)
        {
            if ($sum == 11)
            {
                var_dump($a[$j]);
            }
            $sum = $sum - $a[$j];                
        }        
    }
}

var_dump($a);
