<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\Tests\Node\Order;

/**
 *
 * @package SE\Component\OpenTrans\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class OrderPartiesNode extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\OrderPartiesNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_PARTIES);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderPartiesNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderPartiesNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function SetAndGetBuyerParties()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderPartiesNode();

        $party1 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $party2 = new \SE\Component\OpenTrans\Node\Order\PartyNode();

        $this->assertEmpty($node->getBuyerParties());
        $node->setBuyerParties(array($party1, $party2));
        $this->assertCount(2, $node->getBuyerParties());
        $this->assertSame(array($party1, $party2), $node->getBuyerParties());

        $node->addBuyerParty($party2);
        $this->assertCount(3, $node->getBuyerParties());
        $this->assertSame(array($party1, $party2, $party2), $node->getBuyerParties());
    }

    /**
     *
     * @test
     */
    public function SetAndGetShippingParties()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderPartiesNode();

        $party1 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $party2 = new \SE\Component\OpenTrans\Node\Order\PartyNode();

        $this->assertEmpty($node->getShippingParties());
        $node->setShippingParties(array($party1, $party2));
        $this->assertCount(2, $node->getShippingParties());
        $this->assertSame(array($party1, $party2), $node->getShippingParties());

        $node->addShippingParty($party2);
        $this->assertCount(3, $node->getShippingParties());
        $this->assertSame(array($party1, $party2, $party2), $node->getShippingParties());
    }

    /**
     *
     * @test
     */
    public function SetAndGetInvoiceParties()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderPartiesNode();

        $party1 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $party2 = new \SE\Component\OpenTrans\Node\Order\PartyNode();

        $this->assertEmpty($node->getInvoiceParties());
        $node->setInvoiceParties(array($party1, $party2));
        $this->assertCount(2, $node->getInvoiceParties());
        $this->assertSame(array($party1, $party2), $node->getInvoiceParties());

        $node->addInvoiceParty($party2);
        $this->assertCount(3, $node->getInvoiceParties());
        $this->assertSame(array($party1, $party2, $party2), $node->getInvoiceParties());
    }

    /**
     *
     * @test
     */
    public function SetAndGetSupplierParties()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderPartiesNode();

        $party1 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $party2 = new \SE\Component\OpenTrans\Node\Order\PartyNode();

        $this->assertEmpty($node->getSupplierParties());
        $node->setSupplierParties(array($party1, $party2));
        $this->assertCount(2, $node->getSupplierParties());
        $this->assertSame(array($party1, $party2), $node->getSupplierParties());

        $node->addSupplierParty($party2);
        $this->assertCount(3, $node->getSupplierParties());
        $this->assertSame(array($party1, $party2, $party2), $node->getSupplierParties());
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\OpenTrans\Exception\UnknownPartyTypeException
     */
    public function SerializeAndDeserializeTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderPartiesNode();
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag(array(
            'tag' => 'ORDER_PARTIES', 'content' => ''
        ), $xml, $xml);

        $party1 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->addBuyerParty($party1);

        $party2 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->addInvoiceParty($party2);

        $party3 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->addSupplierParty($party3);

        $party4 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->addShippingParty($party4);

        $party5 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->addShippingParty($party5, \SE\Component\OpenTrans\Node\Order\PartyCollectionNode::TYPE_FINAL_DELIVERY);

        $party6 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->addShippingParty($party6, \SE\Component\OpenTrans\Node\Order\PartyCollectionNode::TYPE_DELIVERY);

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag($parent = array(
            'tag' => 'ORDER_PARTIES', 'children' => array( 'count' => 4)
        ), $xml, $xml);

        $this->assertTag($parent1 = array('parent' => $parent, 'tag' => 'BUYER_PARTY'), $xml);
        $this->assertTag(array('parent' => $parent1, 'tag' => 'PARTY'), $xml);
        $this->assertTag($parent2 = array('parent' => $parent, 'tag' => 'SUPPLIER_PARTY'), $xml);
        $this->assertTag(array('parent' => $parent2, 'tag' => 'PARTY'), $xml);
        $this->assertTag($parent3 = array('parent' => $parent, 'tag' => 'INVOICE_PARTY'), $xml);
        $this->assertTag(array('parent' => $parent3, 'tag' => 'PARTY'), $xml);
        $this->assertTag($parent4 = array('parent' => $parent, 'tag' => 'SHIPMENT_PARTIES', 'children' => array( 'count' => 3)), $xml);

        $this->assertTag(array('parent' => $parent4, 'tag' => 'PARTY'), $xml);
        $this->assertTag(array('parent' => $parent4, 'tag' => 'DELIVERY_PARTY'), $xml);
        $this->assertTag($parent5 = array('parent' => $parent4, 'tag' => 'FINAL_DELIVERY_PARTY'), $xml);
        $this->assertTag(array('parent' => $parent5, 'tag' => 'PARTY'), $xml);

        /* @var $actual \SE\Component\OpenTrans\Node\Order\OrderPartiesNode */
        $actual = $serializer->deserialize($xml, get_class($node), 'xml');
        $this->assertEquals(array($party1), $actual->getBuyerParties());
        $this->assertEquals(array($party2), $actual->getInvoiceParties());
        $this->assertEquals(array($party3), $actual->getSupplierParties());
        $this->assertEquals(array($party4), $actual->getShippingParties());

        $this->assertEquals(
            array($party5),
            $actual->getShippingParties(\SE\Component\OpenTrans\Node\Order\PartyCollectionNode::TYPE_FINAL_DELIVERY)
        );

        $this->assertEquals(
            array($party6),
            $actual->getShippingParties(\SE\Component\OpenTrans\Node\Order\PartyCollectionNode::TYPE_DELIVERY)
        );

        // expected exception
        $actual->getShippingParties($type = sha1(uniqid(microtime(true))));
    }
}