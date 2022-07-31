<?php

namespace App\Controller;

use App\Entity\FluxSortant;
use App\Form\FluxSortantType;
use App\Repository\FluxSortantRepository;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
/**
 * @Route("/flux/sortant")
 */
class FluxSortantController extends AbstractController
{
    /**
     * @Route("/f", name="flux_sortant_index", methods={"GET"})
     */
    public function index(FluxSortantRepository $fluxSortantRepository): Response
    {
        return $this->render('flux_sortant/index.html.twig', [
            'fluxSortants' => $fluxSortantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="flux_sortant_new", methods={"GET","POST"})
     */
    public function new(FluxSortantRepository $fluxSortantRepository , Request $request): Response
    {
        $fluxSortant = new FluxSortant();
        $fluxSortant -> setUser($this->getUser());
        $form = $this->createForm(FluxSortantType::class, $fluxSortant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fluxSortant);
            $entityManager->flush();

            return $this->redirectToRoute('flux_sortant_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('flux_sortant/new.html.twig', [
            'flux_sortant' => $fluxSortant,
            'form' => $form,
            'fluxSortants' => $fluxSortantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="flux_sortant_show", methods={"GET"})
     */
    public function show(FluxSortant $fluxSortant): Response
    {
        return $this->render('flux_sortant/show.html.twig', [
            'flux_sortant' => $fluxSortant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="flux_sortant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FluxSortant $fluxSortant): Response
    {
        $form = $this->createForm(FluxSortantType::class, $fluxSortant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('flux_sortant_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('flux_sortant/edit.html.twig', [
            'flux_sortant' => $fluxSortant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="flux_sortant_delete", methods={"POST"})
     */
    public function delete(Request $request, FluxSortant $fluxSortant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fluxSortant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fluxSortant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('flux_sortant_new', [], Response::HTTP_SEE_OTHER);
    }
}
