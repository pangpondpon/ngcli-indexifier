<?php


namespace Indexifier\Classes;


class Indexifier
{
    public function fetchStyle()
    {
        return (new StyleFetcher)->fetch();
    }

    public function fetchScripts()
    {
        return (new ScriptsFetcher)->fetch();
    }
}