<?php
require_once 'utils.php';

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

    public static function fromAssociativeArray($arr): Query
    {
        return new Query(stringToNum($arr['x']), stringToNum($arr['y']), stringToNum($arr['r']));
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

    public function toHTMLTableRow(): string
    {
        $result = $this->getResult() ? 'YES' : 'NO';
        return <<<END
        <tr>
            <td>{$this->getX()}</td>
            <td>{$this->getY()}</td>
            <td>{$this->getR()}</td>
            <td>{$result}</td>
        </tr>
END;
    }

    /**
     * @return float
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return float
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @return float
     */
    public function getR()
    {
        return $this->r;
    }
}