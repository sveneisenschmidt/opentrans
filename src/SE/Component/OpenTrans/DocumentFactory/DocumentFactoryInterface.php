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

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
interface DocumentFactoryInterface
{
    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $nodeLoader
     * @param array $data
     * @return \SE\Component\OpenTrans\Node\NodeInterface
     */    
    public function create(NodeLoader $nodeLoader, array $data = [])
}