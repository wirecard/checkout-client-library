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
 * QentaCEE_QMore_Response_Backend_Refund test case.
 */
use PHPUnit\Framework\TestCase;

class QentaCEE_QMore_Response_Backend_RefundTest extends TestCase
{

    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';
    protected $_customerId = 'D200001';
    protected $_shopId = 'seamless';
    protected $_language = 'en';
    protected $_toolkitPassword = 'jcv45z';
    protected $_orderNumber = 123456;
    protected $_amount = '1.2';
    protected $_currency = 'USD';

    /**
     *
     * @var QentaCEE_QMore_Response_Backend_Refund
     */
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->object  = new QentaCEE\QMore\BackendClient(Array(
            'CUSTOMER_ID' => $this->_customerId,
            'SHOP_ID'     => $this->_shopId,
            'SECRET'      => $this->_secret,
            'LANGUAGE'    => $this->_language,
            'PASSWORD'    => $this->_toolkitPassword
        ));
    }

    /**
     * Test getStatus()
     */
    public function testGetStatus()
    {
        $response = $this->object->refund($this->_orderNumber, $this->_amount, $this->_currency);
        $this->assertEquals($response->getStatus(), 0);
    }

    /**
     * Test getErrors()
     */
    public function testGetErrors()
    {
        $response = $this->object->refund($this->_orderNumber, $this->_amount, $this->_currency);
        $this->assertEmpty($response->getErrors());
    }

    /**
     * Test getCreditNumber()
     */
    public function testGetCreditNumber()
    {
        $response = $this->object->refund($this->_orderNumber, $this->_amount, $this->_currency);
        $this->assertIsString($response->getCreditNumber());
        $this->assertNotEquals('', $response->getCreditNumber());
    }

    /**
     * Test basket data
     */
    public function testWithBasketData()
    {
        $response = $this->object->refund($this->_orderNumber, $this->_amount, $this->_currency, $this->getValidBasket());
        $this->assertIsString($response->getCreditNumber());
        $this->assertNotEquals('', $response->getCreditNumber());
    }

    /**
     * Test hasFailed()
     */
    public function testHasFailed()
    {
        $response = $this->object->refund($this->_orderNumber, $this->_amount, $this->_currency);
        $this->assertFalse($response->hasFailed());
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown(): void
    {
        // TODO Auto-generated
        // QentaCEE_QMore_Response_Backend_RefundTest::tearDown()
        $this->object = null;

        parent::tearDown();
    }

    /**
     * Creates a valid shopping basket.
     *
     * @return QentaCEE_Stdlib_Basket
     */
    private function getValidBasket()
    {
        $basketItem = new QentaCEE\Stdlib\Basket\Item('QentaCEETestItem');
        $basketItem->setUnitGrossAmount(10)
            ->setUnitNetAmount(8)
            ->setUnitTaxAmount(2)
            ->setUnitTaxRate(20.0)
            ->setDescription('unittest description')
            ->setName('unittest name')
            ->setImageUrl('http://example.com/picture.png');

        $basket = new QentaCEE\Stdlib\Basket();
        $basket->addItem($basketItem);

        return $basket;
    }
}

