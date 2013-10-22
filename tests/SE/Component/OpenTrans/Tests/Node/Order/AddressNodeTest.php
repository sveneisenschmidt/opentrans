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
}