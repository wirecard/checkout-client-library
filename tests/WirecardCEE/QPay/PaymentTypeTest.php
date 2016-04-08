<?php

/**
 * Test class for WirecardCEE_QPay_PaymentType.
 * Generated by PHPUnit on 2011-06-24 at 13:17:01.
 */
class WirecardCEE_QPay_PaymentTypeTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var WirecardCEE_QPay_PaymentType
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    public function testHasFinancialInstitutions()
    {
        $paymentType = WirecardCEE_QPay_PaymentType::EPS;
        $this->assertTrue(WirecardCEE_QPay_PaymentType::hasFinancialInstitutions($paymentType));
    }

    public function testHasNoFinancialInstitutions()
    {
        $paymentType = WirecardCEE_QPay_PaymentType::CCARD;
        $this->assertFalse(WirecardCEE_QPay_PaymentType::hasFinancialInstitutions($paymentType));
    }

    public function testGetIdealFinancialInstitutions()
    {
        $paymentType = WirecardCEE_QPay_PaymentType::IDL;
        $this->assertContains('ABN AMRO Bank', WirecardCEE_QPay_PaymentType::getFinancialInstitutions($paymentType));
        $this->assertArrayHasKey('REGIOBANK', WirecardCEE_QPay_PaymentType::getFinancialInstitutions($paymentType));
    }

    public function testGetEpsFinancialInstitutions()
    {
        $paymentType = WirecardCEE_QPay_PaymentType::EPS;
        $this->assertContains('BAWAG', WirecardCEE_QPay_PaymentType::getFinancialInstitutions($paymentType));
        $this->assertArrayHasKey('ARZ|VB', WirecardCEE_QPay_PaymentType::getFinancialInstitutions($paymentType));
    }

    public function testGetEmptyFinancialInstitutions()
    {
        $paymentType = WirecardCEE_QPay_PaymentType::CCARD;
        $this->assertEmpty(WirecardCEE_QPay_PaymentType::getFinancialInstitutions($paymentType));
    }

}

?>