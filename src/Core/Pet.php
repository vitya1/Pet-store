<?php
namespace Petstore\Core;

use Petstore\Core\Base\Item as BaseItem;
use Petstore\Core\Interfaces\Item as ItemInterface;

/**
 * Pet model of pet store
 */
class Pet extends BaseItem implements ItemInterface {
    public const TYPE_DOG = 'dog';
    public const TYPE_CAT = 'cat';
    public const TYPE_BIRD = 'bird';

    public const CHIPPING_AGE = 2 * 30 * 86400;
    public const INSURANCE_LIFETIME = 3 * 30 * 86400;

    /** @var int */
    public $id;
    /** @var string */
    public $name;
    /** @var string */
    public $type;
    /** @var float */
    public $price;
    /** @var string */
    public $description;

    /** @var int */
    public $birth_date;
    /** @var mixed */
    public $chip_id;

    /**
     * @return String
     */
    public static function getTableName(): String {
        return 'pets';
    }

    /**
     * @inheritdoc
     */
    public function isPresentable(): bool {
        return !$this->isSold() && !$this->is_optional;
    }

    /**
     * @inheritdoc
     */
    public function isSellable(): bool {
        return !$this->isSold() && (
            !$this->isChipRequiredPet()
             || ($this->isChipRequiredPet() && $this->hasChip())
        );
    }

    /**
     * @inheritdoc
     */
    public function isChipRequiredPet(): bool {
        return $this->type == static::TYPE_DOG || $this->type == static::TYPE_CAT;
    }

    /**
     * @inheritdoc
     */
    public function canBeReturned(): bool {
        return $this->isSold()
         && $this->is_insured
         && ($this->time() - $this->sale_time <= self::INSURANCE_LIFETIME);
    }

    /**
     * @inheritdoc
     */
    public function isSold(): bool {
        return $this->location == static::LOCATION_BUYER;
    }

    /**
     * @inheritdoc
     */
    public function getAge(): int {
        return $this->time() - $this->birth_date;
    }

    /**
     * @inheritdoc
     */
    public function hasChip(): bool {
        return boolval($this->chip_id);
    }

    /**
     * @inheritdoc
     */
    public function isGoodForChipping(): bool {
        return $this->isChipRequiredPet()
         && !$this->isSold()
         && !$this->hasChip()
         && $this->getAge() >= static::CHIPPING_AGE;
    }

    /**
     * To simplify auto testing
     * @return int
     */
    public function time()
    {
        return time();
    }
}
