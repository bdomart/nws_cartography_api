<?php

namespace App\Controller;

use App\Entity\Geometry;
use App\Form\GeometryFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GeometryController extends AbstractController
{
    /**
     * @Route(
     *     "/geometry",
     *     name="post_geometry",
     *     methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function createGeometry(Request $request)
    {
        $geometry = new Geometry();
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(GeometryFormType::class, $geometry);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($geometry);
            $entityManager->flush();
        } else {
            foreach($form->getErrors() as $error) {
                $errors[] = $error->getMessage();
            }
        }
    }
}
