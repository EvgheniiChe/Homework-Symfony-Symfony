<?php

namespace App\Controller;

use App\Entity\Job;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JobController extends Controller
{
    /**
     * @Route("/", name="jobs")
     * @Method("GET")
     * @return Response
     */
    public function listAction()
    {
        $jobs = $this->getDoctrine()->getRepository(Job::class)->findAll();

        return $this->render('job/index.html.twig', [
            'jobs' => $jobs,
        ]);
    }
}
