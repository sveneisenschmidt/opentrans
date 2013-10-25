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
class DocumentNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\DocumentNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_DOCUMENT);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\DocumentNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\DocumentNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function SetterAndGetterTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\DocumentNode();

        $node->setVersion($version = '1.'.rand(1,10));
        $this->assertEquals($version, $node->getVersion());

        $node->setType($type = sha1(uniqid(microtime(true))));
        $this->assertEquals($type, $node->getType());

        $header = new \SE\Component\OpenTrans\Node\Order\HeaderNode();
        $node->setHeader($header);
        $this->assertSame($header, $node->getHeader());

        $summary = new \SE\Component\OpenTrans\Node\Order\SummaryNode();
        $node->setSummary($summary);
        $this->assertSame($summary, $node->getSummary());
    }

    /**
     *
     * @test
     */
    public function SetAndGetItems()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\DocumentNode();

        $item1 = new \SE\Component\OpenTrans\Node\Order\ItemNode();
        $item2 = new \SE\Component\OpenTrans\Node\Order\ItemNode();

        $this->assertEmpty($node->getItems());

        $node->setItems(array($item1, $item2));
        $this->assertCount(2, $node->getItems());
        $this->assertEquals($node->getItems(), array($item1, $item2));

        $node->addItem($item2);
        $this->assertCount(3, $node->getItems());
        $this->assertEquals($node->getItems(), array($item1, $item2, $item2));
    }

    /**
     *
     * @test
     */
    public function SerializeAndDeserializeTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\DocumentNode();
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $content = $serializer->serialize($node, 'xml');
        $this->assertTag(array('tag' => 'ORDER', 'content' => ''), $content);

        $node->setVersion($version = '1.'.rand(1,10));
        $node->setType($type = sha1(uniqid(microtime(true))));
        $header = new \SE\Component\OpenTrans\Node\Order\HeaderNode();
        $header->addCustomEntry('placeholder', time());
        $node->setHeader($header);
        $summary = new \SE\Component\OpenTrans\Node\Order\SummaryNode();
        $summary->addCustomEntry('placeholder', time());
        $node->setSummary($summary);

        $item1 = new \SE\Component\OpenTrans\Node\Order\ItemNode();
        $node->addItem($item1);

        $item2 = new \SE\Component\OpenTrans\Node\Order\ItemNode();
        $node->addItem($item2);

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag($parent = array(
            'tag' => 'ORDER', 'children' => array( 'count' => 3)
        ), $xml);

        $this->assertTag(array('parent' => $parent, 'tag' => 'ORDER_HEADER'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'ORDER_SUMMARY'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'ORDER_ITEM_LIST'), $xml);
        $this->assertTag(array('tag' => 'ORDER', 'attributes' => array('version' => $version)), $xml);
        $this->assertTag(array('tag' => 'ORDER', 'attributes' => array('type' => $type)), $xml);

        /* @var $actual \SE\Component\OpenTrans\Node\Order\DocumentNode */
        $actual = $serializer->deserialize($xml, get_class($node), 'xml');
        $this->assertInstanceOf(get_class($summary), $actual->getSummary());
        $this->assertInstanceOf(get_class($header), $actual->getHeader());
        $this->assertEquals($type, $actual->getType());
        $this->assertEquals($version, $actual->getVersion());
    }
}