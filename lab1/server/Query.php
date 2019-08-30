<?php

class Query
{
    private $x;
    private $y;
    private $r;
    private $result = null;

    /**
     * Query constructor.
     * @param $x
     * @param $y
     * @param $r
     */
    public function __construct($x, $y, $r)
    {
        $this->x = $x;
        $this->y = $y;
        $this->r = $r;
    }

    public static function fromAssociativeArray($arr)
    {
        return new Query($arr['x'], $arr['y'], $arr['r']);
    }

    public function getResult()
    {
        if ($this->result == null) {
            $this->result = $this->validate();
        }

        return $this->result;
    }

    private function validate()
    {
        if ($this->x < 0 and $this->y < 0) {
            return false;
        }
        if ($this->y < 0) {
            return $this->x ** 2 + $this->y ** 2 <= $this->r ** 2;
        }

        if ($this->x < 0) {
            return $this->x >= -$this->r and $this->y <= $this->r / 2;
        }

        return $this->x + $this->y <= $this->r;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @return mixed
     */
    public function getR()
    {
        return $this->r;
    }
}