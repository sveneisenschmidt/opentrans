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
    // Factory\Order
    const FACTORY_ORDER                  = 'factory.order';
    
    // Node\Order
    const NODE_ORDER_DOCUMENT       = 'node.order.document';
    const NODE_ORDER_ADDRESS        = 'node.order.adress';
    const NODE_ORDER_ARTICLEID      = 'node.order.articleid.';
    const NODE_ORDER_ARTICLEPRICE   = 'node.order.articleprice';  
    const NODE_ORDER_CONTROLINFO    = 'node.order.controlinfo';
    const NODE_ORDER_HEADER         = 'node.order.header';
    const NODE_ORDER_ITEM           = 'node.order.item';
    const NODE_ORDER_INFO           = 'node.order.info';
    const NODE_ORDER_PARTIES        = 'node.node.order.parties';   
    const NODE_ORDER_PARTY          = 'node.node.order.party';
    const NODE_ORDER_REMARK         = 'node.order.remark';
    const NODE_ORDER_SUMMARY        = 'node.order.sumary';

    /**
     *
     * @var array
     */
    protected $default = [
        // Factory\Order
        self::FACTORY_ORDER         => '\SE\Component\OPenTrans\DocumentFactory\OrderFactory',
        
        // Node\Order
        self::NODE_ORDER_DOCUMENT   => '\SE\Component\OpenTrans\Node\Order\DocumentNode',
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