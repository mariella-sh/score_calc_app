<?php
namespace App\ValueObjects;

class Score extends RangeNum
{
    protected $min = -100;
    protected $max = 100;
}
