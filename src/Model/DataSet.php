<?php
namespace App\Model;

use App\ValueObjects\Age;
use App\ValueObjects\Score;

class DataSet {

    private $name;
    private $gender;
    private $age;
    private $region;
    private $score;

    /**
     * DataSet constructor.
     * @param $name
     * @param $gender
     * @param Age $age
     * @param $region
     * @param Score $score
     */
    public function __construct($name, $gender, $age, $region, $score)
    {
        $this->name = $name;
        $this->gender = $gender;
        $this->age = $age;
        $this->region = $region;
        $this->score = $score;
    }

    public function __toArray()
    {
        return call_user_func('get_object_vars', $this);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }
}
