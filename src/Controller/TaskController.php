<?php

namespace App\Controller;

use App\Entity\Task;
use App\Factory\ResponderFactory;
use App\Form\Type\TaskType;
use App\Service\TaskService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class TaskController
 * @package App\Controller
 */
class TaskController extends BaseController
{
    /**
     * @var TaskService
     */
    private TaskService $taskService;

    /**
     * @var ResponderFactory
     */
    private ResponderFactory $responderFactory;

    /**
     * TaskController constructor.
     * @param TaskService $taskService
     * @param ResponderFactory $responderFactory
     */
    public function __construct(TaskService $taskService, ResponderFactory $responderFactory)
    {
        $this->taskService = $taskService;
        $this->responderFactory = $responderFactory;
    }

    /**
     * @Route("/tasks", name="task.list", methods={"GET", "HEAD"})
     * @param Request $request
     * @return Response
     */
    public function list(Request $request)
    {
        $tasks = $this->taskService->getAll();
        $responseType = $request->query->get('format');

        return $this->responderFactory->get($responseType)->respond($tasks, Response::HTTP_OK);
    }

    /**
     * @Route("/tasks", name="task.create", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $this->processForm($request, $form);

        if ($form->isSubmitted() && !$form->isValid()) {
            return $this->responderFactory->get()->respond($this->formatFormErrors($form), Response::HTTP_BAD_REQUEST);
        }

        if (!$this->taskService->create($form->getData())) {
            return $this->responderFactory->get()->respond(
                $this->apiError('Something went wrong creating the task.'),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return $this->responderFactory->get()->respond($task, Response::HTTP_CREATED);
    }
}
