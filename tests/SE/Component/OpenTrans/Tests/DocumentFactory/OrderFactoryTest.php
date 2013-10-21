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

    /**
     *
     * @test
     */
    public function FactoryLoadData()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $object = \SE\Component\OpenTrans\DocumentFactory\OrderFactory::create($loader);

        $data = array(
            'summary' => array(
                'total_item_count' => ($totalItemCount = 99)
            )
        );

        \SE\Component\OpenTrans\DocumentFactory\OrderFactory::load($loader, $object, $data);

        $this->assertEquals($totalItemCount, $object->getSummary()->getTotalItemCount());
    }

    /**
     *
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function FactoryLoadWrongDocument()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $stub = $this->getMockForAbstractClass('\SE\Component\OpenTrans\Node\NodeInterface');
        $data = array();

        \SE\Component\OpenTrans\DocumentFactory\OrderFactory::load($loader, $stub, $data);
    }

    /**
     *
     * @test
     */
    public function ConvertsAttributeNameToMethodName()
    {
        $attribute = 'my_test__attribute';
        $method    = \SE\Component\OpenTrans\DocumentFactory\OrderFactory::formatAttribute($attribute);

        $this->assertEquals('MyTestAttribute', $method);
    }
}