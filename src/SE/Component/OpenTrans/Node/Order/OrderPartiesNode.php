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

use \JMS\Serializer\Annotation as Serializer;

use \SE\Component\OpenTrans\Node\AbstractNode;

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
     * @Serializer\Type("array<SE\Component\OpenTrans\Node\Order\PartyNode>")
     * @Serializer\XmlList(inline=false, entry="PARTY")
     *
     * @var array|\SE\Component\OpenTrans\Node\Order\PartyNode
     */
    protected $buyerParties = array();

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("SUPPLIER_PARTY")
     * @Serializer\Type("array<SE\Component\OpenTrans\Node\Order\PartyNode>")
     * @Serializer\XmlList(inline=false, entry="PARTY")
     *
     * @var array|\SE\Component\OpenTrans\Node\Order\PartyNode
     */
    protected $supplierParties = array();

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("INVOICE_PARTY")
     * @Serializer\Type("array<SE\Component\OpenTrans\Node\Order\PartyNode>")
     * @Serializer\XmlList(inline=false, entry="PARTY")
     *
     * @var array|\SE\Component\OpenTrans\Node\Order\PartyNode
     */
    protected $invoiceParties = array();

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("SHIPMENT_PARTIES")
     * @Serializer\Type("array<SE\Component\OpenTrans\Node\Order\PartyNode>")
     * @Serializer\XmlList(inline=false, entry="PARTY")
     *
     * @var array|\SE\Component\OpenTrans\Node\Order\PartyNode
     */
    protected $shippingParties = array();

    /**
     *
     * @param array|\SE\Component\OpenTrans\Node\Order\PartyNode $buyerParties
     */
    public function setBuyerParties(array $buyerParties)
    {
        $this->buyerParties = $buyerParties;
    }

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\PartyNode $buyerParty
     */
    public function addBuyerParty(PartyNode $buyerParty)
    {
        $this->buyerParties []= $buyerParty;
    }


    /**
     *
     * @return array|\SE\Component\OpenTrans\Node\Order\PartyNode
     */
    public function getBuyerParties()
    {
        return $this->buyerParties;
    }

    /**
     *
     * @param array|\SE\Component\OpenTrans\Node\Order\PartyNode $invoiceParties
     */
    public function setInvoiceParties(array $invoiceParties)
    {
        $this->invoiceParties = $invoiceParties;
    }

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\PartyNode $invoiceParty
     */
    public function addInvoiceParty(PartyNode $invoiceParty)
    {
        $this->invoiceParties []= $invoiceParty;
    }

    /**
     *
     * @return array|\SE\Component\OpenTrans\Node\Order\PartyNode
     */
    public function getInvoiceParties()
    {
        return $this->invoiceParties;
    }

    /**
     *
     * @param array|\SE\Component\OpenTrans\Node\Order\PartyNode $supplierParties
     */
    public function setSupplierParties(array $supplierParties)
    {
        $this->supplierParties = $supplierParties;
    }

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\PartyNode $supplierParty
     */
    public function addSupplierParty(PartyNode $supplierParty)
    {
        $this->supplierParties []= $supplierParty;
    }

    /**
     *
     * @return array|\SE\Component\OpenTrans\Node\Order\PartyNode
     */
    public function getSupplierParties()
    {
        return $this->supplierParties;
    }

    /**
     *
     * @param array|\SE\Component\OpenTrans\Node\Order\PartyNode $shippingParties
     */
    public function setShippingParties(array $shippingParties)
    {
        $this->shippingParties = $shippingParties;
    }

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\PartyNode $shippingParty
     */
    public function addShippingParty(PartyNode $shippingParty)
    {
        $this->shippingParties []= $shippingParty;
    }

    /**
     *
     * @return array|\SE\Component\OpenTrans\Node\Order\PartyNode
     */
    public function getShippingParties()
    {
        return $this->shippingParties;
    }


}