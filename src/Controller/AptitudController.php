<?php

namespace App\Controller;

use App\Repository\AptitudRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/aptitud')]
final class AptitudController extends AbstractController
{
    #[Route('/all', name: 'app_aptitud', methods: ['GET'])]
    public function getAllAptitudes(AptitudRepository $aptitudRepository): JsonResponse
    {
        $listaAptitudes = $aptitudRepository->findAll();
        return $this->json($listaAptitudes);
    }
}
