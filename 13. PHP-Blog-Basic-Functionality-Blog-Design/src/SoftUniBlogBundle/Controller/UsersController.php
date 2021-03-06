<?php

namespace SoftUniBlogBundle\Controller;

use SoftUniBlogBundle\Entity\Role;
use SoftUniBlogBundle\Entity\User;
use SoftUniBlogBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UsersController extends Controller
{
    /**
     * @Route ("/register", name="user_register")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
     $user = new User();
$form = $this->createForm(UserType::class, $user);
$form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
        $password = $this->get('security.password_encoder')
            ->encodePassword($user, $user->getPassword());
        $user->setPassword($password);

$roleRepository = $this->getDoctrine()->getRepository(Role::class);
$userRole = $roleRepository->findOneBy(['name' => 'ROLE_USER']);
        /** @var Role $userRole */
        $user->addRole($userRole);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $this->redirect('/login');
    }
    return $this->render('default/register.html.twig' ,[
    'form' => $form->createView()
        ]);
    }
}
