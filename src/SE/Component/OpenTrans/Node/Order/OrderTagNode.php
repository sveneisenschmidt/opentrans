<?php


namespace SE\Component\OpenTrans\Node\Order;


use SE\Component\OpenTrans\Node\AbstractNode;
use JMS\Serializer\Annotation as Serializer;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Jan Kahnt <j.kahnt@impericon.com>
 *
 * @Serializer\XmlRoot("ORDERTAG")
 * @Serializer\ExclusionPolicy("all")
 */
class OrderTagNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("value")
     * @Serializer\Type("string")
     * @Serializer\XmlValue
     *
     * @var string
     */
    protected $value;

    /**
     * OrderTagNode constructor.
     * @param $value
     */
    public function __construct($value = null)
    {
        if($value !== null)
        {
            $this->setValue($value);
        }
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}