<?php

namespace Petstore\Core\Interfaces;

/**
 * Interface for the Pet entity of pet store
 */
interface Item {
    
    /**
     * Return true if item can be moved to the showroom
     * @return bool
     */
    public function isPresentable(): bool;

    /**
     * Return true if item can be sold
     * @return bool
     */
    public function isSellable(): bool;

    /**
     * Return true if pet can be returned 
     * @return bool
     */
    public function isChipRequiredPet(): bool;

    /**
     * Return true if pet can be returned to the shop by insurance
     * @return bool
     */
    public function canBeReturned(): bool;

    /**
     * Return true if aminal has already sold
     * @return bool
     */
    public function isSold(): bool;

    /**
     * Return animal's age in microseconds
     * @return int
     */
    public function getAge(): int;

    /**
     * Return true if aminal has already have a chip
     * @return bool
     */
    public function hasChip(): bool;

    /**
     * Return true if aminal is ready for chip injecting
     * @return bool
     */
    public function isGoodForChipping(): bool;

    /**
     * Move item to a store showroom
     */
    public function moveToShowroom(): void;

    /**
     * Set item as bought
     * @param String $buyer_email
     * @return bool
     */
    public function buy($buyer_email): bool;

    /**
     * Set item as insured
     */
    public function buyInsurance(): void;

    /**
     * Set item as bought with optional deposite
     * @return bool
     */
    public function buyOptionalDeposite($buyer_email): bool;

    /**
     * Set item as returned by the insurance (if the one was insured)
     * @return bool
     */
    public function return(): bool;
}
