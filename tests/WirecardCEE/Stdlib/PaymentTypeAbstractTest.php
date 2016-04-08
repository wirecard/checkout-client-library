<?php
/*
* Die vorliegende Software ist Eigentum von Wirecard CEE und daher vertraulich
* zu behandeln. Jegliche Weitergabe an dritte, in welcher Form auch immer, ist
* unzulaessig. Software & Service Copyright (C) by Wirecard Central Eastern
* Europe GmbH, FB-Nr: FN 195599 x, http://www.wireacard.at
*/

/**
 * Test class for WirecardCEE_Stdlib_PaymentTypeTest.
 * Generated by PHPUnit on 2011-06-24 at 13:17:01.
 */
class WirecardCEE_Stdlib_PaymentTypeTest extends PHPUnit_Framework_TestCase {

    /**
     * @var WirecardCEE_Stdlib_PaymentTypeTest
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    public function testHasFinancialInstitutions() {
        $paymentType = WirecardCEE_Stdlib_PaymentTypeAbstract::EPS;
        $this->assertTrue(WirecardCEE_Stdlib_PaymentTypeAbstract::hasFinancialInstitutions($paymentType));
    }

    public function testHasNoFinancialInstitutions() {
        $paymentType = WirecardCEE_Stdlib_PaymentTypeAbstract::CCARD;
        $this->assertFalse(WirecardCEE_Stdlib_PaymentTypeAbstract::hasFinancialInstitutions($paymentType));
    }

    public function testGetIdealFinancialInstitutions() {
        $paymentType = WirecardCEE_Stdlib_PaymentTypeAbstract::IDL;
        $this->assertContains('ABN AMRO Bank', WirecardCEE_Stdlib_PaymentTypeAbstract::getFinancialInstitutions($paymentType));
        $this->assertArrayHasKey('REGIOBANK', WirecardCEE_Stdlib_PaymentTypeAbstract::getFinancialInstitutions($paymentType));
    }

    public function testGetEpsFinancialInstitutions() {
        $paymentType = WirecardCEE_Stdlib_PaymentTypeAbstract::EPS;
        $this->assertContains('BAWAG', WirecardCEE_Stdlib_PaymentTypeAbstract::getFinancialInstitutions($paymentType));
        $this->assertArrayHasKey('ARZ|VB', WirecardCEE_Stdlib_PaymentTypeAbstract::getFinancialInstitutions($paymentType));
    }

    public function testGetEmptyFinancialInstitutions() {
        $paymentType = WirecardCEE_Stdlib_PaymentTypeAbstract::CCARD;
        $this->assertEmpty(WirecardCEE_Stdlib_PaymentTypeAbstract::getFinancialInstitutions($paymentType));
    }

    public function testgetFinancialInstitutionFullName() {
    	$this->assertEquals('Bank Austria', WirecardCEE_Stdlib_PaymentTypeAbstract::getFinancialInstitutionFullName('BA-CA'));
    	$this->assertEquals('ABN AMRO Bank', WirecardCEE_Stdlib_PaymentTypeAbstract::getFinancialInstitutionFullName('ABNAMROBANK'));
    	$this->assertEquals('', WirecardCEE_Stdlib_PaymentTypeAbstract::getFinancialInstitutionFullName(''));
    }
}

?>