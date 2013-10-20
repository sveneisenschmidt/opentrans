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

use \SE\Component\OpenTrans\NodeLoader;
use \SE\Component\OpenTrans\NodeLoader\DocumentFactoryInterface;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class DocumentFactory
{
    protected static $factories = [
        'order' => NodeLoader::ORDER_FACTORY;         
    ];
    
    /**
     *
     * @param array $data [$key => $values]
     * @return DocumentFactoryInterface
     */
    public static function resolveFactory(NodeLoader $nodeLoader, array $data)
    {
        if(empty($data) === true) {
            throw new \InvalidArgumentException('Argument #1 must no be empty.');
        }
        
        $key = key($data);
        if(isset(self::$factories[$key]) === false) {
            throw new \InvalidArgumentException(sprintf('Unknown factory name %s.', $key));
        } 
        
        return $nodeLoader::get(self::$factories[$key]); 
    }
}