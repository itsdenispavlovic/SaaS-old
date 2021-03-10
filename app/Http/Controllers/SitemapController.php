<?php

namespace App\Http\Controllers;

use App\Models\Node;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    /**
     * @return Application|ResponseFactory|Response
     */
    public function googleSitemap()
    {
        $sitemap = Sitemap::create(config('app.url'));
        $nodes = Node::where('is_sitemap', true)->get();
        foreach($nodes as $node)
        {
            $sitemap->add(Url::create($node->slug));
        }

        $generatedSitemap = $sitemap->render();


        return response($generatedSitemap)
            ->withHeaders([
                'Content-Type' => 'text/xml'
            ]);
    }
}
