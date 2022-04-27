<?php
namespace App\Controller;

use App\Entity\Course;
use App\Form\CourseType;
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
class CourseController extends AbstractController
{
    #[Route('/course/create', name: 'course_create')]
    public function createOne(Request $request): Response
    {
        $course = new Course();
        $form = $this->createForm(CourseType::class,$course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($course);
            $manager->flush();

            $this->addFlash("Success","Create course succeed !");
            return $this->redirectToRoute("course_index");
        }
        return $this->render(
            'course/create.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }


    #[Route('/course/index', name: 'course_index',  methods: ['GET', 'HEAD'])]
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categories = $entityManager->getRepository(course::class)->findAll();
        return $this->render('course/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/course/detail/{id}', name: 'course_detail',  methods: ['GET', 'HEAD'])]
    public function detail(string $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $course = $entityManager->getRepository(course::class)->find($id);
        return $this->render('course/detail.html.twig', [
            'course' => $course,
        ]);
    }

    #[Route('/course/update/{id}', name: 'course_update')]
    public function update(Request $request, string $id): Response
    {
        $course = $this->getDoctrine()->getRepository(Course::class)->find($id);
        $form = $this->createForm(CourseType::class,$course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($course);
            $manager->flush();

            $this->addFlash("Success","Create course succeed !");
            return $this->redirectToRoute("course_index");
        }

        return $this->render(
            'course/update.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    #[Route('/course/delete/{id}', name: 'course_delete', methods: ['GET'])]
    public function deleteOne(int $id) : Response {
        $entityManager = $this->getDoctrine()->getManager();
        $course = $entityManager->getRepository(course::class)->find($id);
        $entityManager->remove($course);
        $entityManager->flush();
        return $this->redirect('/course/index', 301);
    }
}
?>
