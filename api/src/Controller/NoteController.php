<?php
namespace App\Controller;

use App\Dto\NoteDto;
use App\Entity\Note;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/notes')]
class NoteController extends AbstractController
{
    #[Route(methods: ['GET'])]
    public function get(EntityManagerInterface $entityManager): Response
    {
        $notes = $entityManager->getRepository(Note::class)->findAll();
        return $this->json($notes);
    }

    #[Route(methods: ['POST'])]
    public function post(EntityManagerInterface $entityManager, #[MapRequestPayload] NoteDto $dto): Response
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

    #[Route('/{id}', methods: ['PUT'])]
    public function put(EntityManagerInterface $entityManager, string $id, #[MapRequestPayload] NoteDto $dto): Response
    {
        $note = $entityManager->getRepository(Note::class)->find($id);
        if (! $note) {
            throw new NotFoundHttpException();
        }

        $note->setText($dto->text);
        $entityManager->flush();

        return $this->json($note);
    }
}
