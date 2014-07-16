<?php

namespace Loranger\Doki\Models;

use \ParsedownExtra;


class WikipageRepository
{
    protected $datapath;

    public function __construct()
    {
        $this->datapath = base_path() . '/wiki';
    }

    public function setDatapath($newpath)
    {
        $this->datapath = $newpath;
    }

    public function getDatapath()
    {
        return $this->datapath;
    }

    private function buildRecursiveList($array, $base = '')
    {
        $output = "<ul>";
        foreach ($array as $name => $value) {
            if (is_array($value)) {
                $output .= sprintf("<li><a href=\"%s/%s\">%s</a></li>\n%s", $base, $name, ucfirst($name), $this->buildRecursiveList($value, $base . '/' . $name));
            } else {
                $output .= sprintf("<li><a href=\"%s/%s\">%s</a></li>\n", $base, $name, ucfirst($name));
            }
        }

        return sprintf("%s</ul>\n", $output);
    }

    public function getPage($page)
    {
        $files = glob($this->datapath . '/{' . $page . ','.$page.'/readme}.{markdown,mdown,mkdn,md,mkd,mdwn,mdtxt,mdtext,text}', GLOB_BRACE);

        if (count($files)) {
            $content = file_get_contents($files[0]);
            $content = (new \ParsedownExtra())->text($content);
        } else {
            $content = sprintf('<h2>%s is readme-less</h2>', ucfirst($page));
            $content .= sprintf('<h4>Maybe you should take a look at</h4>', ucfirst($page));
            $list = \App::make('Loranger\Doki\Controllers\WikiController')->getNavBar($this->datapath . '/' . $page);
            $content .= $this->buildRecursiveList($list, '/' . $page);
            $content = sprintf('<div class="well">%s</div>', $content);
        }

        $page = new Wikipage($page, $content);

        return $page;
    }
}
