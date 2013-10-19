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
 * @Serializer\XmlRoot("CONTROL_INFO")
 * @Serializer\ExclusionPolicy("all")
 */
class ControlInfoNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("GENERATOR_INFO")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $generatorInfo;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("GENERATION_DATE")
     * @Serializer\Type("DateTime")
     *
     * @var \DateTime
     */
    protected $generationDate;

    /**
     *
     * @param \DateTime $generationDate
     */
    public function setGenerationDate(\DateTime $generationDate)
    {
        $this->generationDate = $generationDate;
    }

    /**
     *
     * @return \DateTime
     */
    public function getGenerationDate()
    {
        return $this->generationDate;
    }

    /**
     *
     * @param string $generatorInfo
     */
    public function setGeneratorInfo($generatorInfo)
    {
        $this->generatorInfo = $generatorInfo;
    }

    /**
     *
     * @return string
     */
    public function getGeneratorInfo()
    {
        return $this->generatorInfo;
    }
}