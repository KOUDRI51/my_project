<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    
    
    // public function index(): JsonResponse
    // {
    //     return $this->json([
    //         'message' => 'Welcome to your new controller!',
    //         'path' => 'src/Controller/UserController.php',
    //     ]);
    // }
    public function register(Request $request, EntityManagerInterface $entityManager)
    {
        $data = json_decode($request->getContent(), true);
    
        $username = $data['username'];
        $password = $data['password'];
    
        // validate input
        if (empty($username) || empty($password)) {
            return new JsonResponse(['error' => 'Username and password are required'], 400);
        }
    
        // check if user already exists
        $existingUser = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);
        if ($existingUser) {
            return new JsonResponse(['error' => 'Username already exists'], 400);
        }
    
        // create new user
        $user = new User();
        $user->setUsername($username);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT)); // hash password
    
        // save user to database
        $entityManager->persist($user);
        $entityManager->flush();
    
        return new JsonResponse(['success' => 'User registered successfully'], 201);
    }
    
}
