<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Task;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;



class TaskController extends AbstractController
{
    #[Route('/', name: 'app_products')]
    public function index(PersistenceManagerRegistry $doctrine): Response
    {
        $task = $doctrine->getRepository(Task::class)->findBy([], ['id' => 'DESC']);
        return $this->render('task/index.html.twig', ['tasks' => $task]);
    }
    #[Route('/create', name: 'create_task', methods: ['POST'])]
    public function create(Request  $request, PersistenceManagerRegistry $doctrine)
    {
        $title = trim($request->request->get('title'));
        if (empty($title))
            return $this->redirectToRoute('app_products');
        $entityManager = $doctrine->getManager();
        $task = new Task;
        $task->setTitle($title);
        $entityManager->persist($task);
        $entityManager->flush();
        return $this->redirectToRoute('app_products');
    }
    #[Route("/update/{id}", name: 'update_status')]
    public function update($id, PersistenceManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $task = $doctrine->getRepository(Task::class)->find($id);
        $task->setStatus(!$task->isStatus());
        $entityManager->flush();
        return $this->redirectToRoute('app_products');
    }
    #[Route("/delete/{id}", name: 'delete_status')]
    public function delete(Task $id, PersistenceManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($id);
        $entityManager->flush();
        return $this->redirectToRoute('app_products');
    }
}
