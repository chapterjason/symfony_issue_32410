<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\ItemType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormErrorIterator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{

    /**
     * @Route(path="/prepare", name="app_prepare")
     */
    public function prepare(): Response
    {
        $category1 = new Category();
        $category2 = new Category();
        $category3 = new Category();

        $manager = $this->getDoctrine()->getManager();

        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);

        $manager->flush();

        return $this->json('ok');
    }

    /**
     * @Route(path="/test", name="app_test")
     */
    public function test(): Response
    {

        $form = $this->createForm(ItemType::class);

        $form->submit([
            'itemCategories' => [
                1 => [
                    'position' => 0,
                    'category' => 1
                ],
                2 => [
                    'position' => 1,
                    'category' => 2
                ],
                3 => [
                    'position' => 4,
                    'category' => 3
                ]
            ]
        ]);

        // Root errors only
        dump("root error");
        $errors = $form->getErrors(false, false);
        foreach ($errors as $error) {
            dump($error);
        }

        dump("property error");
        # Property errors for itemCategories
        $propertyErrors = $form->get('itemCategories')->getErrors();
        foreach ($propertyErrors as $error) {
            dump($error);
        }

        // Dump view
        $view = $form->createView();
        dump($view);

        return $this->json('ok');
    }

}
