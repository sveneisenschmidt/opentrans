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
class ItemNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\ItemNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_ITEM);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ItemNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ItemNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function SetterAndGetterTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\ItemNode();

        $node->setLineId($lindeId = rand(10000,99999));
        $this->assertEquals($lindeId, $node->getLineId());

        $node->setQuantity($quantity = rand(10000,99999));
        $this->assertEquals($quantity, $node->getQuantity());

        $node->setArticleName($articleName = sha1(microtime(true)));
        $this->assertEquals($articleName, $node->getArticleName());

        $articleId = new \SE\Component\OpenTrans\Node\Order\ArticleIdNode();
        $node->setArticleId($articleId);
        $this->assertSame($articleId, $node->getArticleId());

        $articlePrice = new \SE\Component\OpenTrans\Node\Order\ArticlePriceNode();
        $node->setArticlePrice($articlePrice);
        $this->assertSame($articlePrice, $node->getArticlePrice());
    }
}