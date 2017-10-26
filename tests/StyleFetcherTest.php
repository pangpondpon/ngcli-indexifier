<?php


namespace Indexifier\Tests;


use Indexifier\Classes\StyleFetcher;
use PHPUnit\Framework\TestCase;

class StyleFetcherTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_be_able_to_fetch_dev_style()
    {
        $fetcher = new StyleFetcher;
        $fetcher->setPath(__DIR__ . "/stubs/index-dev.html");
        $expected = '';

        $includes = $fetcher->fetch();

        $this->assertEquals($expected, $includes);
    }

    /**
     * @test
     */
    public function it_should_be_able_to_fetch_production_style()
    {
        $fetcher = new StyleFetcher;
        $fetcher->setPath(__DIR__ . "/stubs/index-prod.html");
        $expected = '<link href="styles.59e7f9c5ca653921ed0c.bundle.css" rel="stylesheet">';

        $includes = $fetcher->fetch();

        $this->assertEquals($expected, $includes);
    }
}