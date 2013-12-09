<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\Tests\DocumentFactory;


/**
 *
 * @package SE\Component\OpenTrans\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class OrderFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function FactoryReturnsDocumentNode()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $factory = new \SE\Component\OpenTrans\DocumentFactory\OrderFactory($loader);
        $node  = $factory->createDocument();

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\DocumentNode', $node);
        $this->assertSame($loader, $factory->getLoader());
    }

    /**
     *
     * @test
     */
    public function FactoryBuildsHeaderNode()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $factory = new \SE\Component\OpenTrans\DocumentFactory\OrderFactory($loader);
        $node  = $factory->createDocument();
        $header = $node->getHeader();

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\HeaderNode', $header);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ControlInfoNode', $header->getControlInfo());
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderInfoNode', $header->getOrderInfo());
    }

    /**
     *
     * @test
     */
    public function FactoryBuildsOrderInfoNode()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $factory = new \SE\Component\OpenTrans\DocumentFactory\OrderFactory($loader);
        $node  = $factory->createDocument();
        $header = $node->getHeader();
        $orderInfo = $header->getOrderInfo();

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderInfoNode', $orderInfo);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderPartiesNode', $orderInfo->getOrderParties());
    }

    /**
     *
     * @test
     */
    public function FactoryBuildsPartyNode()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_PARTY);

        \SE\Component\OpenTrans\DocumentFactory\OrderFactory::buildOrderParty($loader, $node);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\PartyIdNode', $node->getPartyId());
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\AddressNode', $node->getAddress());
    }

    /**
     *
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function FactoryLoadWrongDocument()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $stub = $this->getMockForAbstractClass('\SE\Component\OpenTrans\Node\NodeInterface');
        $data = array();

        $factory = new \SE\Component\OpenTrans\DocumentFactory\OrderFactory($loader);
        $factory->load($stub, $data);
    }

    /**
     *
     * @test
     */
    public function FactoryLoadData()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $factory = new \SE\Component\OpenTrans\DocumentFactory\OrderFactory($loader);
        $object  = $factory->createDocument();

        $data = array(
            'header' => array(
                'control_info' => array(
                    'generator_info' => ($generatorInfo = sha1(uniqid(microtime(true))))
                ),
                'order_info' => array(
                    'order_id'      => ($orderId = rand(1000,1000000)),
                    'order_date'    => ($orderDate = new \DateTime(sprintf('@%s', rand(1, time())))),
                    'currency'      => ($currency = strtoupper(substr(sha1(uniqid(microtime(true))),0,3))),
                    'payment'       => ($payment = array(
                        'cash' => array(
                            'account' => rand(1000000,9000000)
                        )
                    )),
                    'remarks'       => array(
                        array(
                            'type' => ($remarkType = sha1(uniqid(microtime(true)))),
                            'value' => ($remarkValue = sha1(uniqid(microtime(true))))
                        )
                    ),
                    'order_parties' => array(
                        'buyer_parties' => array(
                            array(
                                'party_id' => array(
                                    'type' => 'buyer_specific',
                                    'value' => ($buyerEmail = sha1(uniqid(microtime(true))))
                                ),
                                'address' => array(
                                    'email' => $buyerEmail
                                )
                            )
                        ),
                        'supplier_parties' => array(
                            array(
                                'party_id' => array(
                                    'type' => 'supplier_specific',
                                    'value' => ($supplierEmail = sha1(uniqid(microtime(true))))
                                ),
                                'address' => array(
                                    'email' => $supplierEmail
                                )
                            )
                        ),
                        'invoice_parties' => array(
                            array(
                                'party_id' => array(
                                    'type' => 'invoice_specific',
                                    'value' => ($invoiceEmail = sha1(uniqid(microtime(true))))
                                ),
                                'address' => array(
                                    'email' => $invoiceEmail
                                )
                            )
                        ),
                        'shipping_parties' => array(
                            array(
                                'party_id' => array(
                                    'type' => 'shipping_specific',
                                    'value' => ($shippingEmail = sha1(uniqid(microtime(true))))
                                ),
                                'address' => array(
                                    'email' => $shippingEmail
                                )
                            )
                        )
                    )
                )
            ),
            'summary' => array(
                'total_item_count' => ($totalItemCount = 99)
            ),
            'custom_entry_1' => ($customEntry1 = sha1(uniqid(microtime(true)))),
            'items' => array(
                array(
                    'line_id'       => ($lineItemId1 = rand(1000,1000000)),
                    'quantity'      => ($quantity1 = rand(1000,1000000)),
                    'article_id'    => array(
                        'supplier_aid'      => ($articleSAId1 = sha1(uniqid(microtime(true)))),
                        'buyer_aid'         => ($articleBAId1 = sha1(uniqid(microtime(true)))),
                        'international_aid' => ($articleIAId1 = sha1(uniqid(microtime(true)))),
                        'description_short' => ($articleShort1 = sha1(uniqid(microtime(true)))),
                        'description_long'  => ($articleLong1 = sha1(uniqid(microtime(true)))),
                        'manufacturer_info' => ($articleInfo1 = sha1(uniqid(microtime(true)))),
                    ),
                    'article_price' => array(
                        'type'          => ($articleType1 = sha1(uniqid(microtime(true)))),
                        'full_price'    => ($articlePrice1 = rand(1,100)),
                        'price_amount'  =>  ($articlePrice1 * $quantity1),
                        'discount_percent'  => ($discountPercent1 = rand(1,100)),
                        'discount_value'    => ($discountValue1 = rand(1000,1000000)),
                    )
                ),
                array(
                    'line_id'       => ($lineItemId2 = rand(1000,1000000)),
                    'quantity'      => ($quantity2 = rand(1000,1000000)),
                    'article_id'    => array(
                        'supplier_aid'      => ($articleSAId2 = sha1(uniqid(microtime(true)))),
                        'buyer_aid'         => ($articleBAId2 = sha1(uniqid(microtime(true)))),
                        'international_aid' => ($articleIAId2 = sha1(uniqid(microtime(true)))),
                        'description_short' => ($articleShort2 = sha1(uniqid(microtime(true)))),
                        'description_long'  => ($articleLong2 = sha1(uniqid(microtime(true)))),
                        'manufacturer_info' => ($articleInfo2 = sha1(uniqid(microtime(true)))),
                    ),
                    'article_price' => array(
                        'type'              => ($articleType2 = sha1(uniqid(microtime(true)))),
                        'full_price'        => ($articlePrice2 = rand(1,100)),
                        'price_amount'      => ($articlePrice2 * $quantity2),
                        'discount_percent'  => ($discountPercent2 = rand(1,100)),
                        'discount_value'    => ($discountValue2 = rand(1000,1000000)),
                    )
                )
            )
        );

        /* @var $object \SE\Component\OpenTrans\Node\Order\DocumentNode */
        $factory->load($object, $data);

        $this->assertEquals($totalItemCount, $object->getSummary()->getTotalItemCount());
        $this->assertEquals(array('custom_entry_1' => $customEntry1), $object->getCustomEntries());

        $controlInfo = $object->getHeader()->getControlInfo();
        $this->assertNotNull($controlInfo);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ControlInfoNode', $controlInfo);
        $this->assertEquals($generatorInfo, $controlInfo->getGeneratorInfo());

        $orderInfo = $object->getHeader()->getOrderInfo();
        $this->assertNotNull($orderInfo);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderInfoNode', $orderInfo);
        $this->assertEquals($orderId, $orderInfo->getOrderId());
        $this->assertEquals($currency, $orderInfo->getCurrency());
        $this->assertSame($orderDate, $orderInfo->getOrderDate());
        $this->assertEquals($payment, $orderInfo->getPayment());

        $remarks = $orderInfo->getRemarks();
        $this->assertCount(1, $remarks);
        $remark = $remarks[key($remarks)];
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\RemarkNode', $remark);
        $this->assertEquals($remarkType, $remark->getType());
        $this->assertEquals($remarkValue, $remark->getValue());

        $orderParties = $orderInfo->getOrderParties();
        $this->assertNotNull($orderParties);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderPartiesNode', $orderParties);

        $buyerParties = $orderParties->getBuyerParties();
        $this->assertCount(1, $buyerParties);

        /* @var $buyerParty \SE\Component\OpenTrans\Node\Order\PartyNode */
        $buyerParty = $buyerParties[key($buyerParties)];
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\PartyNode', $buyerParty);
        $this->assertNotNull($buyerParty->getPartyId());
        $this->assertNotNull($buyerParty->getAddress());
        $this->assertEquals($buyerEmail, $buyerParty->getPartyId()->getValue());
        $this->assertEquals($buyerEmail, $buyerParty->getAddress()->getEmail());
        $this->assertEquals('buyer_specific', $buyerParty->getPartyId()->getType());

        $invoiceParties = $orderParties->getInvoiceParties();
        $this->assertCount(1, $invoiceParties);

        /* @var $invoiceParty \SE\Component\OpenTrans\Node\Order\PartyNode */
        $invoiceParty = $invoiceParties[key($invoiceParties)];
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\PartyNode', $invoiceParty);
        $this->assertNotNull($invoiceParty->getPartyId());
        $this->assertNotNull($invoiceParty->getAddress());
        $this->assertEquals($invoiceEmail, $invoiceParty->getPartyId()->getValue());
        $this->assertEquals($invoiceEmail, $invoiceParty->getAddress()->getEmail());
        $this->assertEquals('invoice_specific', $invoiceParty->getPartyId()->getType());

        $supplierParties = $orderParties->getSupplierParties();
        $this->assertCount(1, $supplierParties);

        /* @var $supplierParty \SE\Component\OpenTrans\Node\Order\PartyNode */
        $supplierParty = $supplierParties[key($supplierParties)];
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\PartyNode', $supplierParty);
        $this->assertNotNull($supplierParty->getPartyId());
        $this->assertNotNull($supplierParty->getAddress());
        $this->assertEquals($supplierEmail, $supplierParty->getPartyId()->getValue());
        $this->assertEquals($supplierEmail, $supplierParty->getAddress()->getEmail());
        $this->assertEquals('supplier_specific', $supplierParty->getPartyId()->getType());

        $shippingParties = $orderParties->getShippingParties();
        $this->assertCount(1, $shippingParties);

        /* @var $shippingParty \SE\Component\OpenTrans\Node\Order\PartyNode */
        $shippingParty = $shippingParties[key($shippingParties)];
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\PartyNode', $shippingParty);
        $this->assertNotNull($shippingParty->getPartyId());
        $this->assertNotNull($shippingParty->getAddress());
        $this->assertEquals($shippingEmail, $shippingParty->getPartyId()->getValue());
        $this->assertEquals($shippingEmail, $shippingParty->getAddress()->getEmail());
        $this->assertEquals('shipping_specific', $shippingParty->getPartyId()->getType());


        $items = $object->getItems();
        $this->assertCount(2, $items);

        /* @var $item1 \SE\Component\OpenTrans\Node\Order\ItemNode */
        $item1 = array_shift($items);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ItemNode', $item1);
        $this->assertEquals($lineItemId1, $item1->getLineId());
        $this->assertEquals($quantity1, $item1->getQuantity());

        /* @var $articleNodeId1 \SE\Component\OpenTrans\Node\Order\ArticleIdNode */
        $articleNodeId1 = $item1->getArticleId();
        $this->assertNotNull($articleNodeId1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ArticleIdNode', $articleNodeId1);
        $this->assertEquals($articleSAId1, $articleNodeId1->getSupplierAid());
        $this->assertEquals($articleBAId1, $articleNodeId1->getBuyerAid());
        $this->assertEquals($articleIAId1, $articleNodeId1->getInternationalAid());
        $this->assertEquals($articleShort1, $articleNodeId1->getDescriptionShort());
        $this->assertEquals($articleLong1, $articleNodeId1->getDescriptionLong());
        $this->assertEquals($articleInfo1, $articleNodeId1->getManufacturerInfo());

        /* @var $articlePriceNode1 \SE\Component\OpenTrans\Node\Order\ArticlePriceNode */
        $articlePriceNode1 = $item1->getArticlePrice();
        $this->assertNotNull($articlePriceNode1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ArticlePriceNode', $articlePriceNode1);
        $this->assertEquals($discountPercent1, $articlePriceNode1->getDiscountPercent());
        $this->assertEquals($discountValue1, $articlePriceNode1->getDiscountValue());
        $this->assertEquals($articlePrice1, $articlePriceNode1->getFullPrice());
        $this->assertEquals(($articlePrice1 * $quantity1), $articlePriceNode1->getPriceAmount());
        $this->assertEquals($articleType1, $articlePriceNode1->getType());

        /* @var $item1 \SE\Component\OpenTrans\Node\Order\ItemNode */
        $item2 = array_shift($items);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ItemNode', $item2);
        $this->assertEquals($lineItemId2, $item2->getLineId());
        $this->assertEquals($quantity2, $item2->getQuantity());

        /* @var $articleNodeId1 \SE\Component\OpenTrans\Node\Order\ArticleIdNode */
        $articleNodeId2 = $item2->getArticleId();
        $this->assertNotNull($articleNodeId2);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ArticleIdNode', $articleNodeId2);
        $this->assertEquals($articleSAId2, $articleNodeId2->getSupplierAid());
        $this->assertEquals($articleBAId2, $articleNodeId2->getBuyerAid());
        $this->assertEquals($articleIAId2, $articleNodeId2->getInternationalAid());
        $this->assertEquals($articleShort2, $articleNodeId2->getDescriptionShort());
        $this->assertEquals($articleLong2, $articleNodeId2->getDescriptionLong());
        $this->assertEquals($articleInfo2, $articleNodeId2->getManufacturerInfo());

        /* @var $articlePriceNode1 \SE\Component\OpenTrans\Node\Order\ArticlePriceNode */
        $articlePriceNode2 = $item2->getArticlePrice();
        $this->assertNotNull($articlePriceNode2);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ArticlePriceNode', $articlePriceNode2);
        $this->assertEquals($discountPercent2, $articlePriceNode2->getDiscountPercent());
        $this->assertEquals($discountValue2, $articlePriceNode2->getDiscountValue());
        $this->assertEquals($articlePrice2, $articlePriceNode2->getFullPrice());
        $this->assertEquals(($articlePrice2 * $quantity2), $articlePriceNode2->getPriceAmount());
        $this->assertEquals($articleType2, $articlePriceNode2->getType());
    }
}
