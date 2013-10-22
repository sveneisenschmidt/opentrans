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
class PartyNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_PARTY);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\PartyNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\PartyNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function SetterAndGetter()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\PartyNode();

        $address = new \SE\Component\OpenTrans\Node\Order\AddressNode();
        $node->setAddress($address);
        $this->assertSame($address, $node->getAddress());

        $partyId = new \SE\Component\OpenTrans\Node\Order\PartyIdNode();
        $node->setPartyId($partyId);
        $this->assertSame($partyId, $node->getPartyId());

        $node->setIsDeliveryParty($isDeliveryParty = (bool)rand(0,1));
        $this->assertEquals($isDeliveryParty, $node->getIsDeliveryParty());
    }
}