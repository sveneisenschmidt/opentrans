<?php

namespace SE\Component\OpenTrans\Tests\Node\Order;

use SE\Component\OpenTrans\Node\Order\OrderTagNode;

/**
 * @package SE\Component\OpenTrans\Tests
 * @author Jan Kahnt <j.kahnt@impericon.com>
 */
class OrderTagNodeTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\OrderTagNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_ORDERTAG);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderTagNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderTagNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function ConstructorArguments()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderTagNode(
            $value = sha1(uniqid(microtime(true)))
        );

        $this->assertEquals($value, $node->getValue());
    }

    /**
     *
     * @test
     */
    public function SetterAndGetter()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderTagNode();

        $node->setValue($value = sha1(uniqid(microtime(true))));
        $this->assertEquals($value, $node->getValue());
    }

    /**
     *
     * @test
     */
    public function SerializeAndDeserializeTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderTagNode();
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag(array('tag' => 'ORDERTAG'), $xml);

        $node->setValue($value = sha1(uniqid(microtime(true))));

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag($parent = array('tag' => 'ORDERTAG'), $xml);

        /* @var $actual \SE\Component\OpenTrans\Node\Order\RemarkNode */
        $actual = $serializer->deserialize($xml, get_class($node), 'xml');
        $this->assertEquals($value, $actual->getValue());
    }
}
