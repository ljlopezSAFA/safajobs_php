<?php

namespace App\Controller;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class UsuarioController extends AbstractController
{
    #[Route('/api/registro', name: 'app_usuario', methods: ["POST"])]
    public function registro(Request $request,
                             UserPasswordHasherInterface $userPasswordHasher,
                             EntityManagerInterface $entityManager): JsonResponse

    {

        $body = json_decode($request->getContent(), true);


        $nuevo_usuario = new Usuario();
        $nuevo_usuario->setUsername($body["username"]);
        $nuevo_usuario->setPassword($userPasswordHasher
            ->hashPassword($nuevo_usuario, $body["password"]));
        $nuevo_usuario->setRol("2");


        $entityManager->persist($nuevo_usuario);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Usuario registrado con éxito'], 201);
    }




}
