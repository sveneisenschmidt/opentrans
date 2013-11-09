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
use \SE\Component\OpenTrans\Node\NodeInterface;
use \SE\Component\OpenTrans\Node\Order\DocumentNode;
use \SE\Component\OpenTrans\Node\Order\HeaderNode;
use \SE\Component\OpenTrans\Node\Order\OrderInfoNode;
use \SE\Component\OpenTrans\Node\Order\SummaryNode;
use \SE\Component\OpenTrans\Node\Order\OrderPartiesNode;
use \SE\Component\OpenTrans\Node\Order\PartyNode;
use \SE\Component\OpenTrans\Node\Order\ItemNode;

use \SE\Component\OpenTrans\DocumentFactory\AbstractDocumentFactory;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class OrderFactory extends AbstractDocumentFactory
{
    /**
     *
     * @var \SE\Component\OpenTrans\NodeLoader
     */
    protected $loader;

    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     */
    public function __construct(NodeLoader $loader)
    {
        $this->loader = $loader;
    }

    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     * @param \SE\Component\OpenTrans\Node\Order\DocumentNode $node
     * @return \SE\Component\OpenTrans\Node\NodeInterface
     */
    public function createDocument($node = null)
    {
        if($node === null || is_object($node) === false) {
            $node = $this->loader->getInstance(NodeLoader::NODE_ORDER_DOCUMENT);
        }

        self::build($this->loader, $node);

        return $node;
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

    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     * @return \SE\Component\OpenTrans\Node\PartyNode
     */
    public static function buildOrderParty(NodeLoader $loader, PartyNode $node)
    {
        if(($partyId = $node->getPartyId()) === null) {
            $partyId = $loader->getInstance(NodeLoader::NODE_ORDER_PARTYID);
            $node->setPartyId($partyId);
        }

        if(($address = $node->getAddress()) === null) {
            $address = $loader->getInstance(NodeLoader::NODE_ORDER_ADDRESS);
            $node->setAddress($address);
        }
    }

    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     * @return \SE\Component\OpenTrans\Node\ItemNode
     */
    public static function buildItem(NodeLoader $loader, ItemNode $node)
    {
        if(($articleId = $node->getArticleId()) === null) {
            $articleId = $loader->getInstance(NodeLoader::NODE_ORDER_ARTICLEID);
            $node->setArticleId($articleId);
        }

        if(($articlePrice = $node->getArticlePrice()) === null) {
            $articlePrice = $loader->getInstance(NodeLoader::NODE_ORDER_ARTICLEPRICE);
            $node->setArticlePrice($articlePrice);
        }
    }

    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     * @param \SE\Component\OpenTrans\Node\NodeInterface $document
     * @param array $data
     * @param boolean $build
     */
    public function load(NodeInterface $node, array $data, $build = true)
    {
        if($node instanceof DocumentNode === false) {
            throw new \InvalidArgumentException(sprintf(
                'First agrument must be instance of %s',
                '\SE\Component\OpenTrans\Node\Order\DocumentNode'
            ));
        }

        if($build === true) {
            self::build($this->loader, $node);
        }

        self::loadScalarArrayData($node, $data, array('summary', 'header', 'items'));

        if(isset($data['summary']) === true) {
            self::loadSummary($this->loader, $node->getSummary(), $data['summary']);
        }

        if(isset($data['header']) === true) {
            self::loadHeader($this->loader, $node->getHeader(), $data['header']);
        }

        if(isset($data['items']) === true && is_array($data['items']) === true) {
            self::loadItems($this->loader, $node, $data['items']);
        }
    }

    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     * @param \SE\Component\OpenTrans\Node\SummaryNode $node
     * @param array $data
     */
    public static function loadSummary(NodeLoader $loader, SummaryNode $node, array $data)
    {
        self::loadScalarArrayData($node, $data);
    }

    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     * @param \SE\Component\OpenTrans\Node\HeaderNode $node
     * @param array $data
     */
    public static function loadHeader(NodeLoader $loader, HeaderNode $node, array $data)
    {
        self::loadScalarArrayData($node, $data, array('control_info', 'order_info'));

        if(isset($data['control_info'])  === true) {
            self::loadScalarArrayData($node->getControlInfo(), $data['control_info']);
        }

        if(isset($data['order_info'])  === true) {
            self::loadOrderInfo($loader, $node->getOrderInfo(), $data['order_info']);
        }
    }

    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     * @param \SE\Component\OpenTrans\Node\DocumentNode $node
     * @param array $data
     */
    public static function loadItems(NodeLoader $loader, DocumentNode $node, array $data)
    {
        foreach($data as $itemData) {
            if(is_array($itemData) === true) {
                $itemNode = $loader->getInstance(NodeLoader::NODE_ORDER_ITEM);
                $node->addItem($itemNode);

                self::buildItem($loader, $itemNode);
                self::loadScalarArrayData($itemNode, $itemData, array('article_id', 'article_price'));

                if(isset($itemData['article_id']) === true && is_array($itemData) === true) {
                    self::loadScalarArrayData($itemNode->getArticleId(), $itemData['article_id']);
                }

                if(isset($itemData['article_price']) === true && is_array($itemData) === true) {
                    self::loadScalarArrayData($itemNode->getArticlePrice(), $itemData['article_price']);
                }
            }
        }
    }

    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     * @param \SE\Component\OpenTrans\Node\Order\OrderInfoNode $node
     * @param array $data
     */
    public static function loadOrderInfo(NodeLoader $loader, OrderInfoNode $node, array $data)
    {
        self::loadScalarArrayData($node, $data, array('remarks', 'order_parties', 'payment'));

        if(isset($data['payment']) === true) {
            $node->setPayment($data['payment']);
        }

        if(isset($data['remarks']) === true && is_array($data['remarks']) === true) {
            self::loadRemarks($loader, $node, $data['remarks']);
        }

        if(isset($data['order_parties']) === true && is_array($data['order_parties']) === true) {
            self::loadOrderParties($loader, $node->getOrderParties(), $data['order_parties']);
        }

        if(isset($data['order_date']) === true && is_object($data['order_date']) === true) {
            $node->setOrderDate($data['order_date']);
        }
    }

    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     * @param \SE\Component\OpenTrans\Node\NodeInterface $node
     * @param array $data
     */
    public static function loadRemarks(NodeLoader $loader, NodeInterface $node, array $data)
    {
        foreach($data as $remarkData) {
            if(is_array($remarkData) === true) {
                $remark = $loader->getInstance(NodeLoader::NODE_ORDER_REMARK);
                $node->addRemark($remark);

                self::loadScalarArrayData($remark, $remarkData);
            }
        }
    }

    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     * @param \SE\Component\OpenTrans\Node\OrderPartiesNode $node
     * @param array $data
     */
    public static function loadOrderParties(NodeLoader $loader, OrderPartiesNode $node, array $data)
    {
        $methods = array(
            'buyer_parties'     => 'addBuyerParty',
            'invoice_parties'   => 'addInvoiceParty',
            'shipping_parties'  => 'addShippingParty',
            'supplier_parties'  => 'addSupplierParty',
        );
        $parties = array_keys($methods);

        foreach($data as $name => $values) {
            if(in_array($name, $parties) === true && is_array($values) === true) {
                $method = $methods[$name];
                foreach($values as $partyData) {
                    $partyNode = $loader->getInstance(NodeLoader::NODE_ORDER_PARTY);
                    $node->$method($partyNode);

                    self::buildOrderParty($loader, $partyNode);
                    self::loadScalarArrayData($partyNode, $partyData, array('party_id' ,'address'));

                    if(isset($partyData['party_id']) === true && is_array($partyData['party_id']) === true) {
                        self::loadScalarArrayData($partyNode->getPartyId(), $partyData['party_id']);
                    }
                    if(isset($partyData['address']) === true && is_array($partyData['address']) === true) {
                        self::loadScalarArrayData($partyNode->getAddress(), $partyData['address']);
                    }
                }
            }
        }
    }
}
