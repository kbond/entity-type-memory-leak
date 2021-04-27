<?php

namespace App\Tests;

use App\Factory\CategoryFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Browser\Test\HasBrowser;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class SampleTest extends KernelTestCase
{
    use Factories, ResetDatabase, HasBrowser;

    protected function setUp(): void
    {
        CategoryFactory::createMany(3);
    }

    public static function multiplier(): array
    {
        return \array_fill(0, $_SERVER['TEST_RUNS'] ?? 1, []);
    }

    /**
     * @test
     * @dataProvider multiplier
     */
    public function new_post(): void
    {
        $this->browser()
            ->visit('/')
            ->assertSuccessful()
            ->visit('/post/new')
            ->assertSuccessful()
            ->visit('/')
            ->assertSuccessful()
        ;
    }

    /**
     * @test
     * @dataProvider multiplier
     */
    public function homepage(): void
    {
        $this->browser()
            ->visit('/')
            ->assertSuccessful()
        ;
    }
}
