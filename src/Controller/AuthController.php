<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Mailer\AuthMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Uid\Uuid;

class AuthController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('auth/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }



    #[Route('/forgot', name: 'forgot_password')]
    public function forgotPassword(
        Request $request,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        AuthMailer $authMailer
    ): Response {
        $email = $request->get('email');

        $user = $userRepository->findOneBy(['email' => $email]);

        if ($user instanceof User) {

            $user->setResetToken(Uuid::v4()->toRfc4122());
            $entityManager->flush();

            $authMailer->sendForgotEmail($user);
        }

        return $this->render('auth/forgot.html.twig');
    }

    #[Route('/reset/{token}', name: 'page_reset')]
    public function reset(
        string $token,
        UserRepository $userRepository,
        Request $request,
        EntityManagerInterface $entityManager,
        AuthMailer $authMailer
    ): Response
    {
        if (!$token) {
            return $this->redirectToRoute('forgot_password');
        }

        $user = $userRepository->findOneBy(['resetToken' => $token]);

        if (!$user instanceof User) {
            return $this->redirectToRoute('forgot_password');
        }

        if($request->isMethod('POST')) {
            $password = $request->get('password');
            $repeatedPassword = $request->get('repeat-password');

            if ($password === $repeatedPassword) {
                $user->setPassword($password);
                $user->setResetToken(null);
                $authMailer->sendResetEmail($user);

                $entityManager->flush();

                $this->addFlash('success', 'Votre mot de passe a été modifié avec succès !');
            } else {
                $this->addFlash('error', 'Les mots de passe ne correspondent pas !');
            }
        }

        return $this->render('auth/reset.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/register', name: 'register')]
    public function register(): Response
    {
        return $this->render('auth/register.html.twig');
    }

    #[Route('/confirm', name: 'confirm_account')]
    public function confirm(): Response
    {
        return $this->render('auth/confirm.html.twig');
    }

    #[Route('/profile', name: 'profile')]
    public function profile(): Response
    {
        return $this->render('auth/index.html.twig');
    }

}