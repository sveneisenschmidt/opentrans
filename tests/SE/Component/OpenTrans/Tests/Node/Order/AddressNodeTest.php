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
 * @group serialization
 *
 * @package SE\Component\OpenTrans\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class AddressNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\AddressNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_ADDRESS);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\AddressNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\AddressNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function ScalarSetterAndGetterTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\AddressNode();

        $node->setName1($name1 = sha1(uniqid(microtime(true))));
        $this->assertEquals($name1, $node->getName1());

        $node->setName2($name2 = sha1(uniqid(microtime(true))));
        $this->assertEquals($name2, $node->getName2());

        $node->setName3($name3 = sha1(uniqid(microtime(true))));
        $this->assertEquals($name3, $node->getName3());

        $node->setEmail($email = sha1(uniqid(microtime(true))));
        $this->assertEquals($email, $node->getEmail());

        $node->setCity($city = sha1(uniqid(microtime(true))));
        $this->assertEquals($city, $node->getCity());

        $node->setCountry($country = sha1(uniqid(microtime(true))));
        $this->assertEquals($country, $node->getCountry());

        $node->setChargeVat('Y');
        $this->assertEquals('Y', $node->getChargeVat());

        $node->setChargeVat('N');
        $this->assertEquals('N', $node->getChargeVat());

        $node->setPhone($phone = rand(10000,100000000));
        $this->assertEquals($phone, $node->getPhone());

        $node->setPostCode($postCode = rand(10000,99999));
        $this->assertEquals($postCode, $node->getPostCode());

        $node->setStreet($street = sha1(uniqid(microtime(true))));
        $this->assertEquals($street, $node->getStreet());
    }

    /**
     *
     * @test
     */
    public function SetFullname()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\AddressNode();
        $name = implode(' ', array(
            $name1 = sha1(uniqid(microtime(true))),
            $name2 = sha1(uniqid(microtime(true))),
            $name3 = sha1(uniqid(microtime(true))),
        ));

        $node->setFullName($name);
        $this->assertEquals($name1, $node->getName1());
        $this->assertEquals($name2, $node->getName2());
        $this->assertEquals($name3, $node->getName3());
    }

    /**
     *
     * @test
     */
    public function SerializeAndDeserializeTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\AddressNode();
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $content = $serializer->serialize($node, 'xml');
        $this->assertTag(array('tag' => 'ADDRESS', 'content' => ''), $content);

        $node->setName1($name1 = sha1(uniqid(microtime(true))));
        $node->setName2($name2 = sha1(uniqid(microtime(true))));
        $node->setName3($name3 = sha1(uniqid(microtime(true))));
        $node->setEmail($email = sha1(uniqid(microtime(true))));
        $node->setCity($city = sha1(uniqid(microtime(true))));
        $node->setCountry($country = sha1(uniqid(microtime(true))));
        $node->setChargeVat($chargeVat = 'Y');
        $node->setPhone($phone = rand(10000,100000000));
        $node->setPostCode($postCode = rand(10000,99999));
        $node->setStreet($street = sha1(uniqid(microtime(true))));

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag($parent = array(
            'tag' => 'ADDRESS', 'children' => array( 'count' => 10)
        ), $xml);

        $this->assertTag(array('parent' => $parent, 'tag' => 'NAME'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'NAME2'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'NAME3'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'CITY'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'ZIP'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'STREET'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'COUNTRY'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'PHONE'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'EMAIL'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'CHARGE_VAT'), $xml);

        /* @var $actual \SE\Component\OpenTrans\Node\Order\AddressNode */
        $actual = $serializer->deserialize($xml, get_class($node), 'xml');
        $this->assertEquals($name1, $actual->getName1());
        $this->assertEquals($name2, $actual->getName2());
        $this->assertEquals($name3, $actual->getName3());
        $this->assertEquals($city, $actual->getCity());
        $this->assertEquals($postCode, $actual->getPostCode());
        $this->assertEquals($street, $actual->getStreet());
        $this->assertEquals($country, $actual->getCountry());
        $this->assertEquals($phone, $actual->getPhone());
        $this->assertEquals($email, $actual->getEmail());
        $this->assertEquals($chargeVat, $actual->getChargeVat());
    }


}