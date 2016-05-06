<?php

namespace Demo;

use GraphAware\Common\Type\NodeInterface;

class NodeProxy implements NodeInterface
{
    protected $identity;

    public function __construct($id)
    {
        $this->identity = $id;
    }

    public function identity()
    {
        return $this->identity;
    }

    public function keys()
    {
        // TODO: Implement keys() method.
    }

    public function containsKey($key)
    {
        // TODO: Implement containsKey() method.
    }

    public function get($key)
    {
        // TODO: Implement get() method.
    }

    public function hasValue($key)
    {
        // TODO: Implement hasValue() method.
    }

    public function value($key, $default = null)
    {
        // TODO: Implement value() method.
    }

    public function values()
    {
        // TODO: Implement values() method.
    }

    public function asArray()
    {
        // TODO: Implement asArray() method.
    }

    public function labels()
    {
        // TODO: Implement labels() method.
    }

    public function hasLabel($label)
    {
        // TODO: Implement hasLabel() method.
    }

}