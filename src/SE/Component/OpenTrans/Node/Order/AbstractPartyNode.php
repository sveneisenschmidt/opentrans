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
use \SE\Component\OpenTrans\Node\Order\PartyIdNode;
use \SE\Component\OpenTrans\Node\Order\AddressNode;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * @Serializer\XmlRoot("PARTY")
 * @Serializer\ExclusionPolicy("all")
 */
class AbstractPartyNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("IS_DELIVERY_PARTY")
     * @Serializer\Type("boolean")
     *
     * @var boolean
     */
    protected $isDeliveryParty = false;

    /**
     *
     * @param boolean $isDeliveryParty
     */
    public function setIsDeliveryParty($isDeliveryParty)
    {
        $this->isDeliveryParty = $isDeliveryParty;
    }

    /**
     *
     * @return boolean
     */
    public function getIsDeliveryParty()
    {
        return $this->isDeliveryParty;
    }
}