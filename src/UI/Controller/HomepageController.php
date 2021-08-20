<?php

namespace EOffice\UI\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends AbstractController
{
    public function __invoke()
    {
        return new Response($this->renderView('@ui/homepage.html.twig'));
    }
}
