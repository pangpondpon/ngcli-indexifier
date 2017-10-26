<?php


namespace Indexifier\Classes;


class StyleFetcher extends Fetcher
{
    public function fetch(): string
    {
        $nodes = $this->dom->getElementsByTagName("link");
        $ignoreTypes = [ "image/x-icon" ];

        return trim($this->getHtmlTextFromDomList($nodes, $ignoreTypes));
    }
}