<?php

namespace MasterPoBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        Fixtures::load(
            __DIR__.'/fixtures.yml',
            $manager,
            ['providers' => [$this]]
        );
    }
    public function durationFrom()
    {
        $pattern = 'P'.rand(1, 4).'D';
        return new \DateInterval($pattern);
    }
    public function durationTo()
    {
        $pattern = 'P'.rand(8, 20).'D';
        return new \DateInterval($pattern);
    }
}
