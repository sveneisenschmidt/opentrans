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

use JMS\Serializer\Annotation as Serializer;

use SE\Component\OpenTrans\Node\AbstractNode;
use SE\Component\OpenTrans\Node\Order\ArticleIdNode;
use SE\Component\OpenTrans\Node\Order\ArticlePriceNode;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * @Serializer\XmlRoot("ORDER_ITEM")
 * @Serializer\ExclusionPolicy("all")
 */
class ItemNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("LINE_ITEM_ID")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $lineId;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("ARTICLE_ID")
     * @Serializer\Type("SE\Component\OpenTrans\Node\Order\ArticleIdNode")
     *
     * @var \SE\Component\OpenTrans\Node\Order\ArticleIdNode
     */
    protected $articleId;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("ARTICLE_PRICE")
     * @Serializer\Type("SE\Component\OpenTrans\Node\Order\ArticlePriceNode")
     *
     * @var \SE\Component\OpenTrans\Node\Order\ArticlePriceNode
     */
    protected $articlePrice;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("QUANTITY")
     * @Serializer\Type("float")
     *
     * @var float
     */
    protected $quantity;

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\ArticleIdNode $articleId
     */
    public function setArticleId(ArticleIdNode $articleId)
    {
        $this->articleId = $articleId;
    }

    /**
     *
     * @return \SE\Component\OpenTrans\Node\Order\ArticleIdNode
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     *
     * @param string $lineId
     */
    public function setLineId($lineId)
    {
        $this->lineId = $lineId;
    }

    /**
     *
     * @return string
     */
    public function getLineId()
    {
        return $this->lineId;
    }

    /**
     *
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     *
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     *
     * @param \SE\Component\OpenTrans\Node\Order\ArticlePriceNode $articlePrice
     */
    public function setArticlePrice(ArticlePriceNode $articlePrice)
    {
        $this->articlePrice = $articlePrice;
    }

    /**
     *
     * @return \SE\Component\OpenTrans\Node\Order\ArticlePriceNode
     */
    public function getArticlePrice()
    {
        return $this->articlePrice;
    }


}