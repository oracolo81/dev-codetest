<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use App\Helpers\AffiliatesHelper;

class AffiliatesHelperTest extends TestCase
{
    public function test_loadJson()
    {
        $json = AffiliatesHelper::loadJson('updated-affiliates.txt');
        $firstAffiliate = (array)reset($json);
        $lastAffiliate = (array)end($json);

        $this->assertContains('Yosef Giles', $firstAffiliate);
        $this->assertContains(12, $firstAffiliate);
        $this->assertContains('Tasneem Wolfe', $lastAffiliate);
        $this->assertContains(25, $lastAffiliate);
    }

    public function test_FileNotExist()
    {
        $json = AffiliatesHelper::loadJson('not_exist.txt');
        $error = AffiliatesHelper::getError();

        $this->assertStringContainsString('Failed to open stream: No such file or directory', $error);
    }

    public function test_Distance()
    {
        $latRome = 41.8919;
        $longRome = 12.5113;
        $latDublin = 53.3331;
        $longDublin = -6.2489;
        $knownDistance = 1886; // https://www.distancecalculator.net/from-rome-to-dublin

        $distance = AffiliatesHelper::distance($latRome, $longRome, $latDublin, $longDublin);
        $this->assertEquals($knownDistance, $distance);
    }
}
