<?php

namespace Petstore\Core\Interfaces;

/**
 * Interfase for pet Store class
 */
interface Store {

    /**
     * @return Item[]
     */
    public function getAllItems(): ?array;

    /**
     * Moves all items to backyard
     */
    public function moveAllToBackyard(): void;

    /**
     * Returns not chipped pets what old enought for the chipping
     * @return Item[]
     */
    public function getVeterinarRequiredPets(): ?array;

    /**
     * @param array $filter_params
     * @return Payment[]
     */
    public function getAllPayments($filter_params = []): ?array;

    /**
     * @return array
     */
    public function getDaysOpen(): array;

    /**
     * @return array
     */
    public function getShowroomSize(): array;

    /**
     * @return array
     */
    public function getBackyardSize(): array;
}
