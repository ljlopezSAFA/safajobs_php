<?php

namespace App\Controller;

use App\Entity\Aptitud;
use App\Entity\TipoAptitud;
use App\Repository\AptitudRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/{id}', name: 'aptitud_by_id', methods: ['GET'])]
    public function getById(Aptitud $aptitud):JsonResponse
    {
        return $this->json($aptitud);
    }

    #[Route('', name: 'save_aptitud', methods: ['POST'])]
    public function crearAptitud(Request $request, EntityManagerInterface $entityManager): JsonResponse{

        $json_aptitud = json_decode($request->getContent(), true);

        $aptitud_guardar = new Aptitud();
        $aptitud_guardar->setTitulo($json_aptitud['titulo']);
        $aptitud_guardar->setDetalle($json_aptitud['detalle']);
        $aptitud_guardar->setTipo(TipoAptitud::tryFrom($json_aptitud['tipo']));

        $entityManager->persist($aptitud_guardar);
        $entityManager->flush();

        return JsonResponse::fromJsonString("Datos Guardados correctamente");

    }


    #[Route('/edit', name: 'edit_aptitud', methods: ['PUT'])]
    public function editar(Request $request, EntityManagerInterface $entityManager,
                           AptitudRepository $aptitudRepository): JsonResponse{

        $json_aptitud = json_decode($request->getContent(), true);

        $aptitud_guardar = $aptitudRepository->findBy(["id"=>$json_aptitud['id']])[0];
        $aptitud_guardar->setTitulo($json_aptitud['titulo']);
        $aptitud_guardar->setDetalle($json_aptitud['detalle']);
        $aptitud_guardar->setTipo(TipoAptitud::tryFrom($json_aptitud['tipo']));

        $entityManager->persist($aptitud_guardar);
        $entityManager->flush();

        return JsonResponse::fromJsonString("Datos Actualizados correctamente");

    }


    #[Route('/{id}', name: 'aptitud_delete_by_id', methods: ['DELETE'])]
    public function deleteById(Aptitud $aptitud,
                               EntityManagerInterface $entityManager):JsonResponse
    {

        $entityManager->remove($aptitud);
        $entityManager->flush();

        return JsonResponse::fromJsonString("Datos eliminados correctamente");
    }




}
