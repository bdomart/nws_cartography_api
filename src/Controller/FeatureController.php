<?php

namespace App\Controller;

use App\Entity\Feature;
use App\Form\FeatureFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FeatureController extends AbstractController
{
    /**
     * @Route(
     *     "/features",
     *     name="get_features",
     *     methods={"GET"})
     */
    public function getFeatures()
    {
        $features = $this->getDoctrine()
            ->getRepository(Feature::class)
            ->findAll();

        return $features;
    }

    /**
     * @Route(
     *     "/geojson/{features}",
     *     name="get_geojson_features",
     *     methods={"GET"},
     *     requirements={"features" = "\d+"})
     * @param array $features
     * @return JsonResponse
     */
    public function getGeojsonFeatures($features = [])
    {
        if (!$features) {
            $features = $this->getFeatures();
        }

        $geojson_array = [];
        /** @var Feature $feature */
        foreach ($features as $feature) {
            if (!$this->isValidGeojsonFeature($feature)) {
                continue;
            }

            $geojson_item = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => $feature->getGeometry()->getTypeGeometry()->getName(),
                    'coordinates' => $feature->getGeometry()->getCoordinates()
                ],
                'properties' => [
                    'address' => $feature->getAddress(),
                    'city' => $feature->getCity(),
                    'postalCode' => $feature->getPostalCode()
                ]
            ];

            if ($locations = $feature->getLocation()){
                foreach ($locations as $location) {
                    if (!empty($location->getName())) {
                        $geojson_item['properties']['location'][] = [
                            'name' => $location->getName(),
                            'description' => $location->getDescription(),
                            'info' => $location->getInfo()
                        ];
                    }
                }
            }

            $geojson_array[] = $geojson_item;
        }

        return new JsonResponse($geojson_array, 200, ['Access-Control-Allow-Origin' => '*']);
    }

    /**
     * @Route(
     *     "/feature",
     *     name="post_feature",
     *     methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function createFeature(Request $request)
    {
        $feature = new Feature();
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(FeatureFormType::class, $feature);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feature);
            $entityManager->flush();
        } else {
            foreach($form->getErrors() as $error) {
                $errors[] = $error->getMessage();
            }
        }
    }

    /**
     * @param Feature $feature
     * @return bool
     */
    private function isValidGeojsonFeature(Feature $feature)
    {
        if (!$geometry = $feature->getGeometry()) {
            return false;
        } else {
            $typeGeometry = $geometry->getTypeGeometry();
            if (!empty($typeGeometry->getCoordinateNumber())
                && $typeGeometry->getCoordinateNumber() != count($geometry->getCoordinates())) {
                return false;
            }
        }

        return true;
    }
}
