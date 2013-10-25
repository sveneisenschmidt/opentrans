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
use \SE\Component\OpenTrans\Node\Order\PartyCollectionNode;

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
     * @var array|\SE\Component\OpenTrans\Node\Order\PartyNode
     */
    protected $buyerParties;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("SUPPLIER_PARTY")
     * @Serializer\Type("SE\Component\OpenTrans\Node\Order\PartyCollectionNode")
     * @Serializer\XmlList(inline=false)
     *
     * @var array|\SE\Component\OpenTrans\Node\Order\PartyNode
     */
    protected $supplierParties;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("INVOICE_PARTY")
     * @Serializer\Type("SE\Component\OpenTrans\Node\Order\PartyCollectionNode")
     * @Serializer\XmlList(inline=false)
     *
     * @var array|\SE\Component\OpenTrans\Node\Order\PartyNode
     */
    protected $invoiceParties;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("SHIPMENT_PARTIES")
     * @Serializer\Type("SE\Component\OpenTrans\Node\Order\PartyCollectionNode")
     * @Serializer\XmlList(inline=false)
     *
     * @var array|\SE\Component\OpenTrans\Node\Order\PartyNode
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
     * @return \SE\Component\OpenTrans\Node\Order\PartyCollectionNode
     */
    public function getBuyerParties()
    {
        return $this->buyerParties;
    }

    /**
     *
     * @return \SE\Component\OpenTrans\Node\Order\PartyCollectionNode
     */
    public function getInvoiceParties()
    {
        return $this->invoiceParties;
    }

    /**
     *
     * @return \SE\Component\OpenTrans\Node\Order\PartyCollectionNode
     */
    public function getSupplierParties()
    {
        return $this->supplierParties;
    }

    /**
     *
     * @return \SE\Component\OpenTrans\Node\Order\PartyCollectionNode
     */
    public function getShippingParties()
    {
        return $this->shippingParties;
    }
}