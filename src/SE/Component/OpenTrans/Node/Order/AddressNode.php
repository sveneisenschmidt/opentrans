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
 * @Serializer\XmlRoot("ADDRESS")
 * @Serializer\ExclusionPolicy("all")
 */
class AddressNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("NAME")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $name1;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("NAME2")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $name2;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("NAME3")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $name3;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("STREET")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $street;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("ZIP")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $postCode;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("CITY")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $city;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("COUNTRY")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $country;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("PHONE")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $phone;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("EMAIL")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $email;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("CHARGE_VAT")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $chargeVat;

    /**
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     *
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @param string $name1
     */
    public function setName1($name1)
    {
        $this->name1 = $name1;
    }

    /**
     *
     * @return string
     */
    public function getName1()
    {
        return $this->name1;
    }

    /**
     *
     * @param string $name2
     */
    public function setName2($name2)
    {
        $this->name2 = $name2;
    }

    /**
     *
     * @return string
     */
    public function getName2()
    {
        return $this->name2;
    }

    /**
     *
     * @param string $name3
     */
    public function setName3($name3)
    {
        $this->name3 = $name3;
    }

    /**
     *
     * @return string
     */
    public function getName3()
    {
        return $this->name3;
    }

    /**
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     *
     * @param string $postCode
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;
    }

    /**
     *
     * @return string
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     *
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     *
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $parts = explode(' ', $fullName);
        if(isset($parts[0]) === true) {
            $this->setName1($parts[0]);
        }
        if(isset($parts[1]) === true) {
            $this->setName2($parts[1]);
        }
        if(isset($parts[2]) === true) {
            $this->setName3($parts[2]);
        }
    }

    /**
     *
     * @param string $chargeVat
     */
    public function setChargeVat($chargeVat)
    {
        $this->chargeVat = $chargeVat;
    }

    /**
     *
     * @return string
     */
    public function getChargeVat()
    {
        return $this->chargeVat;
    }
}