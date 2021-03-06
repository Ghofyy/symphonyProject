<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ObjectManager;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo): Response
    {    
        
        //$repo = $this->getDoctrine()->getRepository(Ad::class);
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads 
        ]);
    }
        /**
         * permet de creer une annonce 
         * 
         * @Route("/ads/new", name="ads_create")
         * @return Response
         * 
         */

        public function create(Request $request) {
            $ad = new Ad();
            $form = $this->createForm(AdType::class, $ad); 

            $form->handleRequest($request);
           // dump($ad);
          if ($form->isSubmitted() && $form->isValid()){
              $manager = $this->getDoctrine()->getManager();

              $manager->persist($ad);
              $manager->flush();
          }

            return $this->render('ad/new.html.twig',[
                'form'=> $form->createView()
            ]);

        }
    /**
     * Permet d'afficher une seule annonce 
     *
     * @Route("/ads/{slug}", name="ads_show")
     * 
     * @return Response
     */
    public function show(Ad $ad){
        //je recupere l'annonce qui corespond au slug!
       // $ad =$repo->findBySlug($slug);

        return $this->render('ad/show.html.twig',[
            'ad' => $ad
        ]);
    }
    
}
