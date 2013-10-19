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

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * @Serializer\XmlRoot("ARTICLE_PRICE")
 * @Serializer\ExclusionPolicy("all")
 */
class ArticlePriceNode extends AbstractNode
{
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
     * Einzelpreis * Quantity
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("FULL_PRICE")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $fullPrice;

    /**
     * Einzelpreis
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("PRICE_AMOUNT")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $priceAmount;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("DISCOUNT_PERCENT")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $discountPercent;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("DISCOUNT_VALUE")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $discountValue;

    /**
     *
     * @param string $discountPercent
     */
    public function setDiscountPercent($discountPercent)
    {
        $this->discountPercent = $discountPercent;
    }

    /**
     *
     * @return string
     */
    public function getDiscountPercent()
    {
        return $this->discountPercent;
    }

    /**
     *
     * @param string $discountValue
     */
    public function setDiscountValue($discountValue)
    {
        $this->discountValue = $discountValue;
    }

    /**
     *
     * @return string
     */
    public function getDiscountValue()
    {
        return $this->discountValue;
    }

    /**
     *
     * @param string $fullPrice
     */
    public function setFullPrice($fullPrice)
    {
        $this->fullPrice = $fullPrice;
    }

    /**
     *
     * @return string
     */
    public function getFullPrice()
    {
        return $this->fullPrice;
    }

    /**
     *
     * @param string $priceAmount
     */
    public function setPriceAmount($priceAmount)
    {
        $this->priceAmount = $priceAmount;
    }

    /**
     *
     * @return string
     */
    public function getPriceAmount()
    {
        return $this->priceAmount;
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
}