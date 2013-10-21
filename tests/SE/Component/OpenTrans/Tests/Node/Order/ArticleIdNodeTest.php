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
class ArticleIdNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\ArticleIdNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_ARTICLEID);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ArticleIdNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ArticleIdNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function ScalarSetterAndGetterTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\ArticleIdNode();

        $node->setId($id = sha1(microtime(true)));
        $this->assertEquals($id, $node->getId());

        $node->setName($name = sha1(microtime(true)));
        $this->assertEquals($name, $node->getName());

        $node->setNote($note = sha1(microtime(true)));
        $this->assertEquals($note, $node->getNote());
    }
}