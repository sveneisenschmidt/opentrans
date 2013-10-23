<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\Node\Order;

use \JMS\Serializer\Annotation as Serializer;

use \SE\Component\OpenTrans\Node\AbstractNode;
use \SE\Component\OpenTrans\Node\Order\HeaderNode;
use \SE\Component\OpenTrans\Node\Order\ItemNode;
use \SE\Component\OpenTrans\Node\Order\SummaryNode;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * @Serializer\XmlRoot("ORDER")
 * @Serializer\ExclusionPolicy("all")
 */
class DocumentNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("version")
     * @Serializer\Type("string")
     * @Serializer\XmlAttribute
     *
     * @var string
     */
    protected $version = '1.0';

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("type")
     * @Serializer\Type("string")
     * @Serializer\XmlAttribute
     *
     * @var string
     */
    protected $type;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("ORDER_HEADER")
     * @Serializer\Type("SE\Component\OpenTrans\Node\Order\HeaderNode")
     *
     * @var \SE\Component\OpenTrans\Node\Order\HeaderNode
     */
    protected $header;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("ORDER_ITEM_LIST")
     * @Serializer\Type("array<SE\Component\OpenTrans\Node\Order\ItemNode>")
     * @Serializer\XmlList(inline=false, entry="ORDER_ITEM")
     *
     * @var array|\SE\Component\OpenTrans\Node\Order\ItemNode
     */
    protected $items = array();

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("ORDER_SUMMARY")
     * @Serializer\Type("SE\Component\OpenTrans\Node\Order\SummaryNode")
     *
     * @var \SE\Component\OpenTrans\Node\Order\SummaryNode
     */
    protected $summary;

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\HeaderNode $header
     */
    public function setHeader(HeaderNode $header)
    {
        $this->header = $header;
    }

    /**
     *
     * @return \SE\Component\OpenTrans\Node\Order\HeaderNode
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     *
     * @param array|\SE\Component\OpenTrans\Node\Order\ItemNode $items
     */
    public function setItems(array $items)
    {
        $this->items = $items;
    }

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\ItemNode $item
     */
    public function addItem(ItemNode $item)
    {
        $this->items []= $item;
    }

    /**
     *
     * @return array|\SE\Component\OpenTrans\Node\Order\ItemNode
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\SummaryNode $summary
     */
    public function setSummary(SummaryNode $summary)
    {
        $this->summary = $summary;
    }

    /**
     *
     * @return \SE\Component\OpenTrans\Node\Order\SummaryNode
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }
}