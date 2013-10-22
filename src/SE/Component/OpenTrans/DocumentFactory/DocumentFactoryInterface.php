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
use \SE\Component\OpenTrans\Node\NodeInterface;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
interface DocumentFactoryInterface
{
    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     */
    public function __construct(NodeLoader $loader);

    /**
     *
     * @param \SE\Component\OpenTrans\Node\NodeInterface $node
     * @return \SE\Component\OpenTrans\Node\NodeInterface
     */    
    public function create($node = null);

    /**
     *
     * @param \SE\Component\OpenTrans\Node\NodeInterface $document
     * @param array $data
     * @param boolean $build
     */
    public function load(NodeInterface $node, array $data, $build = true);
}