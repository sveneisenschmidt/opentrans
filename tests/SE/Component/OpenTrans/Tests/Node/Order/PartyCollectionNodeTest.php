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
class PartyCollectionNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\PartyCollectionNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_PARTYCOLLECTION);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\PartyCollectionNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\PartyCollectionNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\OpenTrans\Exception\UnknownPartyTypeException
     */
    public function UnknownTypeSet()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\PartyCollectionNode();

        $node->set(array(), $hash = sha1(uniqid(microtime(true))));
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\OpenTrans\Exception\UnknownPartyTypeException
     */
    public function UnknownTypeGet()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\PartyCollectionNode();
        $node->get($hash = sha1(uniqid(microtime(true))));
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\OpenTrans\Exception\UnknownPartyTypeException
     */
    public function UnknownTypeAdd()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\PartyCollectionNode();
        $node->add(new \SE\Component\OpenTrans\Node\Order\PartyNode(), $hash = sha1(uniqid(microtime(true))));
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\OpenTrans\Exception\UnknownPartyTypeException
     */
    public function SerializeAndDeserializeTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\PartyCollectionNode();
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $xml = $serializer->serialize($node, 'xml');

        $this->assertTag(array(
            'tag' => 'ORDER_PARTIES', 'content' => ''
        ), $xml, $xml);
        $party1 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->add($party1);

        $party2 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->add($party2);

        $party3 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->add($party3);

        $party4 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->add($party4);

        $party5 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->add($party5, \SE\Component\OpenTrans\Node\Order\PartyCollectionNode::TYPE_FINAL_DELIVERY);

        $party6 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node->add($party6, \SE\Component\OpenTrans\Node\Order\PartyCollectionNode::TYPE_DELIVERY);


        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag($parent = array(
            'tag' => 'ORDER_PARTIES', 'children' => array('count' => 6)
        ), $xml, $xml);

        $this->assertTag($parent1 = array('parent' => $parent, 'tag' => 'DELIVERY_PARTY'), $xml);
        $this->assertTag(array('parent' => $parent1, 'tag' => 'PARTY'), $xml);

        $this->assertTag($parent2 = array('parent' => $parent, 'tag' => 'FINAL_DELIVERY_PARTY'), $xml);
        $this->assertTag(array('parent' => $parent2, 'tag' => 'PARTY'), $xml);

        /* @var $actual \SE\Component\OpenTrans\Node\Order\PartyCollectionNode */
        $actual = $serializer->deserialize($xml, get_class($node), 'xml');
        $this->assertEquals(array($party1, $party2, $party3, $party4), $actual->get());

        $this->assertEquals(
            array($party5),
            $actual->get(\SE\Component\OpenTrans\Node\Order\PartyCollectionNode::TYPE_FINAL_DELIVERY)
        );

        $this->assertEquals(
            array($party6),
            $actual->get(\SE\Component\OpenTrans\Node\Order\PartyCollectionNode::TYPE_DELIVERY)
        );

        // expected exception
        $actual->get($type = sha1(uniqid(microtime(true))));
    }
}