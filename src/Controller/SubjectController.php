<?php
namespace App\Controller;

use App\Entity\Subject;
use App\Form\SubjectType;
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
class SubjectController extends AbstractController
{
    #[Route('/subject/create', name: 'subject_create')]
    public function createOne(Request $request): Response
    {
        $subject = new Subject();
        $form = $this->createForm(SubjectType::class,$subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($subject);
            $manager->flush();

            $this->addFlash("Success","Create subject succeed !");
            return $this->redirectToRoute("subject_index");
        }
        return $this->render(
            'subject/create.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }


    #[Route('/subject/index', name: 'subject_index',  methods: ['GET', 'HEAD'])]
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categories = $entityManager->getRepository(subject::class)->findAll();
        return $this->render('subject/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/subject/detail/{id}', name: 'subject_detail',  methods: ['GET', 'HEAD'])]
    public function detail(string $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $subject = $entityManager->getRepository(subject::class)->find($id);
        return $this->render('subject/detail.html.twig', [
            'subject' => $subject,
        ]);
    }

    #[Route('/subject/update/{id}', name: 'subject_update')]
    public function update(Request $request, string $id): Response
    {
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);
        $form = $this->createForm(SubjectType::class,$subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($subject);
            $manager->flush();

            $this->addFlash("Success","Create subject succeed !");
            return $this->redirectToRoute("subject_index");
        }

        return $this->render(
            'subject/update.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    #[Route('/subject/delete/{id}', name: 'subject_delete', methods: ['GET'])]
    public function deleteOne(int $id) : Response {
        $entityManager = $this->getDoctrine()->getManager();
        $subject = $entityManager->getRepository(subject::class)->find($id);
        $entityManager->remove($subject);
        $entityManager->flush();
        return $this->redirect('/subject/index', 301);
    }
}
?>
