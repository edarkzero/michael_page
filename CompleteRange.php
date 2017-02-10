<?php

class CompleteRange {

    public function build($integers) {
        $output = [];

        if(is_array($integers))
        {
            asort($integers,SORT_ASC);
            $integers_count = count($integers);

            for ($i = 0 ; $i < $integers_count ; $i++) {

                if($i != $integers_count-1) {
                    $next = abs(intval($integers[$i+1]));
                    $current = abs(intval($integers[$i]));
                    $output[] = $current;
                    $delta = $next-$current;

                    if($delta > 1) {
                        for ($j = 1 ; $j < $delta ; $j++) {
                            $output[] = $current+$j;
                        }
                    }
                }

                else
                    $output[] = abs(intval($integers[$i]));

            }
        }

        return $output;

    }

}

echo '<pre>';
$obj = new CompleteRange();
print_r($obj->build([4,6,7,10])).'<br>';
print_r($obj->build([1,2,4,5])).'<br>';
print_r($obj->build([2,4,9])).'<br>';
print_r($obj->build([55,58,60])).'<br>';
echo '</pre>';