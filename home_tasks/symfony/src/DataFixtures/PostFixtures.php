<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Post;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    private $categoryRepository;

    /**
     * PostFixtures constructor.
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function load(ObjectManager $manager)
    {
        /*if($this->categoryRepository instanceof CategoryRepository) {
            $categories = $this->categoryRepository->findOneBy(['name' => 'category 1']);

            var_dump($categories);
            die();
        }*/
        for ($i = 1; $i <= 20; $i++) {
            $post = new Post();
            $post->setTitle('post ' . $i);
            $post->setText(mt_rand(10, 100));
            //$post->setCategory($this->getReference('category.20'));
            $post->setCategory($this->categoryRepository->findOneBy(['name' => 'category '. rand(1,5)]));

            $manager->persist($post);
        }
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}
