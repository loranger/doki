<?php

namespace Loranger\Doki\Controllers;

use Illuminate\Routing\Controller;
use Loranger\Doki\Models\WikiPageRepository;

class WikiController extends Controller
{
    public function __construct(WikiPageRepository $pages)
    {
        $this->pages = $pages;

        $files = \File::directories( $this->pages );
    }

    public function getNavBar($path)
    {
        $nav = [];
        $iter = new \DirectoryIterator($path);
        foreach ($iter as $fileInfo) {

            if ( !$fileInfo->isDot() && !preg_match('/^(readme|\.)/i', $fileInfo->getFilename()) ) {
                if ($fileInfo->isDir()) {
                    $nav[$fileInfo->getFilename()] = $this->getNavBar($path . DIRECTORY_SEPARATOR . $fileInfo->getFilename());
                } else {
                    $infos = pathinfo($fileInfo->getFilename());
                    $nav[$infos['filename']] = $infos['basename'];
                }
            }
        }

        return $nav;
    }

    public function getBreadcrumbs($path)
    {
        $parts = array_filter(explode('/', $path));

        $breadcrumbs = array('Home' => \URL::to(''));
        foreach ($parts as $key => $name) {
            $breadcrumbs[ucfirst($name)] = implode('/', array_slice($parts, 0, $key + 1));
        }

        return $breadcrumbs;
    }

    public function showPage($path = 'readme')
    {
        $page = $this->pages->getPage($path);

        return \View::make('doki::wiki', [
            'page' => $page,
            'breadcrumbs' => $this->getBreadcrumbs($path),
            'items' => $this->getNavBar($this->pages->getDatapath()),
            'root' => ''
        ]);
    }
}
