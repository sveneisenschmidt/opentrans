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
}