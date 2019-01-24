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

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * @Serializer\XmlRoot("ORDER_SUMMARY")
 * @Serializer\ExclusionPolicy("all")
 */
class SummaryNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("TOTAL_ITEM_NUM")
     * @Serializer\Type("integer")
     *
     * @var integer
     */
    protected $totalItemCount = 0;

    /**
     *
     * @param integer $totalItemCount
     */
    public function setTotalItemCount($totalItemCount)
    {
        $this->totalItemCount = (int)$totalItemCount;
    }

    /**
     *
     * @return integer
     */
    public function getTotalItemCount()
    {
        return $this->totalItemCount;
    }
}