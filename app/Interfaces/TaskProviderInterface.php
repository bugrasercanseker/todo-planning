<?php

namespace App\Interfaces;

interface TaskProviderInterface
{
    /**
     * @return void
     */
    public function getTasks(): void;
}
