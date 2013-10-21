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

        $node->setCurrency($currency = sha1(microtime(true)));
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
        $payment = array(
            'bank_account' => ($bankAccount = rand(100000,9999999))
        );

        $this->assertEmpty($node->getPayment());
        $node->setPayment('cash', $payment);

        $this->assertEquals(array(
            'CASH' => array(
                'BANK_ACCOUNT' => $bankAccount
            )
        ), $node->getPayment());
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
}