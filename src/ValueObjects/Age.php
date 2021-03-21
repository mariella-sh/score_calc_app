<?php
namespace App\ValueObjects;

class Age extends RangeNum
{
    protected $min = 0;
    protected $max = 100;
}
