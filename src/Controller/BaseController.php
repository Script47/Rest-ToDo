<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BaseController
 * @package App\Controller
 */
class BaseController extends AbstractController
{
    /**
     * @param Request $request
     * @param FormInterface $form
     */
    public function processForm(Request $request, FormInterface $form): void
    {
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
    }

    public function apiError(string $message)
    {
        return [
            'status' => 'failed',
            'message' => $message
        ];
    }

    /**
     * @param FormInterface $form
     * @return array
     */
    public function formatFormErrors(FormInterface $form): array
    {
        $errors = [];

        foreach ($form->getErrors() as $key => $error) {
            if ($form->isRoot()) {
                $errors['#'][] = $error->getMessage();
            } else {
                $errors[] = $error->getMessage();
            }
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->formatFormErrors($child);
            }
        }

        return $errors;
    }
}
