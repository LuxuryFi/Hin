<?php
namespace App\Controller;

use App\Entity\Major;
use App\Form\MajorType;
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
class MajorController extends AbstractController
{
    #[Route('/major/create', name: 'major_create')]
    public function createOne(Request $request): Response
    {
        $major = new Major();
        $form = $this->createForm(MajorType::class,$major);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($major);
            $manager->flush();

            $this->addFlash("Success","Create major succeed !");
            return $this->redirectToRoute("major_index");
        }
        return $this->render(
            'major/create.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }


    #[Route('/major/index', name: 'major_index',  methods: ['GET', 'HEAD'])]
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categories = $entityManager->getRepository(major::class)->findAll();
        return $this->render('major/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/major/detail/{id}', name: 'major_detail',  methods: ['GET', 'HEAD'])]
    public function detail(string $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $major = $entityManager->getRepository(major::class)->find($id);
        return $this->render('major/detail.html.twig', [
            'major' => $major,
        ]);
    }

    #[Route('/major/update/{id}', name: 'major_update')]
    public function update(Request $request, string $id): Response
    {
        $major = $this->getDoctrine()->getRepository(Major::class)->find($id);
        $form = $this->createForm(MajorType::class,$major);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($major);
            $manager->flush();

            $this->addFlash("Success","Create major succeed !");
            return $this->redirectToRoute("major_index");
        }

        return $this->render(
            'major/update.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    #[Route('/major/delete/{id}', name: 'major_delete', methods: ['GET'])]
    public function deleteOne(int $id) : Response {
        $entityManager = $this->getDoctrine()->getManager();
        $major = $entityManager->getRepository(major::class)->find($id);
        $entityManager->remove($major);
        $entityManager->flush();
        return $this->redirect('/major/index', 301);
    }
}
?>
