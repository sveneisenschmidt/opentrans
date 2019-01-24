<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\Node\Order;

use JMS\Serializer\Annotation as Serializer;

use SE\Component\OpenTrans\Node\AbstractNode;
use SE\Component\OpenTrans\Node\Order\PartyCollectionNode;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * @Serializer\XmlRoot("ORDER_PARTIES")
 * @Serializer\ExclusionPolicy("all")
 */
class OrderPartiesNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("BUYER_PARTY")
     * @Serializer\Type("SE\Component\OpenTrans\Node\Order\PartyCollectionNode")
     * @Serializer\XmlList(inline=false)
     *
     * @var \SE\Component\OpenTrans\Node\Order\PartyCollectionNode
     */
    protected $buyerParties;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("SUPPLIER_PARTY")
     * @Serializer\Type("SE\Component\OpenTrans\Node\Order\PartyCollectionNode")
     * @Serializer\XmlList(inline=false)
     *
     * @var \SE\Component\OpenTrans\Node\Order\PartyCollectionNode
     */
    protected $supplierParties;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("INVOICE_PARTY")
     * @Serializer\Type("SE\Component\OpenTrans\Node\Order\PartyCollectionNode")
     * @Serializer\XmlList(inline=false)
     *
     * @var \SE\Component\OpenTrans\Node\Order\PartyCollectionNode
     */
    protected $invoiceParties;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("SHIPMENT_PARTIES")
     * @Serializer\Type("SE\Component\OpenTrans\Node\Order\PartyCollectionNode")
     * @Serializer\XmlList(inline=false)
     *
     * @var \SE\Component\OpenTrans\Node\Order\PartyCollectionNode
     */
    protected $shippingParties;

    /**
     *
     * @return void
     */
    public function __construct()
    {
        $this->buyerParties     = new PartyCollectionNode();
        $this->supplierParties  = new PartyCollectionNode();
        $this->invoiceParties   = new PartyCollectionNode();
        $this->shippingParties  = new PartyCollectionNode();
    }


    /**
     *
     * @param array $parties
     * @param string $type
     */
    public function setBuyerParties(array $parties, $type = PartyCollectionNode::TYPE_DEFAULT)
    {
        $this->buyerParties->set($parties, $type);
    }

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\PartyNode $party
     * @param string $type
     */
    public function addBuyerParty(PartyNode $party, $type = PartyCollectionNode::TYPE_DEFAULT)
    {
        $this->buyerParties->add($party, $type);
    }

    /**
     *
     * @param string $type
     */
    public function getBuyerParties($type = PartyCollectionNode::TYPE_DEFAULT)
    {
        return $this->buyerParties->get($type);
    }

    /**
     *
     * @param array|\SE\Component\OpenTrans\Node\Order\PartyNode $parties
     * @param string $type
     */
    public function setInvoiceParties(array $parties, $type = PartyCollectionNode::TYPE_DEFAULT)
    {
        $this->invoiceParties->set($parties, $type);
    }

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\PartyNode $party
     * @param string $type
     */
    public function addInvoiceParty(PartyNode $party, $type = PartyCollectionNode::TYPE_DEFAULT)
    {
        $this->invoiceParties->add($party, $type);
    }

    /**
     *
     * @return \SE\Component\OpenTrans\Node\Order\PartyCollectionNode
     * @param string $type
     */
    public function getInvoiceParties($type = PartyCollectionNode::TYPE_DEFAULT)
    {
        return $this->invoiceParties->get($type);
    }

    /**
     *
     * @param array|\SE\Component\OpenTrans\Node\Order\PartyNode $parties
     * @param string $type
     */
    public function setSupplierParties(array $parties, $type = PartyCollectionNode::TYPE_DEFAULT)
    {
        $this->supplierParties->set($parties, $type);
    }

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\PartyNode $party
     * @param string $type
     */
    public function addSupplierParty(PartyNode $party, $type = PartyCollectionNode::TYPE_DEFAULT)
    {
        $this->supplierParties->add($party, $type);
    }

    /**
     *
     * @param string $type
     * @return \SE\Component\OpenTrans\Node\Order\PartyCollectionNode
     */
    public function getSupplierParties($type = PartyCollectionNode::TYPE_DEFAULT)
    {
        return $this->supplierParties->get($type);
    }

    /**
     *
     * @param array|\SE\Component\OpenTrans\Node\Order\PartyNode $parties
     * @param string $type
     */
    public function setShippingParties(array $parties, $type = PartyCollectionNode::TYPE_DEFAULT)
    {
        $this->shippingParties->set($parties, $type);
    }

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\PartyNode $party
     * @param string $type
     */
    public function addShippingParty(PartyNode $party, $type = PartyCollectionNode::TYPE_DEFAULT)
    {
        $this->shippingParties->add($party, $type);
    }

    /**
     *
     * @param string $type
     * @return \SE\Component\OpenTrans\Node\Order\PartyCollectionNode
     */
    public function getShippingParties($type = PartyCollectionNode::TYPE_DEFAULT)
    {
        return $this->shippingParties->get($type);
    }
}