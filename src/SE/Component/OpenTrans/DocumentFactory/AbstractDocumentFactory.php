<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\DocumentFactory;

use SE\Component\OpenTrans\DocumentFactory\DocumentFactoryInterface;
use SE\Component\OpenTrans\Node\AbstractNode;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
abstract class AbstractDocumentFactory implements DocumentFactoryInterface
{

    /**
     * @param string $attribute
     * @return string
     */
    public static function formatAttribute($attribute)
    {
        return \preg_replace_callback(
            '/(^|_|\.)+(.)/', function ($match) {
                return ('.' === $match[1] ? '_' : '').strtoupper($match[2]);
            }, $attribute
        );
    }

    /**
     *
     * @param \SE\Component\OpenTrans\Node\AbstractNode $node
     * @param array $data
     * @param array $exclude
     */
    public static function loadScalarArrayData(AbstractNode $node, array $data, array $exclude = array())
    {
        foreach($data as $key => $value) {
            if(is_scalar($value) === true && in_array($key, $exclude) === false) {
                $method = 'set'.self::formatAttribute($key);
                if(method_exists($node, $method) === true) {
                    $node->{$method}($value);
                } else {
                    $node->addCustomEntry($key, $value);
                }
            }
        }
    }
}