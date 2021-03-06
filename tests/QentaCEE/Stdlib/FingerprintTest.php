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
use PHPUnit\Framework\TestCase;

class QentaCEE_Stdlib_FingerprintTest extends TestCase
{

    public function setUp(): void
    {
        // set default value
        QentaCEE\Stdlib\Fingerprint::stripSlashes(false);
    }

    public function testSetStripSlashes()
    {
        QentaCEE\Stdlib\Fingerprint::stripSlashes(true);
        $this->addToAssertionCount(1);
    }

    /**
     * @dataProvider fingerprintProvider
     */
    public function testGenerate($values, $fingerprintOrder, $hash)
    {
        QentaCEE\Stdlib\Fingerprint::setHashAlgorithm(QentaCEE\Stdlib\Fingerprint::HASH_ALGORITHM_HMAC_SHA512);
        $this->assertEquals($hash, QentaCEE\Stdlib\Fingerprint::generate($values,
            new QentaCEE\Stdlib\FingerprintOrder($fingerprintOrder)));
    }

    /**
     * @dataProvider fingerprintProvider
     */
    public function testGenerateStripSlashes($values, $fingerprintOrder, $hash)
    {
        QentaCEE\Stdlib\Fingerprint::stripSlashes(true);
        $this->assertEquals($hash, QentaCEE\Stdlib\Fingerprint::generate($values,
            new QentaCEE\Stdlib\FingerprintOrder($fingerprintOrder)));
    }

    /**
     * @dataProvider fingerprintProvider
     */
    public function testGenerateException($values, $fingerprintOrder, $hash)
    {
        $this -> expectException(QentaCEE\Stdlib\Exception\InvalidValueException::class);
        $fingerprintOrder[] = 'FailKey';
        try {
            QentaCEE\Stdlib\Fingerprint::generate($values,
                new QentaCEE\Stdlib\FingerprintOrder($fingerprintOrder));
        } catch (QentaCEE\Stdlib\Exception\InvalidValueException $e) {
            $this->assertEquals('Value for key FAILKEY not found in values array.', $e->getMessage());
            throw $e;
        }
    }

    /**
     * @dataProvider fingerprintProvider
     */
    public function testCompare($values, $fingerprintOrder, $hash)
    {
        $this->assertTrue(QentaCEE\Stdlib\Fingerprint::compare($values,
            new QentaCEE\Stdlib\FingerprintOrder($fingerprintOrder), $hash));
    }

    /**
     * @dataProvider fingerprintProvider
     */
    public function testCompareStripSlashes($values, $fingerprintOrder, $hash)
    {
        QentaCEE\Stdlib\Fingerprint::stripSlashes(true);
        $this->assertTrue(QentaCEE\Stdlib\Fingerprint::compare($values,
            new QentaCEE\Stdlib\FingerprintOrder($fingerprintOrder), $hash));
    }

    /**
     * @dataProvider fingerprintProvider
     */
    public function testFalseCompare($values, $fingerprintOrder, $hash)
    {
        $hash = md5($hash);
        $this->assertFalse(QentaCEE\Stdlib\Fingerprint::compare($values,
            new QentaCEE\Stdlib\FingerprintOrder($fingerprintOrder), $hash));
    }

    public static function fingerprintProvider()
    {
        return Array(
            Array(
                'values'           => Array(
                    'key1' => 'value1',
                    'key2' => 'value2',
                    'key3' => 'value3',
                    'key4' => 'value4',
                    'secret' => QentaCEE\QPay\Module::getConfig()['QentaCEEQPayConfig']['SECRET']
                ),
                'fingerprintOrder' => Array(
                    'key1',
                    'key2',
                    'key3',
                    'key4',
                    'secret'
                ),
                'hash'             => '6c8bc309cbdf78770fd4820c12a6573c1fb6371ba86a4a34e5226dc529d70cb61cbec1af21faaf0567aeabad868acf9bf08030caec008ff2c8856bae676801e8'
            ),
            Array(
                'values'           => Array(
                    'key1' => 'äöü',
                    'key2' => '#+ü',
                    'key3' => '///',
                    'key4' => 'bla',
                    'secret' => QentaCEE\QPay\Module::getConfig()['QentaCEEQPayConfig']['SECRET']
                ),
                'fingerprintOrder' => Array(
                    'key1',
                    'key2',
                    'key3',
                    'key4',
                    'secret'
                ),
                'hash'             => '3af32ea6d1bc69284625b6d245d84aadc6b8df0df131090e7265c5919bb76eadd0d72a63646da0d8019036c409f91b6ab9a7e6cae661ad4528d15db50b4c4678'
            )
        );
    }
}