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
class PartyNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("PARTY_ID")
     * @Serializer\Type("SE\Component\OpenTrans\Node\Order\PartyIdNode")
     *
     * @var \SE\Component\OpenTrans\Node\Order\PartyIdNode
     */
    protected $partyId;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("ADDRESS")
     * @Serializer\Type("SE\Component\OpenTrans\Node\Order\AddressNode")
     *
     * @var \SE\Component\OpenTrans\Node\Order\AddressNode
     */
    protected $address;

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\PartyIdNode $partyId
     */
    public function setPartyId(PartyIdNode $partyId)
    {
        $this->partyId = $partyId;
    }

    /**
     *
     * @return string
     */
    public function getPartyId()
    {
        return $this->partyId;
    }

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\AddressNode $address
     */
    public function setAddress(AddressNode $address)
    {
        $this->address = $address;
    }

    /**
     *
     * @return \SE\Component\OpenTrans\Node\Order\AddressNode
     */
    public function getAddress()
    {
        return $this->address;
    }
}