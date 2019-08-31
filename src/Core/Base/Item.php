<?php

namespace Petstore\Core\Base;

/**
 * Base class for store Item
 */
abstract class Item extends Model {
    public const LOCATION_BACKYARD = 'backyard';
    public const LOCATION_SHOWROOM = 'showroom';
    public const LOCATION_BUYER = 'buyer';

    /** @var int Payment time */
    public $sale_time;
    /** @var mixed */
    public $buyer_email;
    /** @var bool */
    public $is_insured = false;
    /** @var bool */
    public $is_optional = false;
    /** @todo Is in showroom */
    public $location = self::LOCATION_BACKYARD;

    /**
     * @inheritdoc
     */
    abstract public function isSellable(): bool;

    /**
     * @inheritdoc
     */
    abstract public function isPresentable(): bool;

    /**
     * @inheritdoc
     */
    public function moveToShowroom(): void {
        if($this->isPresentable()) {
            $this->location = self::LOCATION_SHOWROOM;
            $this->save();
        }
    }

    /**
     * @inheritdoc
     */
    public function buy($buyer_email): bool {
        if(!$this->isSellable()) {
            return false;
        }
        $this->location = self::LOCATION_BUYER;
        $this->buyer_email = $buyer_email;
        $this->sale_time = time();
        $this->save();
        return true;
    }

    /**
     * @inheritdoc
     */
    public function buyInsurance(): void {
        $this->is_insured = true;
        $this->save();
    }

    /**
     * @inheritdoc
     */
    public function buyOptionalDeposite($buyer_email): bool {
        if($this->isSold()) {
            return false;
        }
        $this->buyer_email = $buyer_email;
        $this->save();
        return true;
    }

    /**
     * @inheritdoc
     */
    public function return(): bool {
        if(!$this->canBeReturned()) {
            return false;
        }
        $this->location = self::LOCATION_BACKYARD;
        $this->save();
        return true;
    }

}
