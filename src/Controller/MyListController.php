<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\PlaylistRepository;
use App\Repository\PlaylistSubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MyListController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/lists', name: 'page_lists')]
    public function discover_category(
        PlaylistRepository $playlistRepository,
        PlaylistSubscriptionRepository $playlistSubscriptionRepository,
        Request $request
    ): Response
    {
        $rcaca = $request->query->get('playlist');

        if ($rcaca) {
            $currentPlaylist = $playlistRepository -> find($rcaca);
        } else {
            $currentPlaylist = null;
        }

        return $this->render('lists.html.twig',[
            'playlists' => $playlistRepository -> findAll(),
            'playlistSubscriptions' => $playlistSubscriptionRepository->findAll(),
            'currentPlaylist' => $currentPlaylist
            ]);
    }
}
