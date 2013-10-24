<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\EventDispatcher;

use \Symfony\Component\EventDispatcher\EventSubscriberInterface;

use \SE\Component\OpenTrans\Util;
use \SE\Component\OpenTrans\Node\Order;
use \SE\Component\OpenTrans\EventDispatcher\DeserializeEvent;



class OrderSubscriber implements  EventSubscriberInterface
{
    public function __construct()
    {
        $this->encoder = new \Symfony\Component\Serializer\Encoder\XmlEncoder();
    }


    /**
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'document_node.post_deserialize' => array(
                array('onPostDeserialize', 1),
                array('onPostDeserializePayment', 10)
            ),
        );
    }

    /**
     *
     * @param \SE\Component\OpenTrans\EventDispatcher\DeserializeEvent $event
     */
    public function onPostDeserialize(DeserializeEvent $event)
    {

    }

    /**
     *
     * @param \SE\Component\OpenTrans\EventDispatcher\DeserializeEvent $event
     */
    public function onPostDeserializePayment(DeserializeEvent $event)
    {
        if(($document = $event->getDocument()) instanceof Order\DocumentNode === false) {
            return;
        } else
        if(($header = $document->getHeader()) === null) {
            return;
        } else
        if(($orderInfo = $header->getOrderInfo()) === null) {
            return;
        } else
        if(is_scalar($xml = $event->getData()) === false) {
            return;
        }

        $data = $this->encoder->decode($xml, 'xml');
        if(isset($data['ORDER_HEADER']) === false) {
            return;
        } else
        if(isset($data['ORDER_HEADER']['ORDER_INFO']) === false) {
            return;
        } else
        if(isset($data['ORDER_HEADER']['ORDER_INFO']['PAYMENT']) === false) {
            return;
        }

        $paymentData = $data['ORDER_HEADER']['ORDER_INFO']['PAYMENT'];
        if(is_array($paymentData) === true && empty($paymentData) === false) {
            $payment = Util::arrayChangeKeyCaseRecursive($paymentData, CASE_LOWER);
            $orderInfo->setPayment($payment);
        }
    }

}