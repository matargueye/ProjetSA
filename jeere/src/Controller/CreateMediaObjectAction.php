<?php
// api/src/Controller/CreateMediaObjectAction.php

namespace App\Controller;

use App\Entity\MediaObject;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MediaObjectRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateMediaObjectAction
{
     /**
     * @Route("/new/object", name="object", methods={"POST"})
     */
    public function __invoke(Request $request, EntityManagerInterface $manager,MediaObjectRepository $MediaObjectRepository)
    
    {

        $values = json_decode($request->getContent());

        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $mediaObject = new MediaObject();
        $mediaObject->file = $uploadedFile;
        $manager->persist(   $mediaObject);
        $manager->flush();
        $data = [
            'status' => 201,
            'message' => 'image enregistré'];

            return new JsonResponse($data, 201);
            

        
    }
}