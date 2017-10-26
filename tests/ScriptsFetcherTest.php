<?php


namespace Indexifier\Tests;


use Indexifier\Classes\ScriptsFetcher;
use PHPUnit\Framework\TestCase;

class ScriptsFetcherTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_be_able_to_fetch_dev_script()
    {
        $fetcher = new ScriptsFetcher;
        $fetcher->setPath(__DIR__ . "/stubs/index-dev.html");
        $expected = '<script type="text/javascript" src="inline.bundle.js"></script>
<script type="text/javascript" src="polyfills.bundle.js"></script>
<script type="text/javascript" src="scripts.bundle.js"></script>
<script type="text/javascript" src="styles.bundle.js"></script>
<script type="text/javascript" src="vendor.bundle.js"></script>
<script type="text/javascript" src="main.bundle.js"></script>';

        $includes = $fetcher->fetch();

        $this->assertEquals($expected, $includes);
    }

    /**
     * @test
     */
    public function it_should_be_able_to_fetch_production_script()
    {
        $fetcher = new ScriptsFetcher;
        $fetcher->setPath(__DIR__ . "/stubs/index-prod.html");
        $expected = '<script type="text/javascript" src="inline.246c8408226e160c51df.bundle.js"></script>
<script type="text/javascript" src="polyfills.78b9c7b44cadedf73ac5.bundle.js"></script>
<script type="text/javascript" src="scripts.d1bb6c21e0ff76cdb999.bundle.js"></script>
<script type="text/javascript" src="vendor.675f00e6222478413a58.bundle.js"></script>
<script type="text/javascript" src="main.35d5146839bb89675db3.bundle.js"></script>';

        $includes = $fetcher->fetch();

        $this->assertEquals($expected, $includes);
    }
}