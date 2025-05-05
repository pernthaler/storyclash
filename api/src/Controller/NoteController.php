<?php
namespace App\Controller;

use App\Dto\CommentDto;
use App\Entity\Note;
use App\Entity\Reply;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/notes')]
class NoteController extends AbstractController
{
    #[Route(methods: ['GET'])]
    public function get(EntityManagerInterface $entityManager): JsonResponse
    {
        $notes = $entityManager->getRepository(Note::class)->findAll();
        return $this->json($notes);
    }

    #[Route(methods: ['POST'])]
    public function post(EntityManagerInterface $entityManager, #[MapRequestPayload] CommentDto $dto): JsonResponse
    {
        $users = $entityManager->getRepository(User::class)->findAll();
        if (! $users) {
            throw new ServiceUnavailableHttpException();
        }

        $user = $users[array_rand($users)];

        $note = new Note();
        $note->setText($dto->text);
        $note->setAuthor($user);
        $entityManager->persist($note);
        $entityManager->flush();

        return $this->json($note);
    }

    #[Route('/{id}', methods: ['PATCH'])]
    public function put(EntityManagerInterface $entityManager, int $id, #[MapRequestPayload] CommentDto $dto): JsonResponse
    {
        $note = $entityManager->getRepository(Note::class)->find($id);
        if (! $note) {
            throw new NotFoundHttpException();
        }

        $note->setText($dto->text);
        $entityManager->flush();

        return $this->json($note);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $note = $entityManager->getRepository(Note::class)->find($id);
        if (! $note) {
            throw new NotFoundHttpException();
        }

        $entityManager->remove($note);
        $entityManager->flush();

        return $this->json($note);
    }

    #[Route('/{id}/reply', methods: ['POST'])]
    public function reply(EntityManagerInterface $entityManager, int $id, #[MapRequestPayload] CommentDto $dto): JsonResponse
    {
        $note = $entityManager->getRepository(Note::class)->find($id);
        if (! $note) {
            throw new NotFoundHttpException();
        }

        $users = $entityManager->getRepository(User::class)->findAll();
        if (! $users) {
            throw new ServiceUnavailableHttpException();
        }

        $user = $users[array_rand($users)];

        $reply = new Reply();
        $reply->setText($dto->text);
        $reply->setAuthor($user);
        $note->addReply($reply);
        $entityManager->flush();

        return $this->json($note);
    }

}
