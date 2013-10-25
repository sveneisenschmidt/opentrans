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
}