<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\Tests\EventDispatcher;

/**
 *
 * @package SE\Component\OpenTrans\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class SerializeEventTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function SetterAndGetter()
    {
        $event = new \SE\Component\OpenTrans\EventDispatcher\SerializeEvent();

        $node = $this->getMockForAbstractClass('\SE\Component\OpenTrans\Node\NodeInterface');
        $event->setDocument($node);
        $this->assertSame($node, $event->getDocument());

        $data = array(sha1(uniqid(microtime(true))), sha1(uniqid(microtime(true))), sha1(uniqid(microtime(true))));
        $event->setData($data);
        $this->assertEquals($data, $event->getData());
    }
}