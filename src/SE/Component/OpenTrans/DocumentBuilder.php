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
     */
    public function __construct(DocumentFactoryInterface $factory, Serializer $serializer = null)
    {
        if($serializer === null) {
            $serializer = SerializerBuilder::create()->build();
        }

        $this->factory    = $factory;
        $this->serializer = $serializer;
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
}