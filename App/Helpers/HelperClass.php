<?php
namespace App\Helpers;

class HelperClass
{
    /**
     * Int to string ($move)
     *
     * @param int $move
     * @return string
     */
    public function moveToString($moves,$move)
    {

        return ucfirst($moves[$move]);
    }
}