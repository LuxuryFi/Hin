<?php
namespace App\Controller;

use App\Entity\Enrollment;
use App\Form\EnrollmentType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

// ...
$request = Request::createFromGlobals();

/**
 *  @IsGranted("ROLE_USER")
 */
class EnrollmentController extends AbstractController
{
    #[Route('/enrollment/create', name: 'enrollment_create')]
    public function createOne(Request $request): Response
    {
        $enrollment = new Enrollment();
        $form = $this->createForm(EnrollmentType::class,$enrollment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($enrollment);
            $manager->flush();

            $this->addFlash("Success","Create enrollment succeed !");
            return $this->redirectToRoute("enrollment_index");
        }
        return $this->render(
            'enrollment/create.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }


    #[Route('/enrollment/index', name: 'enrollment_index',  methods: ['GET', 'HEAD'])]
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $enrollments = $entityManager->getRepository(Enrollment::class)->findAll();
        return $this->render('enrollment/index.html.twig', [
            'enrollments' => $enrollments,
        ]);
    }

    #[Route('/enrollment/detail/{id}', name: 'enrollment_detail',  methods: ['GET', 'HEAD'])]
    public function detail(string $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $enrollment = $entityManager->getRepository(Enrollment::class)->find($id);
        return $this->render('enrollment/detail.html.twig', [
            'enrollment' => $enrollment,
        ]);
    }

    #[Route('/enrollment/update/{id}', name: 'enrollment_update')]
    public function update(Request $request, string $id): Response
    {
        $enrollment = $this->getDoctrine()->getRepository(Enrollment::class)->find($id);
        $form = $this->createForm(EnrollmentType::class,$enrollment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($enrollment);
            $manager->flush();

            $this->addFlash("Success","Create enrollment succeed !");
            return $this->redirectToRoute("enrollment_index");
        }

        return $this->render(
            'enrollment/update.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    #[Route('/enrollment/delete/{id}', name: 'enrollment_delete', methods: ['GET'])]
    public function deleteOne(int $id) : Response {
        $entityManager = $this->getDoctrine()->getManager();
        $enrollment = $entityManager->getRepository(enrollment::class)->find($id);
        $entityManager->remove($enrollment);
        $entityManager->flush();
        return $this->redirect('/enrollment/index', 301);
    }
}
?>
