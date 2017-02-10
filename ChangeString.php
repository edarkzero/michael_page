<?php

class ChangeString {
    private $str_abc_lower = '_abcdefghijklmnñopqrstuvwxyz';
    private $str_abc_upper = '_ABCDEFGHIJKLMNÑOPQRSTUVWXYZ';

    public function build($str) {
        $str_len = strlen($str);
        $output = '';

        if(!empty($str)) {

            for ($i = 0 ; $i < $str_len ; $i++) {
                $newu = $this->check(true,$str[$i]);
                $newl = $this->check(false,$str[$i]);

                if(!empty($newl))
                    $output .= $newl;
                elseif(!empty($newu))
                    $output .= $newu;
                else
                    $output .= $str[$i];
            }

        }

        return $output;
    }

    private function check($isUpper,$char) {

        $str_compare = $isUpper ? $this->str_abc_upper : $this->str_abc_lower;

        $position = mb_strpos($str_compare,$char);

        if($position > 0)
        {
            if($position == strlen($str_compare) - 1)
                return $str_compare[1];
            else
                return $str_compare[$position+1];
        }

        else
            return '';

    }

}

echo '<pre>';
$obj = new ChangeString();
echo '123 abcd*3 -> '.$obj->build('123 abcd*3').'<br>';
echo '**Casa 52 z -> '.$obj->build('**Casa 52 z').'<br>';
echo '**Casa 52Z -> '.$obj->build('**Casa 52Z').'<br>';
echo '</pre>';