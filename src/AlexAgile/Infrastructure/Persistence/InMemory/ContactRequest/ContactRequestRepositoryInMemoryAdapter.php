<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\InMemory\ContactRequest;

use AlexAgile\Domain\ContactRequest\ContactRequest;
use AlexAgile\Domain\ContactRequest\ContactRequestId;
use AlexAgile\Domain\ContactRequest\ContactRequestRepositoryInterface;

final class ContactRequestRepositoryInMemoryAdapter implements ContactRequestRepositoryInterface
{
    /** @var array */
    private $data = [];

    public function __construct(array $data = [])
    {
        $this->data = array_reduce($data, function ($carry, ContactRequest $contactRequest) {
            $carry[$contactRequest->getId()->id()] = clone $contactRequest;

            return $carry;
        }, []);
    }

    public function find(ContactRequestId $contactRequestId): ?ContactRequest
    {
        if (!array_key_exists($contactRequestId->id(), $this->data)) {
            return null;
        }

        return clone $this->data[$contactRequestId->id()];
    }

    public function findAll(): array
    {
        return array_map(function (ContactRequest $contactRequest) {
            return clone $contactRequest;
        }, $this->data);
    }

    public function save(ContactRequest $contactRequest): void
    {
        $this->data[$contactRequest->getId()->id()] = clone $contactRequest;
    }
}
