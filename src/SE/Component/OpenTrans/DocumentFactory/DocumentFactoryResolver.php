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

use SE\Component\OpenTrans\NodeLoader;
use SE\Component\OpenTrans\DocumentType;
use SE\Component\OpenTrans\Exception\UnknownDocumentFactoryException;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class DocumentFactoryResolver
{
    /**
     *
     * @var array
     */
    protected static $factories = array(
        DocumentType::DOCUMENT_ORDER => NodeLoader::FACTORY_ORDER
    );
    
    /**
     *
     * @param \SE\Component\OpenTrans\NodeLoader $loader
     * @param string $documentType
     * @throws \SE\Component\OpenTrans\Exception\UnknownDocumentFactoryException
     *
     * @return \SE\Component\OpenTrans\DocumentFactory\DocumentFactoryInterface
     */
    public static function resolveFactory(NodeLoader $loader, $documentType)
    {
        if(isset(self::$factories[$documentType]) === false) {
            throw new UnknownDocumentFactoryException(sprintf('Unknown factory name %s.', $documentType));
        } 
        
        return $loader->get(self::$factories[$documentType]);
    }
}
