<?php
namespace Petstore\Core;

use Petstore\Core\Base\Payment as BasePayment;
use Petstore\Core\Interfaces\Payment as PaymentInterface;

/**
 * Model for store money transactions
 * @see Petstore\tests\Core\PaymentTest
 */
class Payment extends BasePayment implements PaymentInterface {
    public const TYPE_VETERINAR = 'veterinar';
    public const VET_PRICE = 200;

    public static function getTableName(): string {
        return 'payments';
    }

    /**
     * @inheritdoc
     */
    public function saveItemPurchase(float $item_price): void {
        $this->saveWithData(self::TYPE_BUY_ITEM, $item_price);
    }

    /**
     * @inheritdoc
     */
    public function saveInsurance(): void {
        $this->saveWithData(self::TYPE_INSURANCE, self::INSURANCE_PRICE);
    }

    /**
     * @inheritdoc
     */
    public function saveOptionalDeposite(float $item_price): void {
        $this->saveWithData(Payment::TYPE_OPTIONAL_DEPOSITE, self::getOptionalDeposite($pet->price));
    }

    /**
     * @inheritdoc
     */
    public function saveOptionalPayout(float $item_price): void {
        $this->saveWithData(Payment::TYPE_OPTIONAL_PAYOUT, Payment::getOptionalPayout($item_price));
    }

    /**
     * @inheritdoc
     */
    public function saveReturnItem(float $item_price): void {
        $this->saveWithData(Payment::TYPE_RETURN, Payment::getOptionalPayout($item_price));
    }

    /**
     * @inheritdoc
     */
    public function saveVeterinarPayment(): void {
        $this->saveWithData(self::TYPE_VETERINAR, self::VET_PRICE);
    }

    /**
     * Setup data and save model
     * @param $type
     * @param $sum
     */
    private function saveWithData($type, $sum): void {
        $this->type = $type;
        $this->sum = $sum;
        $this->time = time();
        $this->save();
    }

}
