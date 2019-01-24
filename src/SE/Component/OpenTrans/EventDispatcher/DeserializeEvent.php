<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\EventDispatcher;

use Symfony\Component\EventDispatcher\Event;

use SE\Component\OpenTrans\Node\NodeInterface;

class DeserializeEvent extends Event
{
    /**
     *
     * @var \SE\Component\OpenTrans\Node\NodeInterface
     */
    protected $document;

    /**
     *
     * @var string|\SimpleXMLElement
     */
    protected $data;

    /**
     *
     * @param \SE\Component\OpenTrans\Node\NodeInterface $document
     */
    public function setDocument(NodeInterface $document)
    {
        $this->document = $document;
    }

    /**
     *
     * @return \SE\Component\OpenTrans\Node\NodeInterface
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     *
     * @param \SimpleXMLElement|string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     *
     * @return \SimpleXMLElement|string
     */
    public function getData()
    {
        return $this->data;
    }
}