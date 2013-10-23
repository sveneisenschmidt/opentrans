<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\Node;

use \JMS\Serializer\Annotation as Serializer;

use \SE\Component\OpenTrans\Node\NodeInterface;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
abstract class AbstractNode implements NodeInterface
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array")
     * @Serializer\XmlKeyValuePairs
     * @Serializer\XmlList(inline=true)
     * @Serializer\Accessor(getter="getNormalizedCustomEntries")
     *
     * @var array
     */
    protected $customEntries = array();
    
    /**
     *
     * @param array $customEntries
     */
    public function setCustomEntries(array $customEntries)
    {
        if(empty($customEntries) === true) {
            $this->customEntries = $customEntries;
        }

        foreach($customEntries as $key => $value) {
            $this->addCustomEntry($key, $value);
        }
    }

    /**
     *
     * @param string $key
     * @param mixed $value
     */
    public function addCustomEntry($key, $value)
    {
        $this->customEntries = array_merge(
            $this->customEntries,
            array($key => $value)
        );
    }

    /**
     *
     * @return array
     */
    public function getCustomEntries()
    {
        return $this->customEntries;
    }

    /**
     *
     * @return array
     */
    public function getNormalizedCustomEntries()
    {
        return $this->arrayChangeKeyCaseRecursive($this->customEntries, CASE_UPPER);
    }

    /**
     *
     * @param array $input
     * @param integer $case
     * @return array
     */
    public function arrayChangeKeyCaseRecursive(array $input, $case = CASE_LOWER)
    {
        $input = array_change_key_case($input, $case);
        foreach($input as $key => $array){
            if(is_array($array)){
                $input[$key] = $this->arrayChangeKeyCaseRecursive($array, $case);
            }
        }
        return $input;
    }
}