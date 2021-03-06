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
 * QentaCEE_QPay_ReturnFactory test case.
 */
use PHPUnit\Framework\TestCase;
use QentaCEE\QPay\Returns\Success\CreditCard;
use QentaCEE\QPay\Returns\Success\PayPal;
use QentaCEE\QPay\Returns\Success\Sofortueberweisung;
use QentaCEE\QPay\Returns\Success\Ideal;
use QentaCEE\QPay\Returns\Success;
use QentaCEE\QPay\Returns\Failure;
use QentaCEE\QPay\Returns\Cancel;

class QentaCEE_QPay_ReturnFactoryTest extends TestCase
{
    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';

    /**
     *
     * @var QentaCEE_QPay_ReturnFactory
     */
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown(): void
    {
        $this->object = null;
        parent::tearDown();
    }

    /**
     * Tests QentaCEE_QPay_ReturnFactory::getInstance()
     */
    public function testGetInstance()
    {
        $return = Array(
            'paymentState' => QentaCEE\QPay\ReturnFactory::STATE_SUCCESS,
            'paymentType'  => 'CCARD'
        );

        $oInstance = QentaCEE\QPay\ReturnFactory::getInstance($return, $this->_secret);
        $this->assertTrue(is_object($oInstance));
    }

    public function testSuccessInstance()
    {
        $return = Array(
            'paymentState' => QentaCEE\QPay\ReturnFactory::STATE_SUCCESS,
            'paymentType'  => 'CCARD'
        );

        $oInstance = QentaCEE\QPay\ReturnFactory::getInstance($return, $this->_secret);
        $this->assertInstanceOf(CreditCard::class, $oInstance);
    }

    public function testSuccessPaypalInstance()
    {
        $return = Array(
            'paymentState' => QentaCEE\QPay\ReturnFactory::STATE_SUCCESS,
            'paymentType'  => 'Paypal'
        );

        $oInstance = QentaCEE\QPay\ReturnFactory::getInstance($return, $this->_secret);
        $this->assertInstanceOf(PayPal::class, $oInstance);
    }

    public function testSuccessSofortueberweisungInstance()
    {
        $return = Array(
            'paymentState' => QentaCEE\QPay\ReturnFactory::STATE_SUCCESS,
            'paymentType'  => 'SOFORTUEBERWEISUNG'
        );

        $oInstance = QentaCEE\QPay\ReturnFactory::getInstance($return, $this->_secret);
        $this->assertInstanceOf(Sofortueberweisung::class, $oInstance);
    }

    public function testSuccessIdealInstance()
    {
        $return = Array(
            'paymentState' => QentaCEE\QPay\ReturnFactory::STATE_SUCCESS,
            'paymentType'  => 'IDL'
        );

        $oInstance = QentaCEE\QPay\ReturnFactory::getInstance($return, $this->_secret);
        $this->assertInstanceOf(Ideal::class, $oInstance);
    }

    public function testSuccessDefaultInstance()
    {
        $return = Array(
            'paymentState' => QentaCEE\QPay\ReturnFactory::STATE_SUCCESS,
            'paymentType'  => ''
        );

        $oInstance = QentaCEE\QPay\ReturnFactory::getInstance($return, $this->_secret);
        $this->assertInstanceOf(Success::class, $oInstance);
    }

    public function testInstanceWIthNoPaymentType()
    {
        $this -> expectException(QentaCEE\QPay\Exception\InvalidResponseException::class);
        $return = Array(
            'paymentState' => QentaCEE\QPay\ReturnFactory::STATE_SUCCESS
        );

        $oInstance = QentaCEE\QPay\ReturnFactory::getInstance($return, $this->_secret);
    }

    public function testFailureState()
    {
        $return = Array(
            'paymentState' => QentaCEE\QPay\ReturnFactory::STATE_FAILURE
        );

        $oInstance = QentaCEE\QPay\ReturnFactory::getInstance($return, $this->_secret);
        $this->assertInstanceOf(Failure::class, $oInstance);
    }

    public function testCancelState()
    {
        $return = Array(
            'paymentState' => QentaCEE\QPay\ReturnFactory::STATE_CANCEL,
            'paymentType'  => 'CCARD'
        );

        $oInstance = QentaCEE\QPay\ReturnFactory::getInstance($return, $this->_secret);
        $this->assertInstanceOf(Cancel::class, $oInstance);
    }

    public function testNoState()
    {
        $this -> expectException(QentaCEE\QPay\Exception\InvalidResponseException::class);
        $return    = Array(
            'paymentState' => 999
        );
        $oInstance = QentaCEE\QPay\ReturnFactory::getInstance($return, $this->_secret);
    }

    public function testInstanceWithEmptyPaymentStateInArray()
    {
        $this -> expectException(QentaCEE\QPay\Exception\InvalidResponseException::class);
        $oInstance = QentaCEE\QPay\ReturnFactory::getInstance(Array(), $this->_secret);
    }

    public function testWhenReturnIsNotArray()
    {
        $this -> expectException(QentaCEE\QPay\Exception\InvalidResponseException::class);
        $return    = "";
        $oInstance = QentaCEE\QPay\ReturnFactory::getInstance($return, $this->_secret);
    }

    public function testGenerateConfirmResponseNOKString()
    {
        $response = QentaCEE\QPay\ReturnFactory::generateConfirmResponseString('nok test');
        $this->assertEquals('<QPAY-CONFIRMATION-RESPONSE result="NOK" message="nok test" />',
            $response);
    }

    public function testGenerateConfirmResponseHtmlCommentNOKString()
    {
        $response = QentaCEE\QPay\ReturnFactory::generateConfirmResponseString('nok test', true);
        $this->assertEquals('<!--<QPAY-CONFIRMATION-RESPONSE result="NOK" message="nok test" />-->',
            $response);
    }

    public function testGenerateConfirmResponseOKString()
    {
        $response = QentaCEE\QPay\ReturnFactory::generateConfirmResponseString();
        $this->assertEquals('<QPAY-CONFIRMATION-RESPONSE result="OK" />', $response);
    }

    public function testGenerateConfirmResponseHtmlCommentOKString()
    {
        $response = QentaCEE\QPay\ReturnFactory::generateConfirmResponseString('', true);
        $this->assertEquals('<!--<QPAY-CONFIRMATION-RESPONSE result="OK" />-->', $response);
    }
}

