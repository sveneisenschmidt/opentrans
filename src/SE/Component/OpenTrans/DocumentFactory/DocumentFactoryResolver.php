<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\DocumentFactory;

use \SE\Component\OpenTrans\NodeLoader;
use \SE\Component\OpenTrans\Node\DocumentFactoryInterface;
use \SE\Component\OpenTrans\Exception\MissingDocumentTypeException;
use \SE\Component\OpenTrans\Exception\UnknownDocumentFactoryException;
/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class DocumentFactoryResolver
{
    protected static $factories = [
        'order' => NodeLoader::FACTORY_ORDER
    ];
    
    /**
     *
     * @param array $data ['type' => 'order', ...]
     *
     * @throws \InvalidArgumentException
     * @throws \SE\Component\OpenTrans\Exception\MissingDocumentTypeException
     * @throws \SE\Component\OpenTrans\Exception\UnknownDocumentFactoryException
     *
     * @return DocumentFactoryInterface
     */
    public static function resolveFactory(NodeLoader $nodeLoader, array $data)
    {
        if(empty($data) === true) {
            throw new \InvalidArgumentException('Argument #1 must no be empty.');
        }

        if(isset($data['type']) === false) {
            throw new MissingDocumentTypeException('Missing type attribute in input data.');
        }
        $key = $data['type'];
        if(isset(self::$factories[$key]) === false) {
            throw new UnknownDocumentFactoryException(sprintf('Unknown factory name %s.', $key));
        } 
        
        return $nodeLoader->get(self::$factories[$key]);
    }
}