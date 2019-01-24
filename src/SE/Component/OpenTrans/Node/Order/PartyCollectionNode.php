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

use JMS\Serializer\Annotation as Serializer;

use SE\Component\OpenTrans\Node\AbstractNode;
use SE\Component\OpenTrans\Node\Order\PartyNode;
use SE\Component\OpenTrans\Exception\UnknownPartyTypeException;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * @Serializer\XmlRoot("ORDER_PARTIES")
 * @Serializer\ExclusionPolicy("all")
 */
class PartyCollectionNode extends AbstractNode
{

    const TYPE_DEFAULT          = 'defaultParties';
    const TYPE_DELIVERY         = 'deliveryParties';
    const TYPE_FINAL_DELIVERY   = 'deliveryFinalParties';

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<SE\Component\OpenTrans\Node\Order\PartyNode>")
     * @Serializer\XmlList(inline=true, entry="PARTY")
     *
     * @var array|\SE\Component\OpenTrans\Node\Order\PartyNode[]
     */
    protected $defaultParties = array();

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("DELIVERY_PARTY")
     * @Serializer\Type("array<SE\Component\OpenTrans\Node\Order\PartyNode>")
     * @Serializer\XmlList(inline=false, entry="PARTY")
     *
     * @var array|\SE\Component\OpenTrans\Node\Order\PartyNode[]
     */
    protected $deliveryParties = array();

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("FINAL_DELIVERY_PARTY")
     * @Serializer\Type("array<SE\Component\OpenTrans\Node\Order\PartyNode>")
     * @Serializer\XmlList(inline=false, entry="PARTY")
     *
     * @var array|\SE\Component\OpenTrans\Node\Order\PartyNode[]
     */
    protected $deliveryFinalParties = array();

    /**
     *
     * @param array|\SE\Component\OpenTrans\Node\Order\PartyNode[] $parties
     * @param string $type
     * @throws \SE\Component\OpenTrans\Exception\UnknownPartyTypeException
     * @return void
     */
    public function set(array $parties, $type = self::TYPE_DEFAULT)
    {
        if(isset($this->{$type}) === false) {
            throw new UnknownPartyTypeException(sprintf('Unknown party type %s.', $type));
        }

        $this->{$type} = $parties;
    }

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\PartyNode $party
     * @param string $type
     * @throws \SE\Component\OpenTrans\Exception\UnknownPartyTypeException
     * @return void
     */
    public function add(PartyNode $party, $type = self::TYPE_DEFAULT)
    {
        if(isset($this->{$type}) === false) {
            throw new UnknownPartyTypeException(sprintf('Unknown party type %s.', $type));
        }

        $this->{$type} []= $party;
    }

    /**
     *
     * @param string $type
     * @throws \SE\Component\OpenTrans\Exception\UnknownPartyTypeException
     * @return array|\SE\Component\OpenTrans\Node\Order\PartyNode[]
     */
    public function get($type = self::TYPE_DEFAULT)
    {
        if(isset($this->{$type}) === false) {
            throw new UnknownPartyTypeException(sprintf('Unknown party type %s.', $type));
        }

        return $this->{$type};
    }
}