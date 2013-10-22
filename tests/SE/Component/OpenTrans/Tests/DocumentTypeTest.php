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
class DocumentTypeTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @test
     */
    public function GetTypesReturnsArray()
    {
        $types = \SE\Component\OpenTrans\DocumentType::getTypes();
        $this->assertInternalType('array', $types);
        $this->assertNotEmpty($types);
    }
}