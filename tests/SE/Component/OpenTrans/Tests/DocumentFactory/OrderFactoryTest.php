<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\Tests\DocumentFactory;


/**
 *
 * @package SE\Component\OpenTrans\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class OrderFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function FactoryReturnsDocumentNode()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $object = \SE\Component\OpenTrans\DocumentFactory\OrderFactory::create($loader);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\DocumentNode', $object);
    }

    /**
     *
     * @test
     */
    public function FactoryBuildsHeaderNode()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $object = \SE\Component\OpenTrans\DocumentFactory\OrderFactory::create($loader);
        $header = $object->getHeader();

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\HeaderNode', $header);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ControlInfoNode', $header->getControlInfo());
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderInfoNode', $header->getOrderInfo());
    }

    /**
     *
     * @test
     */
    public function FactoryBuildsOrderInfoNode()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $object = \SE\Component\OpenTrans\DocumentFactory\OrderFactory::create($loader);
        $header = $object->getHeader();
        $orderInfo = $header->getOrderInfo();

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderInfoNode', $orderInfo);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderPartiesNode', $orderInfo->getOrderParties());
    }
}