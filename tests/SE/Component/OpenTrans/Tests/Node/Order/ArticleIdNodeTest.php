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

        $node->setSupplierAid($supplierAid = sha1(uniqid(microtime(true))));
        $this->assertEquals($supplierAid, $node->getSupplierAid());

        $node->setBuyerAid($buyerAid = sha1(uniqid(microtime(true))));
        $this->assertEquals($buyerAid, $node->getBuyerAid());

        $node->setInternationalAid($internationalAid = sha1(uniqid(microtime(true))));
        $this->assertEquals($internationalAid, $node->getInternationalAid());

        $node->setSupplierAid($supplierAid = sha1(uniqid(microtime(true))));
        $this->assertEquals($supplierAid, $node->getSupplierAid());

        $node->setDescriptionShort($short = sha1(uniqid(microtime(true))));
        $this->assertEquals($short, $node->getDescriptionShort());

        $node->setDescriptionLong($long = sha1(uniqid(microtime(true))));
        $this->assertEquals($long, $node->getDescriptionLong());

        $node->setManufacturerInfo($info = sha1(uniqid(microtime(true))));
        $this->assertEquals($info, $node->getManufacturerInfo());
    }
}