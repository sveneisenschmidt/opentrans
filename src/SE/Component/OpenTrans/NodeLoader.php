<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans;

use \SE\Component\OpenTrans\Exception\UnknownNodeException;
use \SE\Component\OpenTrans\Exception\UnknownNodeTypeException;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class NodeLoader
{
    const ORDER_DOCUMENT_NODE = 'order.document.node';

    /**
     *
     * @var array
     */
    protected $default = [
        self::ORDER_DOCUMENT_NODE => '\SE\Component\OpenTrans\Node\Order\DocumentNode',
    ];

    /**
     *
     * @var array
     */
    protected $custom = [];

    /**
     *
     * @param string $nodeName
     * @throws \SE\Component\OpenTrans\Exception\UnknownNodeException
     * @return \SE\Component\OpenTrans\Node\AbstractNode
     */
    public function getInstance($nodeName)
    {
        if(isset($this->custom[$nodeName]) === true) {
            return new $this->custom[$nodeName];
        }

        if(isset($this->default[$nodeName]) === true) {
            return new $this->default[$nodeName];
        }

        throw new UnknownNodeException(sprintf('Node %s not found.', $nodeName));
    }

    /**
     *
     * @param string $nodeName
     * @param string $class
     * @throws \SE\Component\OpenTrans\Exception\UnknownNodeTypeException
     */
    public function set($nodeName, $class)
    {
        if(isset($this->default[$nodeName]) === false) {
            throw new UnknownNodeTypeException(sprintf('Node name %s not found.', $nodeName));
        }

        $this->custom[$nodeName] = $class;
    }

    /**
     *
     * @param string $nodeName
     * @throws \SE\Component\OpenTrans\Exception\UnknownNodeTypeException
     * @return $class
     */
    public function get($nodeName)
    {
        if(isset($this->custom[$nodeName]) === true) {
            return $this->custom[$nodeName];
        }

        if(isset($this->default[$nodeName]) === true) {
            return $this->default[$nodeName];
        }

        throw new UnknownNodeTypeException(sprintf('Node name %s not found.', $nodeName));
    }
}