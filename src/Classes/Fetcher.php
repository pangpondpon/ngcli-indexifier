<?php


namespace Indexifier\Classes;


use DOMDocument;

abstract class Fetcher
{
    protected $path;

    protected $content;

    /** @var DOMDocument */
    protected $dom;

    public function __construct()
    {
        if (function_exists('config')) {
            $this->path = base_path(config('indexifier.ng_index_location'));
            $this->buildContentAndDomFromPath();
        }
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path)
    {
        $this->path = $path;

        $this->buildContentAndDomFromPath();
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    private function buildContentFromPath()
    {
        $this->content = file_get_contents($this->path);
    }

    private function buildDom()
    {
        $this->dom = new DOMDocument;

        // DOMDocument throw an error if it load app-root
        // https://stackoverflow.com/questions/6090667/php-domdocument-errors-warnings-on-html5-tags
        libxml_use_internal_errors(true);
        $this->dom->loadHTML($this->content);
        libxml_clear_errors();
    }

    public function getDom(): DOMDocument
    {
        return $this->dom;
    }

    public function setDom(DOMDocument $dom)
    {
        $this->dom = $dom;
    }

    private function buildContentAndDomFromPath()
    {
        $this->buildContentFromPath();
        $this->buildDom();
    }

    protected function getHtmlTextFromDomList($nodes, $ignoreTypes = [])
    {
        $html = "";

        /** @var \DOMElement $node */
        foreach ($nodes as $node) {
            if(in_array($node->getAttribute('type'), $ignoreTypes)) continue;

            $html .= $this->domElementToHtml($node);
        }

        return $html;
    }

    protected function domElementToHtml(\DOMElement $node)
    {
        $doc = new DOMDocument();

        $cloned = $node->cloneNode(TRUE);
        $doc->appendChild($doc->importNode($cloned,TRUE));

        return $doc->saveHTML();
    }
}