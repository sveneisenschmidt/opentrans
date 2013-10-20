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
    // Node\Order
    const ORDER_DOCUMENT_NODE       = 'order.document.node';
    const ORDER_ADDRESS_NODE        = 'order.adress,node';
    const ORDER_ARTICLEID_NODE      = 'order.articleid.node';
    const ORDER_ARTICLEPRICE_NODE   = 'order.articleprice.node';  
    const ORDER_CONTROLINFO_NODE    = 'order.controlinfo.node';
    const ORDER_HEADER_NODE         = 'order.header.node';
    const ORDER_ITEM_NODE           = 'order.item.node';
    const ORDER_INFO_NODE           = 'order.info.node';
    const ORDER_PARTIES_NODE        = 'order.parties.node';   
    const ORDER_PARTY_NODE          = 'order.party.node';
    const ORDER_REMARK_NODE         = 'order.remark.node';
    const ORDER_SUMMARY_NODE        = 'order.sumary.node';

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