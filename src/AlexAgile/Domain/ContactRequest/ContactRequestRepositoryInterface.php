<?php
declare(strict_types=1);

namespace AlexAgile\Domain\ContactRequest;

interface ContactRequestRepositoryInterface
{
    /**
     * @throws ContactRequestNotFoundException
     */
    public function find(ContactRequestId $contactRequestId):? ContactRequest;

    /** @return ContactRequest[] */
    public function findAll(): array;

    public function save(ContactRequest $contactRequest): void;
}
