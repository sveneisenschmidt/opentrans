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
class PartyIdNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\PartyIdNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_PARTYID);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\PartyIdNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\PartyIdNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function SetterAndGetter()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\PartyIdNode();

        $node->setType($type = sha1(uniqid(microtime(true))));
        $this->assertEquals($type, $node->getType());

        $node->setValue($value = sha1(uniqid(microtime(true))));
        $this->assertEquals($value, $node->getValue());
    }

    /**
     *
     * @test
     */
    public function SerializeAndDeserializeTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\PartyIdNode();
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag(array('tag' => 'PARTY_ID'), $xml);

        $node->setType($type = sha1(uniqid(microtime(true))));
        $node->setValue($value =  sha1(uniqid(microtime(true))));

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag($parent = array(
            'tag' => 'PARTY_ID',
        ), $xml);

        $this->assertTag(array('tag' => 'PARTY_ID', 'attributes' => array('type' => $type)), $xml);

        /* @var $actual \SE\Component\OpenTrans\Node\Order\PartyIdNode */
        $actual = $serializer->deserialize($xml, get_class($node), 'xml');
        $this->assertEquals($type, $actual->getType());
        $this->assertEquals($value, $actual->getValue());
    }
}