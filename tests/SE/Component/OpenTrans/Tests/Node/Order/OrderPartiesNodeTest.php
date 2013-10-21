<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\Tests\Node\Order;

/**
 *
 * @package SE\Component\OpenTrans\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class OrderPartiesNode extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\OrderPartiesNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_PARTIES);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderPartiesNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\OrderPartiesNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function SetAndGetBuyerParties()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderPartiesNode();

        $party1 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $party2 = new \SE\Component\OpenTrans\Node\Order\PartyNode();

        $this->assertEmpty($node->getBuyerParties());
        $node->setBuyerParties(array($party1, $party2));
        $this->assertCount(2, $node->getBuyerParties());
        $this->assertSame(array($party1, $party2), $node->getBuyerParties());

        $node->addBuyerParty($party2);
        $this->assertCount(3, $node->getBuyerParties());
        $this->assertSame(array($party1, $party2, $party2), $node->getBuyerParties());
    }

    /**
     *
     * @test
     */
    public function SetAndGetShippingParties()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderPartiesNode();

        $party1 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $party2 = new \SE\Component\OpenTrans\Node\Order\PartyNode();

        $this->assertEmpty($node->getShippingParties());
        $node->setShippingParties(array($party1, $party2));
        $this->assertCount(2, $node->getShippingParties());
        $this->assertSame(array($party1, $party2), $node->getShippingParties());

        $node->addShippingParty($party2);
        $this->assertCount(3, $node->getShippingParties());
        $this->assertSame(array($party1, $party2, $party2), $node->getShippingParties());
    }

    /**
     *
     * @test
     */
    public function SetAndGetInvoiceParties()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderPartiesNode();

        $party1 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $party2 = new \SE\Component\OpenTrans\Node\Order\PartyNode();

        $this->assertEmpty($node->getInvoiceParties());
        $node->setInvoiceParties(array($party1, $party2));
        $this->assertCount(2, $node->getInvoiceParties());
        $this->assertSame(array($party1, $party2), $node->getInvoiceParties());

        $node->addInvoiceParty($party2);
        $this->assertCount(3, $node->getInvoiceParties());
        $this->assertSame(array($party1, $party2, $party2), $node->getInvoiceParties());
    }

    /**
     *
     * @test
     */
    public function SetAndGetSupplierParties()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\OrderPartiesNode();

        $party1 = new \SE\Component\OpenTrans\Node\Order\PartyNode();
        $party2 = new \SE\Component\OpenTrans\Node\Order\PartyNode();

        $this->assertEmpty($node->getSupplierParties());
        $node->setSupplierParties(array($party1, $party2));
        $this->assertCount(2, $node->getSupplierParties());
        $this->assertSame(array($party1, $party2), $node->getSupplierParties());

        $node->addSupplierParty($party2);
        $this->assertCount(3, $node->getSupplierParties());
        $this->assertSame(array($party1, $party2, $party2), $node->getSupplierParties());
    }
}