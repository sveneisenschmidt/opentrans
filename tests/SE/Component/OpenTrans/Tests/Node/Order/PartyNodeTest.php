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
    }

    /**
     *
     * @test
     */
    public function SerializeAndDeserializeTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag(array('tag' => 'PARTY'), $xml);

        $partyId = new \SE\Component\OpenTrans\Node\Order\PartyIdNode();
        $partyId->setValue($id = rand(0,time()));
        $node->setPartyId($partyId);

        $address = new \SE\Component\OpenTrans\Node\Order\AddressNode();
        $address->setName1($name = sha1(uniqid(microtime(true))));
        $node->setAddress($address);

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag($parent = array(
            'tag' => 'PARTY',
        ), $xml);

        $this->assertTag(array('parent' => $parent, 'tag' => 'PARTY_ID'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'ADDRESS'), $xml);

        /* @var $actual \SE\Component\OpenTrans\Node\Order\PartyNode */
        $actual = $serializer->deserialize($xml, get_class($node), 'xml');
        $this->assertEquals($partyId, $actual->getPartyId());
        $this->assertEquals($address, $actual->getAddress());
    }
}