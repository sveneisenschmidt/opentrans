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
        if( (($document     = $event->getDocument())    instanceof Order\DocumentNode   === true) &&
            (($header       = $document->getHeader())   instanceof Order\HeaderNode     === true) &&
            (($orderInfo    = $header->getOrderInfo())  instanceof Order\OrderInfoNode  === true)
        ) {
            $xml = $event->getData();
            $data = Util::arrayChangeKeyCaseRecursive(
                $this->encoder->decode($xml, 'xml'),
                CASE_LOWER
            );
            if( (isset($data['order_header']) === true) &&
                (isset($data['order_header']['order_info']) === true) &&
                (isset($data['order_header']['order_info']['payment']) === true)
            ) {
                $payment = $data['order_header']['order_info']['payment'];
                if(is_array($payment) === true && empty($payment) === false) {
                    $orderInfo->setPayment($payment);
                }
            }
        }
    }

}