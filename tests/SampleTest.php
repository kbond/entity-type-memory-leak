<?php

namespace App\Tests;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SampleTest extends WebTestCase
{
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
        $category = new Category();
        $category->setName('foo');

        self::bootKernel();
        $om = self::$container->get('doctrine')->getManager();
        $om->createQuery("DELETE App\Entity\Category e")->execute();
        $om->persist($category);
        $om->flush();

        self::ensureKernelShutdown();

        $client = static::createClient();

        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $client->request('GET', '/post/new');
        $this->assertResponseIsSuccessful();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
    }

    /**
     * @test
     * @dataProvider multiplier
     */
    public function homepage(): void
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
    }
}
