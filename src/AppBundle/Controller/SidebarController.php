<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SidebarController extends Controller
{
    public function listLastUsersAction()
    {
        $users = [
            ['username' => 'Marge'],
            ['username' => 'Maggie'],
            ['username' => 'Homer'],
            ['username' => 'Bart'],
            ['username' => 'Liza'],
        ];

        shuffle($users);

        return $this->render('sidebar/users.html.twig', ['users' => $users]);
    }

    public function listLastGamesAction()
    {
        return $this->render('sidebar/games.html.twig');
    }

    public function timeAction()
    {
        $response = $this->render('sidebar/time.html.twig', [
            'time' => date('H:i:s')
        ])->setSharedMaxAge(60);

        return $response;
    }
}
