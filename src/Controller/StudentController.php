<?php
namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
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
class StudentController extends AbstractController
{
    #[Route('/student/create', name: 'student_create')]
    public function create(Request $request) {
        $student = new Student();
        $form = $this->createForm(StudentType::class,$student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($student);
            $manager->flush();

            $this->addFlash("Success","Create student succeed !");
            return $this->redirectToRoute("student_index");
        }

        return $this->render(
            'student/create.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    #[Route('/student/index', name: 'student_index',  methods: ['GET', 'HEAD'])]
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $students = $entityManager->getRepository(Student::class)->findAll();
        return $this->render('Student/index.html.twig', [
            'students' => $students,
        ]);
    }

    #[Route('/student/detail/{id}', name: 'student_detail',  methods: ['GET', 'HEAD'])]
    public function detail(string $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $student = $entityManager->getRepository(Student::class)->find($id);
        return $this->render('Student/detail.html.twig', [
            'student' => $student,
        ]);
    }

    #[Route('/student/update/{id}', name: 'student_updateOne')]
    public function updateOne(Request $request, string $id): Response
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        $form = $this->createForm(StudentType::class,$student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($student);
            $manager->flush();

            $this->addFlash("Success","Create student succeed !");
            return $this->redirectToRoute("student_index");
        }

        return $this->render(
            'student/update.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    #[Route('/student/delete/{id}', name: 'student_delete', methods: ['GET'])]
    public function deleteOne(int $id) : Response {
        $entityManager = $this->getDoctrine()->getManager();
        $student = $entityManager->getRepository(Student::class)->find($id);
        $entityManager->remove($student);
        $entityManager->flush();
        return $this->redirect('/student/index', 301);
    }
}
?>
