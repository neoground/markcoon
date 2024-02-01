<?php
/**
 * This file contains the BlogController class
 */

namespace App\Controllers;

use Charm\Vivid\C;
use Charm\Vivid\Controller;
use Charm\Vivid\Kernel\Output\File;
use Charm\Vivid\Kernel\Output\Redirect;
use Charm\Vivid\Kernel\Output\View;
use Charm\Vivid\Router\Attributes\Route;
use Neoground\Charm\Blog\Models\BlogPost;

/**
 * Class BlogController
 *
 * Handling the blog area
 *
 * @package App\Controllers
 */
class BlogController extends Controller
{
    #[Route("GET", "/blog", "blog.index", "autolang")]
    public function getIndex(): View
    {
        return C::Blog()->getFilteredPostList('index', '');
    }

    #[Route("GET", "/blog/category/{name}", "blog.category", "autolang")]
    public function getCategory($name): View
    {
        return C::Blog()->getFilteredPostList('category', $name);
    }

    #[Route("GET", "/blog/tag/{name}", "blog.tag", "autolang")]
    public function getTag($name): View
    {
        return C::Blog()->getFilteredPostList('tag', $name);
    }

    #[Route("GET", "/blog/feed/{lang}", "blog.rss")]
    public function getRssFeed($lang)
    {
        $xml_path = C::Blog()->getRssFeedPath($lang);
        if ($xml_path) {
            return File::make('feed.xml')
                ->withFile($xml_path)
                ->withContentType('text/xml')
                ->inline();
        }

        return View::makeError('InvalidFeed', 400);
    }

    #[Route("GET", "/blog/{name}", "blog.post", "autolang")]
    public function getPost($name): View
    {
        $arr = C::Blog()->getPost($name);

        if (!$arr) {
            return View::makeError('Post Not Found', 404);
        }

        return View::make('blog.post')->with([
            'title' => $arr['post']['title'] . ' | Blog',
            'active' => 'blog',
            'description' => $arr['post']['excerpt'],
            ...$arr,
        ]);
    }

    #[Route("POST", "/blog/comments/add", "blog.add_comment")]
    public function addComment()
    {
        $bp = new BlogPost();
        $post_slug = C::Request()->get('post');
        $dest = C::Router()->getUrl('blog.post', $post_slug) . '#comments';

        if ($bp->addComment()) {
            return Redirect::to($dest)->withMessage('comment_success');
        }

        return Redirect::to($dest)->withMessage('comment_error');
    }

    #[Route("GET", "/blog/mgmt/moderate/comment", "blog.moderate_comment", "autolang")]
    public function moderateComment(): View
    {
        $bp = new BlogPost();
        if ($bp->moderateComment()) {
            return View::make('blog.moderate_success')->with([
                // Wanted action: approve, remove, removeblock
                'action' => C::Request()->get('action'),
                // Post slug
                'slug' => C::Request()->get('slug'),
                // Post URL
                'post_url' => C::Router()->getUrl('blog.post', C::Request()->get('slug')) . '#comments',
            ]);
        }

        return View::makeError('InvalidDataProvided', 400);
    }

}