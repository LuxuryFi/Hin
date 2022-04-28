<?php
namespace App\Controller;

use App\Entity\Teacher;
use App\Form\TeacherType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use function PHPUnit\Framework\throwException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
// ...

/**
 *  @IsGranted("ROLE_ADMIN")
 */
class TeacherController extends AbstractController
{
    #[Route('/teacher/create', name: 'teacher_create')]
    public function create(Request $request) {
        $teacher = new Teacher();
        $form = $this->createForm(TeacherType::class,$teacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($teacher);
            $manager->flush();

            $this->addFlash("Success","Create teacher succeed !");
            return $this->redirectToRoute("teacher_index");
        }

        return $this->render(
            'teacher/create.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    #[Route('/teacher/index', name: 'teacher_index',  methods: ['GET', 'HEAD'])]
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $teachers = $entityManager->getRepository(Teacher::class)->findAll();
        return $this->render('Teacher/index.html.twig', [
            'teachers' => $teachers,
        ]);
    }

    #[Route('/teacher/detail/{id}', name: 'teacher_detail',  methods: ['GET', 'HEAD'])]
    public function detail(string $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $teacher = $entityManager->getRepository(Teacher::class)->find($id);
        return $this->render('Teacher/detail.html.twig', [
            'teacher' => $teacher,
        ]);
    }

    #[Route('/teacher/update/{id}', name: 'teacher_updateOne')]
    public function updateOne(Request $request, string $id): Response
    {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
        $form = $this->createForm(TeacherType::class,$teacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($teacher);
            $manager->flush();

            $this->addFlash("Success","Create teacher succeed !");
            return $this->redirectToRoute("teacher_index");
        }

        return $this->render(
            'teacher/update.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    #[Route('/teacher/delete/{id}', name: 'teacher_delete', methods: ['GET'])]
    public function deleteOne(int $id) : Response {
        $entityManager = $this->getDoctrine()->getManager();
        $teacher = $entityManager->getRepository(Teacher::class)->find($id);
        $entityManager->remove($teacher);
        $entityManager->flush();
        return $this->redirect('/teacher/index', 301);
    }
}
?>
