<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\Tests;

/**
 *
 * @package SE\Component\OpenTrans\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class DocumentBuilderTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @test
     */
    public function CanBeInstantiated()
    {
        $loader = $this->getMock('\SE\Component\OpenTrans\NodeLoader');
        $factory = $this->getMockForAbstractClass('\SE\Component\OpenTrans\DocumentFactory\DocumentFactoryInterface');

        $builder = new \SE\Component\OpenTrans\DocumentBuilder($factory);
    }

    /**
     *
     * @test
     */
    public function StaticCreateReturnsNewInstance()
    {
        $loader = $this->getMock('\SE\Component\OpenTrans\NodeLoader');
        $factory = $this->getMockForAbstractClass('\SE\Component\OpenTrans\DocumentFactory\DocumentFactoryInterface');

        $builder = \SE\Component\OpenTrans\DocumentBuilder::create($factory);
        $this->assertSame($factory, $builder->getFactory());
    }

    /**
     *
     * @test
     */
    public function SetSerializer()
    {
        $loader = $this->getMock('\SE\Component\OpenTrans\NodeLoader');
        $factory = $this->getMockForAbstractClass('\SE\Component\OpenTrans\DocumentFactory\DocumentFactoryInterface');
        $serializer = $this->getMockForAbstractClass('\JMS\Serializer\Serializer', array(), '', false);

        $builder = \SE\Component\OpenTrans\DocumentBuilder::create($factory, $serializer);
        $this->assertSame($factory, $builder->getFactory());
        $this->assertSame($serializer, $builder->getSerializer());
    }

    /**
     *
     * @test
     */
    public function BuildDocument()
    {
        $loader = $this->getMock('\SE\Component\OpenTrans\NodeLoader');
        $factory = $this->getMockForAbstractClass('\SE\Component\OpenTrans\DocumentFactory\DocumentFactoryInterface');
        $serializer = $this->getMockForAbstractClass('\JMS\Serializer\Serializer', array(), '', false);

        $factory->expects($this->once())
            ->method('createDocument')
            ->will($this->returnValue($document = new \StdClass()))
        ;

        $builder = \SE\Component\OpenTrans\DocumentBuilder::create($factory, $serializer);
        $builder->build();

        $this->assertSame($document, $builder->getDocument());
    }

    /**
     *
     * @test
     */
    public function LoadIntoDocument()
    {
        $data = array(
            'test' => sha1(uniqid(microtime(true)))
        );

        $loader = $this->getMock('\SE\Component\OpenTrans\NodeLoader');
        $factory = $this->getMockForAbstractClass('\SE\Component\OpenTrans\DocumentFactory\DocumentFactoryInterface');
        $document = $this->getMockForAbstractClass('\SE\Component\OpenTrans\Node\NodeInterface');

        $factory->expects($this->once())
            ->method('createDocument')
            ->will($this->returnValue($document))
        ;

        $factory->expects($this->once())
            ->method('load')
            ->with($this->equalTo($document), $this->equalTo($data), $this->equalTo(true))
        ;

        $builder = \SE\Component\OpenTrans\DocumentBuilder::create($factory);
        $builder->build();
        $builder->load($data);
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\OpenTrans\Exception\MissingDocumentException
     */
    public function LoadIntoMissingDocument()
    {
        $data = array(
            'test' => sha1(uniqid(microtime(true)))
        );

        $loader = $this->getMock('\SE\Component\OpenTrans\NodeLoader');
        $factory = $this->getMockForAbstractClass('\SE\Component\OpenTrans\DocumentFactory\DocumentFactoryInterface');

        $builder = \SE\Component\OpenTrans\DocumentBuilder::create($factory);
        $builder->load($data);
    }


}