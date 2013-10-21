<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\DocumentFactory;

use \SE\Component\OpenTrans\NodeLoader;
use \SE\Component\OpenTrans\Node\Order\DocumentNode;
use \SE\Component\OpenTrans\Node\Order\HeaderNode;
use \SE\Component\OpenTrans\Node\Order\OrderInfoNode;
use \SE\Component\OpenTrans\DocumentFactory\DocumentFactoryInterface;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class OrderFactory implements DocumentFactoryInterface
{
    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     * @param \SE\Component\OpenTrans\Node\Order\DocumentNode $document
     * @return \SE\Component\OpenTrans\Node\NodeInterface
     */
    public static function create(NodeLoader $loader, $document = null)
    {
        if($document === null || is_object($document) === false) {
            $document = $loader->getInstance(NodeLoader::NODE_ORDER_DOCUMENT);
        }

        self::build($loader, $document);

        return $document;
    }

    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     * @param \SE\Component\OpenTrans\Node\Order\DocumentNode $node
     */
    public static function build(NodeLoader $loader, DocumentNode $node)
    {
        if(($header = $node->getHeader()) === null) {
            $header = $loader->getInstance(NodeLoader::NODE_ORDER_HEADER);
            $node->setHeader($header);
        }

        if(($summary = $node->getSummary()) === null) {
            $summary = $loader->getInstance(NodeLoader::NODE_ORDER_SUMMARY);
            $node->setSummary($summary);
        }

        self::buildHeader($loader, $header);
    }

    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     * @param \SE\Component\OpenTrans\Node\Order\HeaderNode $node
     */
    public static function buildHeader(NodeLoader $loader, HeaderNode $node)
    {
        if(($controlInfo = $node->getControlInfo()) === null) {
            $controlInfo = $loader->getInstance(NodeLoader::NODE_ORDER_CONTROLINFO);
            $node->setControlInfo($controlInfo);
        }

        if(($orderInfo = $node->getOrderInfo()) === null) {
            $orderInfo = $loader->getInstance(NodeLoader::NODE_ORDER_ORDERINFO);
            $node->setOrderInfo($orderInfo);
        }

        self::buildOrderInfo($loader, $orderInfo);
    }

    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     * @param \SE\Component\OpenTrans\Node\Order\OrderInfoNode $node
     */
    public static function buildOrderInfo(NodeLoader $loader, OrderInfoNode $node)
    {
        if(($orderParties = $node->getOrderParties()) === null) {
            $orderParties = $loader->getInstance(NodeLoader::NODE_ORDER_PARTIES);
            $node->setOrderParties($orderParties);
        }
    }
}