<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\ContactRequest;

use AlexAgile\Domain\ContactRequest\ContactRequest;
use AlexAgile\Domain\ContactRequest\ContactRequestId;
use AlexAgile\Domain\ContactRequest\ContactRequestNotFoundException;
use AlexAgile\Domain\ContactRequest\ContactRequestRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;

final class ContactRequestRepositoryDoctrineAdapter implements ContactRequestRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @throws ContactRequestNotFoundException
     */
    public function find(ContactRequestId $contactRequestId): ?ContactRequest
    {
        try {
            $query = $this->em->createQueryBuilder()
                ->select('cr')
                ->from('AlexAgile\Domain\ContactRequest\ContactRequest', 'cr')
                ->where('cr.contactRequestId = :contactRequestId')
                ->setParameter('contactRequestId', $contactRequestId)
                ->getQuery();

            return $query->execute();
        } catch (NoResultException $e) {
            throw new ContactRequestNotFoundException('ContactRequest not found');
        }
    }

    /**
     * @return ContactRequest[]
     */
    public function findAll(): array
    {
        return $this->em->getRepository(ContactRequest::class)->findAll();
    }

    public function save(ContactRequest $contactRequest): void
    {
        $this->em->persist($contactRequest);
        $this->em->flush();
    }
}
