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
    public function Can_Be_Instantiated()
    {
        $this->assertInstanceOf('SE\Component\OpenTrans\NodeLoader', $this->loader);
    }

    /**
     *
     * @test
     */
    public function Default_Mapping_Is_Ensured()
    {
        $map = [
            $this->loader->get(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_DOCUMENT),
        ];

        $this->assertSame([
            '\SE\Component\OpenTrans\Node\Order\DocumentNode',
        ], $map);
    }

    /**
     *
     * @test
     */
    public function Default_Mapping_Returns_Default_Class()
    {
        $instance = $this->loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_DOCUMENT);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\DocumentNode', $instance);
    }

    /**
     *
     * @test
     */
    public function Custom_Mapping_Returns_Custom_Class()
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
    public function Get_Unknown_Node_Class()
    {
        $this->loader->get('unknown.node');

    }

    /**
     *
     * @test
     * @expectedException \SE\Component\OpenTrans\Exception\UnknownNodeTypeException
     */
    public function Set_Unknown_Node_Class()
    {
        $this->loader->set('unknown.node', '\SE\Component\OpenTrans\Node\ArticleNode');
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\OpenTrans\Exception\UnknownNodeException
     */
    public function Get_Unknown_Node_Instance()
    {
        $this->loader->getInstance('unknown.node');
    }
}