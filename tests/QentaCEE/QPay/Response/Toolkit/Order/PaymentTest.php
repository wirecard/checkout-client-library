<?php
/**
 * Shop System Plugins - Terms of Use
 *
 * The plugins offered are provided free of charge by Qenta Payment CEE GmbH
 * (abbreviated to Qenta CEE) and are explicitly not part of the Qenta CEE range of
 * products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License Version 2 (GPLv2) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Qenta CEE does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the plugins at their own risk. Qenta CEE does not guarantee their full
 * functionality neither does Qenta CEE assume liability for any disadvantages related to
 * the use of the plugins. Additionally, Qenta CEE does not guarantee the full functionality
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
 * Test class for QentaCEE_QPay_Response_Toolkit_Order_PaymentTest.
 * Generated by PHPUnit on 2011-06-24 at 13:26:16.
 */
use PHPUnit\Framework\TestCase;
use QentaCEE\QPay\ToolkitClient;
use QentaCEE\QPay\Response\Toolkit\Order\Payment;

class PaymentTest extends TestCase
{

    /**
     * @var Payment
     */
    protected $object;
    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';
    protected $_customerId = 'D200001';
    protected $_shopId = '';
    protected $_language = 'en';
    protected $_toolkitPassword = 'jcv45z';
    protected $_orderNumber = 5472113;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $customerId = $this->_customerId;
        $shopId     = $this->_shopId;
        $secret     = $this->_secret;
        $language   = $this->_language;

        $oToolkitClient = new ToolkitClient(Array(
            'CUSTOMER_ID'      => $customerId,
            'SHOP_ID'          => $shopId,
            'SECRET'           => $secret,
            'LANGUAGE'         => $language,
            'TOOLKIT_PASSWORD' => $this->_toolkitPassword
        ));

        $this->object = $oToolkitClient->getOrderDetails($this->_orderNumber)->getOrder()->getPayments()->current();
    }

    public function testGetMerchantNumber()
    {
        $this->assertEquals(1, $this->object->getMerchantNumber());
    }

    public function testGetPaymentNumber()
    {
        $this->assertEquals('5472113', $this->object->getPaymentNumber());
    }

    public function testGetOrderNumber()
    {
        $this->assertEquals($this->_orderNumber, $this->object->getOrderNumber());
    }

    public function testGetApproveAmount()
    {
        $this->assertEquals('1.00', $this->object->getApproveAmount());
    }

    public function testGetDepositAmount()
    {
        $this->assertEquals('1.00', $this->object->getDepositAmount());
    }

    public function testGetCurrency()
    {
        $this->assertEquals('EUR', $this->object->getCurrency());
    }

    public function testGetTimeCreated()
    {
        $this->assertInstanceOf(\DateTime::class, $this->object->getTimeCreated());
    }

    public function testGetTimeModified()
    {
        $this->assertInstanceOf(\DateTime::class, $this->object->getTimeModified());
    }

    public function testGetState()
    {
        $this->assertEquals('payment_deposited', $this->object->getState());
    }

    public function testGetPaymentType()
    {
        $this->assertEquals('PSC', $this->object->getPaymentType());
    }

    public function testGetOperationsAllowed()
    {
        $this->assertEquals(array(''), $this->object->getOperationsAllowed());
    }

    public function testGetGatewayReferencenumber()
    {
        $this->assertEquals('', $this->object->getGatewayReferencenumber());
    }

    public function testGetAvsResultCode()
    {
        $this->assertEquals('', $this->object->getAvsResultCode());
    }

    public function testGetAvsResultMessage()
    {
        $this->assertEquals('', $this->object->getAvsResultMessage());
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
        $this->object = null;
    }
}

