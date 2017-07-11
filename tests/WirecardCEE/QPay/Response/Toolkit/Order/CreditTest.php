<?php
/**
 * Shop System Plugins - Terms of Use
 *
 * The plugins offered are provided free of charge by Wirecard Central Eastern Europe GmbH
 * (abbreviated to Wirecard CEE) and are explicitly not part of the Wirecard CEE range of
 * products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License Version 2 (GPLv2) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Wirecard CEE does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the plugins at their own risk. Wirecard CEE does not guarantee their full
 * functionality neither does Wirecard CEE assume liability for any disadvantages related to
 * the use of the plugins. Additionally, Wirecard CEE does not guarantee the full functionality
 * for customized shop systems or installed plugins of other vendors of plugins within the same
 * shop system.
 *
 * Customers are responsible for testing the plugin's functionality before starting productive
 * operation.
 *
 * By installing the plugin into the shop system the customer agrees to these terms of use.
 * Please do not use the plugin if you do not agree to these terms of use!
 */

/**
 * Test class for WirecardCEE_QPay_Response_Toolkit_Order_CreditTest.
 * Generated by PHPUnit on 2011-06-24 at 13:26:16.
 */
class WirecardCEE_QPay_Response_Toolkit_Order_CreditTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var WirecardCEE_QPay_Response_Toolkit_GetOrderDetails
     */
    protected $object;
    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';
    protected $_customerId = 'D200001';
    protected $_shopId = '';
    protected $_language = 'en';
    protected $_toolkitPassword = 'jcv45z';
    protected $_orderNumber = 5000004;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $customerId      = $this->_customerId;
        $shopId          = $this->_shopId;
        $secret          = $this->_secret;
        $language        = $this->_language;
        $toolkitPassword = $this->_toolkitPassword;

        $oToolkitClient = new WirecardCEE_QPay_ToolkitClient(Array(
            'CUSTOMER_ID'      => $customerId,
            'SHOP_ID'          => $shopId,
            'SECRET'           => $secret,
            'LANGUAGE'         => $language,
            'TOOLKIT_PASSWORD' => $toolkitPassword
        ));

        $this->object = $oToolkitClient->getOrderDetails($this->_orderNumber)->getOrder()->getCredits()->current();
    }

    public function testGetMerchantNumber()
    {
        $this->assertEquals(1, $this->object->getMerchantNumber());
    }

    public function testGetCreditNumber()
    {
        $this->assertEquals(6000004, $this->object->getCreditNumber());
    }

    public function testGetOrderNumber()
    {
        $this->assertEquals(5000004, $this->object->getOrderNumber());
    }

    public function testGetBatchNumber()
    {
        $this->assertEquals(411, $this->object->getBatchNumber());
    }

    public function testGetAmount()
    {
        $this->assertEquals('1.00', $this->object->getAmount());
    }

    public function testGetCurrency()
    {
        $this->assertEquals('EUR', $this->object->getCurrency());
    }

    public function testGetTimeCreated()
    {
        $this->assertInstanceOf('DateTime', $this->object->getTimeCreated());
    }

    public function testGetTimeModified()
    {
        $this->assertInstanceOf('DateTime', $this->object->getTimeModified());
    }

    public function testGetState()
    {
        $this->assertEquals('credit_closed', $this->object->getState());
    }

    public function testGetOperationsAllowed()
    {
        $this->assertEquals(Array(''), $this->object->getOperationsAllowed());
    }

    public function testGetGatewayReferenceNumber()
    {
        $this->assertEquals('', $this->object->getGatewayReferenceNumber());
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->object = null;
    }
}
