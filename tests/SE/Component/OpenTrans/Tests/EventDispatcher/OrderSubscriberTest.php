<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\Tests\EventDispatcher;

/**
 *
 * @package SE\Component\OpenTrans\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class OrderSubscriberTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function OnPreSerializePayment()
    {
        $event = new \SE\Component\OpenTrans\EventDispatcher\SerializeEvent();
        $subscriber = new \SE\Component\OpenTrans\EventDispatcher\OrderSubscriber();

        $document = new \SE\Component\OpenTrans\Node\Order\DocumentNode();
        $header = new \SE\Component\OpenTrans\Node\Order\HeaderNode();
        $info = new \SE\Component\OpenTrans\Node\Order\OrderInfoNode();

        $payment = array('cash' => array(
            'bank_account' => ($account = rand(1,time()))
        ));

        $document->setHeader($header);
        $header->setOrderInfo($info);
        $info->setPayment($payment);

        $event->setDocument($document);
        $subscriber->onPreSerializePayment($event);

        $this->assertEquals(array(
            'CASH' => array('BANK_ACCOUNT' => $account)
        ), $info->getPayment());
    }

    /**
     *
     * @test
     */
    public function OnPostSerializePayment()
    {
        $event = new \SE\Component\OpenTrans\EventDispatcher\SerializeEvent();
        $subscriber = new \SE\Component\OpenTrans\EventDispatcher\OrderSubscriber();

        $document = new \SE\Component\OpenTrans\Node\Order\DocumentNode();
        $header = new \SE\Component\OpenTrans\Node\Order\HeaderNode();
        $info = new \SE\Component\OpenTrans\Node\Order\OrderInfoNode();

        $payment = array('CASH' => array(
            'BANK_ACCOUNT' => ($account = rand(1,time()))
        ));

        $document->setHeader($header);
        $header->setOrderInfo($info);
        $info->setPayment($payment);

        $event->setDocument($document);
        $subscriber->onPostSerializePayment($event);

        $this->assertEquals(array(
            'cash' => array('bank_account' => $account)
        ), $info->getPayment());
    }
}