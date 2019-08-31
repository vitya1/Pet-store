<?php
namespace Petstore\Core\Base;

/**
 * @see Petstore\tests\Core\PaymentTest
 */
abstract class Payment extends Model {
    public const TYPE_BUY_ITEM = 'buy';
    public const TYPE_RETURN = 'return';
    public const TYPE_INSURANCE = 'insurance';
    public const TYPE_OPTIONAL_DEPOSITE = 'deposite';
    public const TYPE_OPTIONAL_PAYOUT = 'payout';

    public const INSURANCE_PRICE = 10000;
    public const INSURANCE_RETURN = 80;
    public const DEPOSITE_AMOUNT = 20;

    /** @var int */
    public $time;
    /** @var int */
    public $type;
    /** @var float */
    public $sum;

    /**
     * @param float $price
     * @param float
     */
    public static function getOptionalDeposite($price) {
        return ($price / 100) * static::DEPOSITE_AMOUNT;
    }

    /**
     * @param float $price
     * @param float
     */
    public static function getOptionalPayout($price) {
        return ($price / 100) * (100 - static::DEPOSITE_AMOUNT);
    }

    /**
     * @param float $price
     * @param float
     */
    public static function getReturnAmount($price) {
        return ($price / 100) * static::INSURANCE_RETURN;
    }

}
