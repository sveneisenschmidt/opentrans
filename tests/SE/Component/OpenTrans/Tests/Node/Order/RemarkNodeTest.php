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
class RemarkNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\RemarkNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_REMARK);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\RemarkNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\RemarkNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }
    /**
     *
     * @test
     */
    public function ConstructorArguments()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\RemarkNode(
            $type = sha1(microtime(true)),
            $value = sha1(microtime(true))
        );

        $this->assertEquals($type, $node->getType());
        $this->assertEquals($value, $node->getValue());
    }

    /**
     *
     * @test
     */
    public function SetterAndGetter()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\RemarkNode();

        $node->setType($type = sha1(microtime(true)));
        $this->assertEquals($type, $node->getType());

        $node->setValue($value = sha1(microtime(true)));
        $this->assertEquals($value, $node->getValue());
    }
}