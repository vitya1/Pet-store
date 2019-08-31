<?php

namespace Petstore\Core\Interfaces;

/**
 * Interface for pet store payments
 */
interface Payment {

    /**
     * Set current payment model as buying item payment and save
     * @param float $item_price
     */
    public function saveItemPurchase(float $item_price): void;
    
    /**
     * Set current payment model as buying insurance payment and save
     * @param float $item_price
     */
    public function saveInsurance(): void;

    /**
     * Set current payment model as buying optional deposite payment and save
     * @param float $item_price
     */
    public function saveOptionalDeposite(float $item_price): void;

    /**
     * Set current payment model as buying optional deposite payment and save
     * @param float $item_price
     */
    public function saveOptionalPayout(float $item_price): void;

    /**
     * Set current payment model as return payment and save
     * @param float $item_price
     */
    public function saveReturnItem(float $item_price): void;

    /**
     * Set current payment model as vet payment and save
     * @param float $item_price
     */
    public function saveVeterinarPayment(): void;

}
