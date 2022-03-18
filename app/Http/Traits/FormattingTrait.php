<?php
namespace app\Http\Traits;
trait FormattingTrait
{
    public static function phoneNumberFormatted($number)
    {
        $number = preg_replace("/[^\d]/","",$number);

        $length = strlen($number);

        if($length == 10) {
            $number = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $number);
        }

        return $number;
    }
}
