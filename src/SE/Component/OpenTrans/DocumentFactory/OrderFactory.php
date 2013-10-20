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
use \SE\Component\OpenTrans\Node\NodeInterface;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class OrderFactory implements DocumentFactory
{
    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $nodeLoader
     * @param array $data
     * @return \SE\Component\OpenTrans\Node\NodeInterface
     */
    public static function create($nodeLoader NodeLoader, array $data = [])
    {
        $instance = $nodeLoader->getInstance(NodeLoader::NODE_ORDER_DOCUMENT);
        
        // @TODO apply data
        
        return $instance;
        
    }
}