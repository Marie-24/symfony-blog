<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
     * @Route("/category")
     */
class CategoryController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();
        return $this->render('admin/category/index.html.twig', 
                [
           'categories'=>$categories
        ]);
    }

/**
 * @route("/edit/{id}", defaults={"id":null})
 */
public function edit(Request $request, $id)
        {
    $em = $this->getDoctrine()->getManager();
    if(is_null($id)){
    $category = new Category();
    }else{
        $category = $em->getRepository(Category::class)->find($id);
    }
    
    
    //création d'un formulaire
    $form = $this->createForm(CategoryType::class, $category);
    $form->handleRequest($request);
    if ($form->isSubmitted()){
        if($form->isValid()){
            $em->persist($category);
            $em->flush();
            //ajout du message flash
            $this->addFlash('success', 'La catégorie a bien été enregistrée');
            //redirection vers la liste
            return $this->redirectToRoute('app_admin_category_index');
        }
    }
    return $this->render(
            'admin/category/edit.html.twig',
            [
              'form'=>$form->createView()  
            ]);
        }
    /**
     * @Route(":delete/{id}")
     * @param int $id
     */  
    public function delete($id){
        $em = $this->getDoctrine()->getManager();
        //raccourci pour $em->getRepository(...)
        $category = $em->find(Category::class, $id);
        
        $em->remove($category);
        $em->flush();
        
        $this->addFlash('success', 'La catégorie est supprimée');
        //redirection vers la liste
        return $this->redirectToRoute('app_admin_category_index');
    }
}
