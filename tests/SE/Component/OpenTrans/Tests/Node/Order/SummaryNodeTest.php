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
class SummaryNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\SummaryNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_SUMMARY);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\SummaryNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\SummaryNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function SetterAndGetter()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\SummaryNode();

        $node->setTotalItemCount($totalItemCount = rand(10,100));
        $this->assertEquals($totalItemCount, $node->getTotalItemCount());
    }

    /**
     *
     * @test
     */
    public function SerializeAndDeserializeTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\SummaryNode();
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag(array('tag' => 'ORDER_SUMMARY'), $xml, $xml);

        $node->setTotalItemCount($totalItemCount = rand(10,100));

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag($parent = array('tag' => 'ORDER_SUMMARY'), $xml, $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'TOTAL_ITEM_NUM'), $xml, $xml);

        /* @var $actual \SE\Component\OpenTrans\Node\Order\SummaryNode */
        $actual = $serializer->deserialize($xml, get_class($node), 'xml');
        $this->assertEquals($totalItemCount, $actual->getTotalItemCount());
    }
}