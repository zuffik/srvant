<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 1.1.2018
 * Time: 19:40
 */

namespace Zuffik\Srvant\Structures;

abstract class AssociativeStructure extends AbstractStructure
{
    /**
     * @inheritDoc
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * @inheritDoc
     */
    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    /**
     * @inheritDoc
     */
    public function __isset($name)
    {
        return $this->keyExists($name);
    }

    /**
     * @inheritDoc
     */
    public function __unset($name)
    {
        $this->remove($name);
    }

    /**
     * @return \Iterator
     */
    public abstract function iterator();
}