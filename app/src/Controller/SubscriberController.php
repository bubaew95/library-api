<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\SubscriberRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SubscriberController extends AbstractController
{
    #[Route('/api/v1/subscribe', methods: ['POST'])]
    public function add(#[RequestBody] SubscriberRequest $request) : JsonResponse
    {
        print_r($request);die;
        return $this->json();
    }
}
