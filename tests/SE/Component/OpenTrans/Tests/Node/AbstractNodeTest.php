<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\Tests\Node;

/**
 *
 * @package SE\Component\OpenTrans\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class AbstractNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CustomEntriesEmpty()
    {
        $stub = $this->getMockForAbstractClass('\SE\Component\OpenTrans\Node\AbstractNode');
        $this->assertEmpty($stub->getCustomEntries());
    }

    /**
     *
     * @test
     */
    public function CustomEntriesConvertsToUppercase()
    {
        $stub = $this->getMockForAbstractClass('\SE\Component\OpenTrans\Node\AbstractNode');
        $entries = array(
            'field1' => array(
                'value1' => sha1(microtime()),
                'value2' => sha1(microtime()),
            ),
            'field2' => sha1(microtime())
        );

        $stub->setCustomEntries($entries);
        $this->assertEquals($entries, $stub->getCustomEntries());
    }

    /**
     *
     * @test
     */
    public function CustomEntriesGetsCleared()
    {
        $stub = $this->getMockForAbstractClass('\SE\Component\OpenTrans\Node\AbstractNode');
        $entries = array(
            'field1' => array(
                'value1' => sha1(microtime()),
                'value2' => sha1(microtime()),
            ),
            'field2' => sha1(microtime())
        );

        $stub->setCustomEntries($entries);
        $this->assertNotEmpty($stub->getCustomEntries());

        $stub->setCustomEntries(array());
        $this->assertEmpty($stub->getCustomEntries());
    }
}