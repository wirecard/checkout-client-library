<?php

/**
 * WirecardCEE_QMore_Response_Backend_RecurPayment test case.
 */
class WirecardCEE_QMore_Response_Backend_RecurPaymentTest extends PHPUnit_Framework_TestCase
{

    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';
    protected $_customerId = 'D200050';
    protected $_shopId = 'RECUR';
    protected $_language = 'en';
    protected $_toolkitPassword = 'jcv45z';
    protected $_sourceOrderNumber = '23473341';
    protected $_amount = '1,2';
    protected $_currency = 'EUR';
    protected $_depositFlag = false;
    protected $_orderDescription = 'Unittest OrderDescr';
    protected $_orderNumber = '';

    /**
     *
     * @var WirecardCEE_QMore_Response_Backend_RecurPayment
     */
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $customerId      = $this->_customerId;
        $shopId          = $this->_shopId;
        $secret          = $this->_secret;
        $language        = $this->_language;
        $toolkitPassword = $this->_toolkitPassword;

        $oBackClient = new WirecardCEE_QMore_BackendClient(Array(
            'CUSTOMER_ID' => $customerId,
            'SHOP_ID'     => $shopId,
            'SECRET'      => $secret,
            'LANGUAGE'    => $language,
            'PASSWORD'    => $toolkitPassword
        ));

        $this->object = $oBackClient->recurPayment($this->_sourceOrderNumber, $this->_amount, $this->_currency,
            $this->_orderDescription, $this->_orderNumber, $this->_depositFlag);
    }

    public function testGetOrderNumber()
    {
        $this->assertNotEquals('', $this->object->getOrderNumber());
    }

    /**
     * Test getStatus()
     */
    public function testGetStatus()
    {
        $this->assertEquals($this->object->getStatus(), 0);
    }

    /**
     * Test getErrors()
     */
    public function testGetErrors()
    {
        $this->assertEmpty($this->object->getErrors());
    }

    /**
     * Test hasFailed()
     */
    public function testHasFailed()
    {
        $this->assertFalse($this->object->hasFailed());
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated
        // WirecardCEE_QMore_Response_Backend_RecurPaymentTest::tearDown()
        $this->object = null;

        parent::tearDown();
    }
}
