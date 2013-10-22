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
class NodeLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var \SE\Component\OpenTrans\NodeLoader
     */
    protected $loader;

    /**
     *
     * Sets up a default loader instance
     */
    public function setUp()
    {
        $this->loader = new \SE\Component\OpenTrans\NodeLoader;
    }

    /**
     *
     * @test
     */
    public function CanBeInstantiated()
    {
        $this->assertInstanceOf('SE\Component\OpenTrans\NodeLoader', $this->loader);
    }

    /**
     *
     * @test
     */
    public function DefaultMappingIsEnsured()
    {
        $map = array(
            $this->loader->get(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_DOCUMENT)
        );

        $this->assertSame(array(
            '\SE\Component\OpenTrans\Node\Order\DocumentNode'
        ), $map);
    }

    /**
     *
     * @test
     */
    public function DefaultMappingReturnsDefaultClass()
    {
        $instance = $this->loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_DOCUMENT);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\DocumentNode', $instance);
    }

    /**
     *
     * @test
     */
    public function CustomMappingReturnsCustomClass()
    {
       $class = '\SE\Component\OpenTrans\Tests\Fixtures\CustomOrderDocumentNodeFixture';
       $this->loader->set(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_DOCUMENT, $class);
       $this->assertSame($class, $this->loader->get(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_DOCUMENT));

       $instance = $this->loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_DOCUMENT);
       $this->assertInstanceOf($class, $instance);
       $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\DocumentNode', $instance);
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\OpenTrans\Exception\UnknownNodeTypeException
     */
    public function GetUnknow_NodeClass()
    {
        $this->loader->get('unknown.node');

    }

    /**
     *
     * @test
     * @expectedException \SE\Component\OpenTrans\Exception\UnknownNodeTypeException
     */
    public function SetUnknownNodeClass()
    {
        $this->loader->set('unknown.node', '\SE\Component\OpenTrans\Node\ArticleNode');
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\OpenTrans\Exception\UnknownNodeException
     */
    public function GetUnknown_NodeInstance()
    {
        $this->loader->getInstance('unknown.node');
    }
}