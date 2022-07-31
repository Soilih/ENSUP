<?php

namespace App\Controller;

use App\Entity\Flux;
use App\Entity\User;
use App\Form\FluxType;
use App\Repository\FluxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
/**
 * @Route("/flux")
 */
class FluxController extends AbstractController
{
    /**
     * @Route("/", name="flux_index", methods={"GET"})
     * 
     */
    public function index(FluxRepository $fluxRepository): Response
    {
        return $this->render('flux/index.html.twig', [
            'fluxes' => $fluxRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="flux_new", methods={"GET","POST"})
     */
    public function new(FluxRepository $fluxRepository , Request $request): Response
    {
        $flux = new Flux();
        $flux->setUser($this->getUser());
        $form = $this->createForm(FluxType::class, $flux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($flux);
            $entityManager->flush();

            return $this->redirectToRoute('flux_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('flux/new.html.twig', [
            'flux' => $flux,
            'form' => $form,
            'fluxes' => $fluxRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="flux_show", methods={"GET"})
     */
    public function show(Flux $flux): Response
    {
        return $this->render('flux/show.html.twig', [
            'flux' => $flux,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="flux_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Flux $flux): Response
    {
        $form = $this->createForm(FluxType::class, $flux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('flux_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('flux/edit.html.twig', [
            'flux' => $flux,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="flux_delete", methods={"POST"})
     */
    public function delete(Request $request, Flux $flux): Response
    {
        if ($this->isCsrfTokenValid('delete'.$flux->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($flux);
            $entityManager->flush();
        }

        return $this->redirectToRoute('flux_new', [], Response::HTTP_SEE_OTHER);
    }
}
