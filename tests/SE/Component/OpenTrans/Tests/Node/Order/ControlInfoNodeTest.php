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
class ControlInfoNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\ControlInfoNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_CONTROLINFO);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ControlInfoNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ControlInfoNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function SetterAndGetterTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\ControlInfoNode();

        $node->setGeneratorInfo($generatorInfo = sha1(uniqid(microtime(true))));
        $this->assertEquals($generatorInfo, $node->getGeneratorInfo());

        $date = new \DateTime(sprintf('@%s', rand(1, time())));
        $node->setGenerationDate($date);
        $this->assertSame($date, $node->getGenerationDate());
    }

    /**
     *
     * @test
     */
    public function SerializeAndDeserializeTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\ControlInfoNode();
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $content = $serializer->serialize($node, 'xml');
        $this->assertTag(array('tag' => 'CONTROL_INFO', 'content' => ''), $content);

        $node->setGeneratorInfo($generatorInfo = sha1(uniqid(microtime(true))));
        $date = new \DateTime(sprintf('@%s', rand(1, time())));
        $node->setGenerationDate($date);

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag($parent = array(
            'tag' => 'CONTROL_INFO', 'children' => array( 'count' => 2)
        ), $xml);

        $this->assertTag(array('parent' => $parent, 'tag' => 'GENERATOR_INFO'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'GENERATION_DATE'), $xml);

        /* @var $actual \SE\Component\OpenTrans\Node\Order\ControlInfoNode */
        $actual = $serializer->deserialize($xml, get_class($node), 'xml');
        $this->assertEquals($generatorInfo, $actual->getGeneratorInfo());
        $this->assertEquals($date, $actual->getGenerationDate());;
    }
}