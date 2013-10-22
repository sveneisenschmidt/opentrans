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
 * @Serializer\XmlRoot("ARTICLE_ID")
 * @Serializer\ExclusionPolicy("all")
 */
class ArticleIdNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("SUPPLIER_AID")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $supplierAid;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("BUYER_AID")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $buyerAid;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("INTERNATIONAL_AID")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $internationalAid;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("DESCRIPTION_SHORT")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $descriptionShort;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("DESCRIPTION_LONG")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $descriptionLong;

    /**
     *
     * @param string $buyerAid
     */
    public function setBuyerAid($buyerAid)
    {
        $this->buyerAid = $buyerAid;
    }

    /**
     *
     * @return string
     */
    public function getBuyerAid()
    {
        return $this->buyerAid;
    }

    /**
     *
     * @param string $internationalAid
     */
    public function setInternationalAid($internationalAid)
    {
        $this->internationalAid = $internationalAid;
    }

    /**
     *
     * @return string
     */
    public function getInternationalAid()
    {
        return $this->internationalAid;
    }

    /**
     *
     * @param string $supplierAid
     */
    public function setSupplierAid($supplierAid)
    {
        $this->supplierAid = $supplierAid;
    }

    /**
     *
     * @return string
     */
    public function getSupplierAid()
    {
        return $this->supplierAid;
    }

    /**
     *
     * @param string $descriptionShort
     */
    public function setDescriptionShort($descriptionShort)
    {
        $this->descriptionShort = $descriptionShort;
    }

    /**
     *
     * @return string
     */
    public function getDescriptionShort()
    {
        return $this->descriptionShort;
    }

    /**
     *
     * @param string $descriptionLong
     */
    public function setDescriptionLong($descriptionLong)
    {
        $this->descriptionLong = $descriptionLong;
    }

    /**
     *
     * @return string
     */
    public function getDescriptionLong()
    {
        return $this->descriptionLong;
    }
}