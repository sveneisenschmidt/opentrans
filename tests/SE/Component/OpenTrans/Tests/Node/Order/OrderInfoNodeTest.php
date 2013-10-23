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
class OrderInfoNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\OrderInfoNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_ORDERINFO);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderInfoNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderInfoNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function SetterAndGetter()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderInfoNode();

        $node->setCurrency($currency = sha1(uniqid(microtime(true))));
        $this->assertEquals($currency, $node->getCurrency());

        $node->setOrderId($orderId = rand(1,1000000));
        $this->assertEquals($orderId, $node->getOrderId());

        $orderDate = new \DateTime(sprintf('@%s', rand(1, time())));
        $node->setOrderDate($orderDate);
        $this->assertSame($orderDate, $node->getOrderDate());

        $orderParties = new \SE\Component\OpenTrans\Node\Order\OrderPartiesNode();
        $node->setOrderParties($orderParties);
        $this->assertSame($orderParties, $node->getOrderParties());
    }

    /**
     *
     * @test
     */
    public function SetAndGetPayment()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderInfoNode();

        $this->assertEmpty($node->getPayment());
        $node->setPayment($payment = array(
            'cash' => array(
                'bank_account' => ($bankAccount = rand(100000,9999999))
            )
        ));
        $this->assertEquals($payment, $node->getPayment());
        $this->assertEquals(array('CASH' => array('BANK_ACCOUNT' => $bankAccount)), $node->getNormalizedPayment());

        $node->setPayment('cash');
        $this->assertEquals(array('cash' => null), $node->getPayment());
    }

    /**
     *
     * @test
     */
    public function SetAndGetRemark()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderInfoNode();

        $remark1 = new \SE\Component\OpenTrans\Node\Order\RemarkNode();
        $remark2 = new \SE\Component\OpenTrans\Node\Order\RemarkNode();

        $node->setRemarks(array($remark1, $remark2));
        $this->assertCount(2, $node->getRemarks());
        $this->assertSame(array($remark1, $remark2), $node->getRemarks());

        $node->addRemark($remark2);
        $this->assertCount(3, $node->getRemarks());
        $this->assertSame(array($remark1, $remark2, $remark2), $node->getRemarks());
    }

    /**
     *
     * @test
     */
    public function SerializeAndDeserializeTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderInfoNode();
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $content = $serializer->serialize($node, 'xml');
        $this->assertTag(array('tag' => 'ORDER_INFO', 'content' => ''), $content);

        $node->setCurrency($currency = sha1(uniqid(microtime(true))));
        $node->setOrderId($orderId = rand(1,1000000));
        $orderDate = new \DateTime(sprintf('@%s', rand(1, time())));
        $node->setOrderDate($orderDate);
        $orderParties = new \SE\Component\OpenTrans\Node\Order\OrderPartiesNode();
        $orderParties->addCustomEntry('placeholder', time());
        $node->setOrderParties($orderParties);

        $node->setPayment($payment = array(
            'cash' => array(
                'bank_account' => ($bankAccount = rand(100000,9999999))
            )
        ));

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag($parent = array(
            'tag' => 'ORDER_INFO', 'children' => array( 'count' => 5)
        ), $xml, $xml);

        $this->assertTag(array('parent' => $parent, 'tag' => 'ORDER_ID'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'ORDER_DATE'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'PRICE_CURRENCY'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'ORDER_PARTIES'), $xml);
        $this->assertTag($parent1 = array('parent' => $parent, 'tag' => 'PAYMENT'), $xml);
        $this->assertTag($parent2 = array('parent' => $parent1, 'tag' => 'CASH'), $xml);
        $this->assertTag(array('parent' => $parent2, 'tag' => 'BANK_ACCOUNT'), $xml);

        /* @var $actual \SE\Component\OpenTrans\Node\Order\OrderInfoNode */
        $actual = $serializer->deserialize($xml, get_class($node), 'xml');
        $this->assertInstanceOf(get_class($orderParties), $actual->getOrderParties());
        $this->assertEquals($orderDate, $actual->getOrderDate());
        $this->assertEquals($orderId, $actual->getOrderId());
        $this->assertEquals($currency, $actual->getCurrency());

        $this->markTestSkipped('XmlKeyValuePairs can not be deserialized, see https://github.com/schmittjoh/serializer/issues/139 ');

        $this->assertEmpty($actual->getPayment());
    }
}