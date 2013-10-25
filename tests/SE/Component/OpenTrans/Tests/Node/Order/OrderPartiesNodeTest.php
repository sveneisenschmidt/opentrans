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

        $this->assertEmpty($node->getBuyerParties()->get());
        $node->getBuyerParties()->set(array($party1, $party2));
        $this->assertCount(2, $node->getBuyerParties()->get());
        $this->assertSame(array($party1, $party2), $node->getBuyerParties()->get());

        $node->getBuyerParties()->add($party2);
        $this->assertCount(3, $node->getBuyerParties()->get());
        $this->assertSame(array($party1, $party2, $party2), $node->getBuyerParties()->get());
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

        $this->assertEmpty($node->getShippingParties()->get());
        $node->getShippingParties()->set(array($party1, $party2));
        $this->assertCount(2, $node->getShippingParties()->get());
        $this->assertSame(array($party1, $party2), $node->getShippingParties()->get());

        $node->getShippingParties()->add($party2);
        $this->assertCount(3, $node->getShippingParties()->get());
        $this->assertSame(array($party1, $party2, $party2), $node->getShippingParties()->get());
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

        $this->assertEmpty($node->getInvoiceParties()->get());
        $node->getInvoiceParties()->set(array($party1, $party2));
        $this->assertCount(2, $node->getInvoiceParties()->get());
        $this->assertSame(array($party1, $party2), $node->getInvoiceParties()->get());

        $node->getInvoiceParties()->add($party2);
        $this->assertCount(3, $node->getInvoiceParties()->get());
        $this->assertSame(array($party1, $party2, $party2), $node->getInvoiceParties()->get());
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

        $this->assertEmpty($node->getSupplierParties()->get());
        $node->getSupplierParties()->set(array($party1, $party2));
        $this->assertCount(2, $node->getSupplierParties()->get());
        $this->assertSame(array($party1, $party2), $node->getSupplierParties()->get());

        $node->getSupplierParties()->add($party2);
        $this->assertCount(3, $node->getSupplierParties()->get());
        $this->assertSame(array($party1, $party2, $party2), $node->getSupplierParties()->get());
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
        $node->getBuyerParties()->add($party1);

        $party2 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->getInvoiceParties()->add($party2);

        $party3 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->getSupplierParties()->add($party3);

        $party4 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->getShippingParties()->add($party4);

        $party5 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->getShippingParties()->add($party5, \SE\Component\OpenTrans\Node\Order\PartyCollectionNode::TYPE_FINAL_DELIVERY);

        $party6 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->getShippingParties()->add($party4, \SE\Component\OpenTrans\Node\Order\PartyCollectionNode::TYPE_DELIVERY);

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
        $this->assertEquals(array($party1), $actual->getBuyerParties()->get());
        $this->assertEquals(array($party2), $actual->getInvoiceParties()->get());
        $this->assertEquals(array($party3), $actual->getSupplierParties()->get());
        $this->assertEquals(array($party4), $actual->getShippingParties()->get());

        $this->assertEquals(
            array($party5),
            $actual->getShippingParties()->get(\SE\Component\OpenTrans\Node\Order\PartyCollectionNode::TYPE_FINAL_DELIVERY)
        );

        $this->assertEquals(
            array($party6),
            $actual->getShippingParties()->get(\SE\Component\OpenTrans\Node\Order\PartyCollectionNode::TYPE_DELIVERY)
        );

        // expected exception
        $actual->getShippingParties()->get($type = sha1(uniqid(microtime(true))));
    }
}