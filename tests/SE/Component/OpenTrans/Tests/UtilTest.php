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
class UtilTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function Change_Key_Recursive()
    {
        $data1 = array(
            'a' => array(
                'b' => array(
                    'c' => ($time = time()),
                ),
                'd' => array(
                    'e' => ($hash = sha1(uniqid(microtime(true))))
                )
            )
        );

        $data2 = \SE\Component\OpenTrans\Util::arrayChangeKeyCaseRecursive($data1, CASE_UPPER);
        $this->assertEquals(
            array('A' => array('B' => array('C' => $time), 'D' => array('E' => $hash))),
            $data2
        );

        $data3 = \SE\Component\OpenTrans\Util::arrayChangeKeyCaseRecursive($data2);
        $this->assertEquals($data1, $data3);
    }
}