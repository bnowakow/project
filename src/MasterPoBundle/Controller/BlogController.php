<?php

namespace MasterPoBundle\Controller;

use MasterPoBundle\Entity\BlogCategory;
use MasterPoBundle\Entity\BlogComment;
use MasterPoBundle\Entity\UserEmail;
use MasterPoBundle\Form\BlogCategoryType;
use MasterPoBundle\Form\BlogCommentType;
use MasterPoBundle\Form\UserEmailType;
use Nietonfir\Google\ReCaptchaBundle\Controller\ReCaptchaValidationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MasterPoBundle\Entity\BlogPost;
use MasterPoBundle\Entity\BlogTag;
use MasterPoBundle\Form\BlogPostType;
use MasterPoBundle\Form\BlogTagType;

class BlogController extends Controller implements ReCaptchaValidationInterface
{
    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('MasterPoBundle:BlogPost')->getPosts();
        $popularPosts = $em->getRepository('MasterPoBundle:BlogPost')->getPopularPosts();
        $lastFivePosts = $em->getRepository('MasterPoBundle:BlogPost')->getLastFivePosts();
        $tagsPopularity = $em->getRepository('MasterPoBundle:BlogTag')->getTagPopularity();
        
        $userEmail = new UserEmail();
        $form = $this->createForm(UserEmailType::class, $userEmail);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        return $this->render(':blog:index.html.twig', [
            'pagination' => $pagination,
            'lastFivePosts' => $lastFivePosts,
            'popularPosts' => $popularPosts,
            'tags' => $tagsPopularity,
            'form' => $form->createView(),
        ]);
    }

    public function tableAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('MasterPoBundle:BlogPost')->getLastTenPosts();

        return $this->render(':blog:table.html.twig', [
            'posts' => $posts,
        ]);
    }

    public function saveUserEmailAction(Request $request)
    {
        $userEmail = new UserEmail();
        $form = $this->createForm(UserEmailType::class, $userEmail);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $this->addFlash("success", "Вы подписаны на рассылку");
            $em->persist($userEmail);
            $em->flush();

            return $this->redirect($this->generateUrl('blog_index'));
        }

        $this->addFlash("danger", "Вы уже подписаны");

        return $this->redirect($this->generateUrl('blog_index'));
    }
    
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newPostAction(Request $request): Response
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $router = $this->get('router');
        $breadcrumbs->addItem('Блог', $router->generate('blog_index'));
        $breadcrumbs->addItem('Новая публикация');

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

    /**
     * @param Request $request
     * @param BlogPost $blogPost
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editAction(Request $request, BlogPost $blogPost)
    {
        $this->denyAccessUnlessGranted('edit', $blogPost);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $router = $this->get('router');
        $breadcrumbs->addItem('Блог', $router->generate('blog_index'));
        $breadcrumbs->addItem('Обновить публикацию');

        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('MasterPoBundle:BlogTag')->findAll();

        $form = $this->createForm(BlogPostType::class, $blogPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var  $tags BlogTag[] */
            $tags = $blogPost->getTags();
            foreach ($tags as $tag) {
                $blogPost->removeTag($tag);
                $tag->removePost($blogPost);
            }

            $photo = $this->get('app.img_uploader')->upload($blogPost->getPhoto(), '../images/blog-galleries/');
            $blogPost->setPhoto($photo);

            $em->persist($blogPost);
            $em->flush();

            $tags = $request->request->get('tags');
            foreach ($tags as $tag) {
                $findTag = $em->getRepository('MasterPoBundle:BlogTag')->find($tag);
                $blogPost->addTag($findTag);
                $findTag->addPost($blogPost);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blog_index');
        }

        return $this->render(':blog:edit.html.twig', [
            'form' => $form->createView(),
            'tags' => $tags
        ]);
    }

    /**
     * @param BlogPost $blogPost
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(BlogPost $blogPost): RedirectResponse
    {
        $this->denyAccessUnlessGranted('delete', $blogPost);

        if (!$blogPost) {
            throw $this->createNotFoundException('No post found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($blogPost);
        $em->flush();

        return $this->redirect($this->generateUrl('blog_index'));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function newTagAction(Request $request): Response
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $router = $this->get('router');
        $breadcrumbs->addItem('Блог', $router->generate('blog_index'));
        $breadcrumbs->addItem('Новый тег');

        $em = $this->getDoctrine()->getManager();
        $tag = new BlogTag();
        $form = $this->createForm(BlogTagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($tag);
            $em->flush();
        }

        return $this->render(':blog:new-tag.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function newCategoryAction(Request $request): Response
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $router = $this->get('router');
        $breadcrumbs->addItem('Блог', $router->generate('blog_index'));
        $breadcrumbs->addItem('Новая категория');

        $em = $this->getDoctrine()->getManager();
        $tag = new BlogCategory();
        $form = $this->createForm(BlogCategoryType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($tag);
            $em->flush();
        }

        return $this->render(':blog:new-category.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param string $slug
     * @return Response
     */
    public function articlesAction(Request $request, string $slug): Response
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $router = $this->get('router');
        $breadcrumbs->addItem('Блог', $router->generate('blog_index'));
        $breadcrumbs->addItem($slug);

        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('MasterPoBundle:BlogPost')->findOneBy(['slug' => $slug]);
        /** update CountPageView */
        $post->updateCountPageViews();
        $em->persist($post);
        $em->flush();

        $blogComment = new BlogComment();
        $form = $this->createForm(BlogCommentType::class, $blogComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $post->addComment($blogComment);
            $em->persist($blogComment);
            $em->persist($post);
            $em->flush();

            return $this->render('blog/articles.html.twig', [
                'post' => $post,
                'form' => $form->createView()
            ]);
        }

        return $this->render('blog/articles.html.twig', [
            'post' => $post,
            'form' => $form->createView()
        ]);
    }

    /** 
     * @param string $slug
     * @param Request $request
     * @return Response
     */
    public function tagsAction(string $slug, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('MasterPoBundle:BlogPost')->getTagsByName($slug);
        $tagsPopularity = $em->getRepository('MasterPoBundle:BlogTag')->getTagPopularity();
        $lastFivePosts = $em->getRepository('MasterPoBundle:BlogPost')->getLastFivePosts();
        $popularPosts = $em->getRepository('MasterPoBundle:BlogPost')->getPopularPosts();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        return $this->render(':blog:tags.html.twig', [
            'pagination' => $pagination,
            'lastFivePosts' => $lastFivePosts,
            'popularPosts' => $popularPosts,
            'tags' => $tagsPopularity
        ]);
    }
}
