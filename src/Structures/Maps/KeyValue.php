<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 30.1.2017
 * Time: 10:57
 */

namespace Zuffik\Srvant\Structures\Maps;


use Zuffik\Srvant\Serializable;
use Zuffik\Srvant\Structures\IArray;

class KeyValue implements IArray
{
    /** @var int|string */
    private $key;
    /** @var mixed */
    private $value;

    /**
     * KeyValue constructor.
     * @param int|string $key
     * @param mixed $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return int|string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'key' => $this->key,
            'value' => $this->value
        ];
    }
}