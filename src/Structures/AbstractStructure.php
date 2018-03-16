<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 1.1.2018
 * Time: 17:31
 */

namespace Zuffik\Srvant\Structures;


abstract class AbstractStructure implements Structure
{
    /**
     * @inheritDoc
     */
    public function __construct($param = null)
    {
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return json_encode($this);
    }

    /**
     * @inheritDoc
     */
    public function __debugInfo()
    {
        return array_merge([
            'ptr' => spl_object_hash($this)
        ], $this->toArray());
    }

    /**
     * Returns new instance of List with same content.
     * @return static
     */
    public function copy()
    {
        return new static($this);
    }

    /**
     * Necessary for ArrayAccess but always true due to keep exceptional programming
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        return $this->keyExists($offset);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * @inheritdoc
     */
    public function isEmpty()
    {
        return $this->count() == 0;
    }

    /**
     * @inheritdoc
     */
    public function swap($index1, $index2)
    {
        $tmp = $this[$index1];
        $this[$index1] = $this[$index2];
        $this[$index2] = $tmp;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}