<?php

namespace App\Shared\Application\DTO;

class ResponseObject
{
    public function __construct(
        public bool $success = true,
        public string $message = '',
        public array $errors = [],
        public mixed $payload = null,
    ){}
}