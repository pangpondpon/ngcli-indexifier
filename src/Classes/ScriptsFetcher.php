<?php


namespace Indexifier\Classes;

class ScriptsFetcher extends Fetcher
{
    public function fetch(): string
    {
        $nodes = $this->dom->getElementsByTagName("script");

        return trim($this->getHtmlTextFromDomList($nodes));
    }
}