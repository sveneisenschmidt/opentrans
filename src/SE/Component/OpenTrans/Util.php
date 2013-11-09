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

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class Util
{
    /**
     *
     * @param array $input
     * @param integer $case
     * @return array
     */
    public static function arrayChangeKeyCaseRecursive(array $input, $case = CASE_LOWER)
    {
        $input = array_change_key_case($input, $case);
        foreach($input as $key => $array){
            if(is_array($array)){
                $input[$key] = self::arrayChangeKeyCaseRecursive($array, $case);
            }
        }
        return $input;
    }
}
