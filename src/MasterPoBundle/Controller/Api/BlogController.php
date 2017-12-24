<?php

namespace MasterPoBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use MasterPoBundle\Entity\BlogPost;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class BlogController extends FOSRestController
{
    /**
     * This is the documentation description of your method, it will appear
     * on a specific pane. It will read all the text until the first
     * annotation.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Return all posts")
     * @param Request $request
     * @return Response
     */
    public function getPostsAction(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('MasterPoBundle:BlogPost')->getPosts();
        $popularPosts = $em->getRepository('MasterPoBundle:BlogPost')->getPopularPosts();
        $lastFivePosts = $em->getRepository('MasterPoBundle:BlogPost')->getLastFivePosts();
        $tagsPopularity = $em->getRepository('MasterPoBundle:BlogTag')->getTagPopularity();

        $pagination = $this->get('knp_paginator')->paginate(
            $posts->getQuery(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            $request->query->getInt('limit', 10)/*limit per page*/
        );

        $data = [
            'pagination' => $pagination,
            'popularPosts' => $popularPosts,
            'lastFivePosts' => $lastFivePosts,
            'tagsPopularity' => $tagsPopularity
        ];

        $view = $this->view($data);

        return $this->handleView($view);
    }


    /**
     * This is the documentation description of your method, it will appear
     * on a specific pane. It will read all the text until the first
     * annotation.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Return Article by id" )
     * @param int $id
     * @return Response
     */
    public function getArticleByIdAction(int $id): Response
    {

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('MasterPoBundle:BlogPost')->find($id);

        if ($article instanceof BlogPost) {
            $view = $this->view($article, 200);

            return $this->handleView($view);
        }

        throw new HttpException(404, "articles with this '$id' do not exist ");
    }


    /**
     *  @ApiDoc(
     *  resource=true,
     *  description="Remove article by id")
     *
     * @param BlogPost $blogPost
     */
    public function deleteArticleAction(BlogPost $blogPost)
    {

        $em = $this->getDoctrine()->getManager();

        if ($blogPost instanceof BlogPost) {
            $title = $blogPost->getTitle();
            $em->remove($blogPost);
            $em->flush();

            throw new HttpException(200, "remove $title");
        }

        throw new HttpException(404, "there is nothing to delete");
    }

}
