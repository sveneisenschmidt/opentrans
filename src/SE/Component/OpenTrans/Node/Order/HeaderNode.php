<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\Node\Order;

use \JMS\Serializer\Annotation as Serializer;

use \SE\Component\OpenTrans\Node\AbstractNode;
use \SE\Component\OpenTrans\Node\Order\OrderInfoNode;
use \SE\Component\OpenTrans\Node\Order\ControlInfoNode;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * @Serializer\XmlRoot("ORDER_HEADER")
 * @Serializer\ExclusionPolicy("all")
 */
class HeaderNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("CONTROL_INFO")
     * @Serializer\Type("SE\Component\OpenTrans\Node\Order\ControlInfoNode")
     *
     * @var \SE\Component\OpenTrans\Node\Order\ControlInfoNode
     */
    protected $controlInfo;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("ORDER_INFO")
     * @Serializer\Type("SE\Component\OpenTrans\Node\Order\OrderInfoNode")
     *
     * @var \SE\Component\OpenTrans\Node\Order\OrderInfoNode
     */
    protected $orderInfo;

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\ControlInfoNode $controlInfo
     */
    public function setControlInfo(ControlInfoNode $controlInfo)
    {
        $this->controlInfo = $controlInfo;
    }

    /**
     *
     * @return \SE\Component\OpenTrans\Node\Order\ControlInfoNode
     */
    public function getControlInfo()
    {
        return $this->controlInfo;
    }

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\OrderInfoNode $orderInfo
     */
    public function setOrderInfo(OrderInfoNode $orderInfo)
    {
        $this->orderInfo = $orderInfo;
    }

    /**
     *
     * @return \SE\Component\OpenTrans\Node\Order\OrderInfoNode
     */
    public function getOrderInfo()
    {
        return $this->orderInfo;
    }
}