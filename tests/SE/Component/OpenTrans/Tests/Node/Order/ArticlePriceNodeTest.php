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
class ArticlePriceNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\ArticlePriceNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_ARTICLEPRICE);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ArticlePriceNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ArticlePriceNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function ScalarSetterAndGetterTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\ArticlePriceNode();

        $node->setType($type = sha1(uniqid(microtime(true))));
        $this->assertEquals($type, $node->getType());

        $node->setDiscountPercent($discountPercent = rand(1,100));
        $this->assertEquals($discountPercent, $node->getDiscountPercent());

        $node->setDiscountValue($discountValue = rand(1,100));
        $this->assertEquals($discountValue, $node->getDiscountValue());

        $node->setFullPrice($fullPrice = rand(100,1000));
        $this->assertEquals($fullPrice, $node->getFullPrice());

        $node->setPriceAmount($priceAmount = rand(100,1000));
        $this->assertEquals($priceAmount, $node->getPriceAmount());
    }
}