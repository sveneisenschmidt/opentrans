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
    const NODE_ORDER_ORDERINFO      = 'node.order.info';
    const NODE_ORDER_PARTIES        = 'node.node.order.parties';   
    const NODE_ORDER_PARTY          = 'node.node.order.party';
    const NODE_ORDER_PARTYID        = 'node.node.order.partyid';
    const NODE_ORDER_REMARK         = 'node.order.remark';
    const NODE_ORDER_SUMMARY        = 'node.order.sumary';

    /**
     *
     * @var array
     */
    protected $default = [
        // Factory\Order
        self::FACTORY_ORDER         => '\SE\Component\OpenTrans\DocumentFactory\OrderFactory',
        
        // Node\Order
        self::NODE_ORDER_DOCUMENT       => '\SE\Component\OpenTrans\Node\Order\DocumentNode',
        self::NODE_ORDER_HEADER         => '\SE\Component\OpenTrans\Node\Order\HeaderNode',
        self::NODE_ORDER_SUMMARY        => '\SE\Component\OpenTrans\Node\Order\SummaryNode',
        self::NODE_ORDER_ADDRESS        => '\SE\Component\OpenTrans\Node\Order\AddressNode',
        self::NODE_ORDER_ARTICLEID      => '\SE\Component\OpenTrans\Node\Order\ArticleIdNode',
        self::NODE_ORDER_ARTICLEPRICE   => '\SE\Component\OpenTrans\Node\Order\ArticlePriceNode',
        self::NODE_ORDER_CONTROLINFO    => '\SE\Component\OpenTrans\Node\Order\ControlInfoNode',
        self::NODE_ORDER_ITEM           => '\SE\Component\OpenTrans\Node\Order\ItemNode',
        self::NODE_ORDER_ORDERINFO      => '\SE\Component\OpenTrans\Node\Order\OrderInfoNode',
        self::NODE_ORDER_PARTIES        => '\SE\Component\OpenTrans\Node\Order\OrderPartiesNode',
        self::NODE_ORDER_PARTY          => '\SE\Component\OpenTrans\Node\Order\PartyNode',
        self::NODE_ORDER_PARTYID        => '\SE\Component\OpenTrans\Node\Order\PartyIdNode',
        self::NODE_ORDER_REMARK         => '\SE\Component\OpenTrans\Node\Order\SummaryNode',
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