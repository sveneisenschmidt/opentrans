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

use \Symfony\Component\EventDispatcher\EventDispatcher;

use \JMS\Serializer\Serializer;
use \JMS\Serializer\SerializerBuilder;

use \SE\Component\OpenTrans\NodeLoader;
use \SE\Component\OpenTrans\Node\NodeInterface;
use \SE\Component\OpenTrans\DocumentFactory\DocumentFactoryInterface;
use \SE\Component\OpenTrans\Exception\MissingDocumentException;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class DocumentBuilder
{
    /**
     *
     * @var \JMS\Serializer\Serializer
     */
    protected $serializer;

    /**
     *
     * @var \SE\Component\OpenTrans\DocumentFactory\DocumentFactoryInterface
     */
    protected $factory;

    /**
     *
     * @var \SE\Component\OpenTrans\DocumentFactory\
     */
    protected $document;

    /**
     *
     * @param \SE\Component\OpenTrans\DocumentFactory\DocumentFactoryInterface $factory
     * @param \JMS\Serializer\Serializer $serializer
     * @param \Symfony\Component\EventDispatcher\EventDispatcher $dispatcher
     */
    public function __construct(DocumentFactoryInterface $factory, Serializer $serializer = null, EventDispatcher $dispatcher = null)
    {
        if($serializer === null) {
            $builder = SerializerBuilder::create()->build();
        }
        if($dispatcher === null) {
            $dispatcher = new EventDispatcher();
        }

        $this->factory    = $factory;
        $this->serializer = $serializer;
        $this->dispatcher = $dispatcher;
    }

    /**
     *
     * @param \SE\Component\OpenTrans\DocumentFactory\DocumentFactoryInterface $factory
     * @param \JMS\Serializer\Serializer $serializer
     * @return \SE\Component\OpenTrans\DocumentBuilder
     */
    public static function create(DocumentFactoryInterface $factory, Serializer $serializer = null)
    {
        return new self($factory, $serializer);
    }

    /**
     * Builds the OpenTrans document tree
     */
    public function build()
    {
        $this->document = $this->factory->createDocument();
    }

    /**
     *
     * @return \SE\Component\OpenTrans\Node\NodeInterface
     */
    public function load(array $data)
    {
        if($this->document === null) {
            throw new MissingDocumentException('No Document built. Please call ::build first.');
        }

        $this->factory->load($this->document, $data, true);
    }

    /**
     *
     * @return \JMS\Serializer\Serializer
     */
    public function getSerializer()
    {
        return $this->serializer;
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
     * @return \SE\Component\OpenTrans\DocumentFactory\DocumentFactoryInterface
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     *
     * @throws \SE\Component\OpenTrans\Exception\MissingDocumentException
     * @return string
     */
    public function serialize()
    {
        if($this->document === null) {
            throw new MissingDocumentException('No Document built. Please call ::build first.');
        }

        $this->dispatcher->dispatch('document_builder.pre_serialize');
        $result = $this->serializer->serialize($this->document, 'xml');
        $this->dispatcher->dispatch('document_builder.post_serialize');

        return $result;
    }

    /**
     *
     * @param string $xml
     * @return \SE\Component\OpenTrans\Node\NodeInterface
     */
    public function deserialize($xml)
    {
        $node = $this->factory->createDocument();

        $this->dispatcher->dispatch('document_builder.pre_deserialize');
        $result = $this->serializer->deserialize($xml, get_class($node), 'xml');
        $this->dispatcher->dispatch('document_builder.post_deserialize');

        return $result;
    }
}