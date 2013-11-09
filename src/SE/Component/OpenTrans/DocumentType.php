<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans;

use \SE\Component\OpenTrans\Exception\UnknownNodeTypeException;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class DocumentType
{

    const DOCUMENT_ORDER = 'order';

    /**
     *
     * @return array
     */
    public static function getTypes()
    {
        return array(
            self::DOCUMENT_ORDER
        );
    }
}
