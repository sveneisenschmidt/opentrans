<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\Tests\DocumentFactory;

/**
 *
 * @package SE\Component\OpenTrans\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class DocumentFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function ResolveValidDocumentDataFor_Order()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $data = [
            'type' => 'order'
        ];

        $factory = \SE\Component\OpenTrans\DocumentFactory\DocumentFactoryResolver::resolveFactory($loader, $data);
        $this->assertSame('\SE\Component\OpenTrans\DocumentFactory\OrderFactory', $factory);
    }

    /**
     *
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function EmptyDocumentData()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $data = [];

        $factory = \SE\Component\OpenTrans\DocumentFactory\DocumentFactoryResolver::resolveFactory($loader, $data);
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\OpenTrans\Exception\MissingDocumentTypeException
     */
    public function MissingTypeInDocumentData()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $data = [sha1(microtime()) => sha1(microtime())];

        $factory = \SE\Component\OpenTrans\DocumentFactory\DocumentFactoryResolver::resolveFactory($loader, $data);
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\OpenTrans\Exception\UnknownDocumentFactoryException
     */
    public function UnknownTypeInDocumentData()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $data = ['type' => sha1(microtime())];

        $factory = \SE\Component\OpenTrans\DocumentFactory\DocumentFactoryResolver::resolveFactory($loader, $data);
    }
}