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
        $object = \SE\Component\OpenTrans\DocumentFactory\OrderFactory::create($loader);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\DocumentNode', $object);
    }

    /**
     *
     * @test
     */
    public function FactoryBuildsHeaderNode()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $object = \SE\Component\OpenTrans\DocumentFactory\OrderFactory::create($loader);
        $header = $object->getHeader();

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
        $object = \SE\Component\OpenTrans\DocumentFactory\OrderFactory::create($loader);
        $header = $object->getHeader();
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
        $object = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_PARTY);

        \SE\Component\OpenTrans\DocumentFactory\OrderFactory::buildOrderParty($loader, $object);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\PartyIdNode', $object->getPartyId());
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\AddressNode', $object->getAddress());
    }

    /**
     *
     * @test
     */
    public function FactoryLoadData()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $object = \SE\Component\OpenTrans\DocumentFactory\OrderFactory::create($loader);

        $data = array(
            'header' => array(
                'control_info' => array(
                    'generator_info' => ($generatorInfo = sha1(uniqid(microtime(true)))),
                ),
                'order_info' => array(
                    'order_id' => ($orderId = rand(1000,1000000)),
                    'currency' => ($currency = strtoupper(substr(sha1(uniqid(microtime(true))),0,3))),
                    'payment'  => array(
                        'cash'
                    ),
                    'remarks' => array(
                        array(
                            'type' => ($remarkType = sha1(uniqid(microtime(true)))),
                            'value' => ($remarkText = sha1(uniqid(microtime(true))))
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
                                'is_delivery_party' => true,
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
                        'id'    => ($articleId1 = sha1(uniqid(microtime(true)))),
                        'name'  => ($articleName1 = sha1(uniqid(microtime(true)))),
                        'note'  => ($articleNote1 = 'Size:'.sha1(uniqid(microtime(true))).';'),
                    ),
                    'article_price' => array(
                        'type'          => ($articleType1 = sha1(uniqid(microtime(true)))),
                        'full_price'    => ($articlePrice1 = rand(1,100)),
                        'price_amount'  =>  ($articlePrice1 * $quantity1),
                    )
                ),
                array(
                    'line_id'       => ($lineItemId2 = rand(1000,1000000)),
                    'quantity'      => ($quantity2 = rand(1000,1000000)),
                    'article_id'    => array(
                        'id'    => ($articleId2 = sha1(uniqid(microtime(true)))),
                        'name'  => ($articleName2 = sha1(uniqid(microtime(true)))),
                        'note'  => ($articleNote2 = 'Size:'.sha1(uniqid(microtime(true))).';'),
                    ),
                    'article_price' => array(
                        'type'              => ($articleType2 = sha1(uniqid(microtime(true)))),
                        'full_price'        => ($articlePrice2 = rand(1,100)),
                        'price_amount'      =>  ($articlePrice2 * $quantity2),
                        'discount_percent'  => ($discountPercent2 = rand(1,100)),
                        'discount_value'   => ($discountValue2 = rand(1000,1000000)),
                    )
                )
            )
        );

        \SE\Component\OpenTrans\DocumentFactory\OrderFactory::load($loader, $object, $data);


        $this->assertEquals($totalItemCount, $object->getSummary()->getTotalItemCount());
        $this->assertEquals(array('custom_entry_1' => $customEntry1), $object->getCustomEntries());
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

        \SE\Component\OpenTrans\DocumentFactory\OrderFactory::load($loader, $stub, $data);
    }
}