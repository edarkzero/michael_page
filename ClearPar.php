<?php
class ClearPar {
    private $pattern = '()';

    public function build($string) {
        $output = '';

        if(is_string($string) && (substr_count($string,')') > 0 && substr_count($string,'(') > 0))
        {
            $matches = substr_count($string,$this->pattern);

            for($i = 0 ; $i < $matches ; $i++)
                $output .= $this->pattern;
        }

        return $output;

    }

}

echo "<pre>";
$obj = new ClearPar();
echo $obj->build('()())()').'<br>';
echo $obj->build('()(()').'<br>';
echo $obj->build(')(').'<br>';
echo $obj->build('((()').'<br>';
echo "</pre>";