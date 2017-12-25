<?php

namespace MasterPoBundle\Controller;

use MasterPoBundle\Entity\Category;
use MasterPoBundle\Entity\Product;
use MasterPoBundle\Entity\ProductPhotoGalleries;
use MasterPoBundle\Entity\SubCategory;
use MasterPoBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('MasterPoBundle:Category')->findAll();
        $vipProducts = $em->getRepository('MasterPoBundle:Product')->getVipProducts();
        //** TODO get top and vip product  */

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $vipProducts,
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        return $this->render(':site:index.html.twig', [
            'categories' => $categories,
            'pagination' => $pagination,
        ]);
    }

    /**
     * @param string $categorySlug
     * @return Response
     */
    public function showCategoryAction(string $categorySlug): Response
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('MasterPoBundle:Category')->findOneBy(['slug' => $categorySlug]);

        if (! $category instanceof Category) {
           return $this->render(':error:error404.html.twig');
        }

        $subCategories = $em->getRepository('MasterPoBundle:SubCategory')->findBy(['category' => $category]);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $router = $this->get('router');
        $breadcrumbs->addItem('Главная', $router->generate('site_index'));
        $breadcrumbs->addItem($category->getName());

        return $this->render(':site:show.html.twig', [
            'subCategories' => $subCategories,
            'category' => $category
        ]);
    }

    /**
     * @param string $categoryName
     * @param string $subCategoryName
     * @return Response
     */
    public function productDetailAction(string $categoryName, string $subCategoryName): Response
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('MasterPoBundle:Category')->findOneBy(['slug' => $categoryName]);
        $subCategory = $em->getRepository('MasterPoBundle:SubCategory')->findOneBy(['slug' => $subCategoryName]);

        if (! $category instanceof Category || ! $subCategory instanceof SubCategory) {
            return $this->render(':error:error404.html.twig');
        }

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $router = $this->get('router');
        $breadcrumbs->addItem('Главная', $router->generate('site_index'));
        $breadcrumbs->addItem($category->getName(),
            $router->generate('category_show', ['categorySlug' => $category->getSlug()]));
        $breadcrumbs->addItem($subCategory->getName());


        return $this->render(':site:product-detail.html.twig', [
            'subCategory' => $subCategory,
        ]);
    }


    public function postNewExchangeAction(Request $request)
    {
        $profile = $this->getDoctrine()
            ->getRepository('MasterPoBundle:Profile')
            ->findOneBy(['user' => $this->getUser()])
        ;

        $product = new Product();
        $product->setProfile($profile);

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //                TODO добавить поля профиля

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            foreach($form->get('productPhoto')->getData() as $file) {
//                TODO Уменьшать размер фото
                $productPhotoGallery = new ProductPhotoGalleries();
                $photo = $this->get('app.img_uploader')->upload($file, '/product/');
                $productPhotoGallery->setName($photo);
                $productPhotoGallery->setProduct($product);

                $em->persist($productPhotoGallery);
                $em->flush();
            }

            return $this->redirectToRoute('site_index');
        }

        return $this->render(':site:post-new-exchange.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newPostAction(Request $request): Response
    {


        $em = $this->getDoctrine()->getManager();
        $post = new BlogPost();
        $tags = $em->getRepository('MasterPoBundle:BlogTag')->findAll();
        $form = $this->createForm(BlogPostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setUser($this->getUser());
            $tags = $request->request->get('tags');
            if(is_array($tags)) {
                foreach ($tags as $tag) {
                    $findTag = $em->getRepository('MasterPoBundle:BlogTag')->find($tag);
                    $post->addTag($findTag);
                    $findTag->addPost($post);
                }
            }

            $photo = $this->get('app.img_uploader')->upload($post->getPhoto(), '../images/blog-galleries/');
            $post->setPhoto($photo);

            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('blog_index');
        }

        return $this->render(':blog:new-post.html.twig', [
            'form' => $form->createView(),
            'tags' => $tags
        ]);
    }

}
