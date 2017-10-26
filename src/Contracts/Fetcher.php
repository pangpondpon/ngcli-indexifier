<?php


namespace Indexifier\Contracts;


interface Fetcher
{
    public function fetch(): string;
}