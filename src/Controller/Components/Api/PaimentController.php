<?php

namespace App\Controller\Components\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class PaimentController extends AbstractController
{

    public function __invoke($data)
    {
        $data->setStatus('attente');
        return $data;
    }
}