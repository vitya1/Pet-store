<?php

namespace Petstore\App\Interfaces;

/**
 * Performs single use case
 */
interface UseCase {

    /**
     * Runs the action
     */
    public function handle();
}
