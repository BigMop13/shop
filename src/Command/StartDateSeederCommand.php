<?php

namespace App\Command;

use App\Dictionary\ProductCategoryDictionary;
use App\Entity\Category;
use App\Entity\Product;
use App\Persister\ObjectPersister;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:add-categories-and-products',
    description: 'add basic products and categories to database',
)]
final class StartDateSeederCommand extends Command
{
    public function __construct(
        private readonly ObjectPersister $objectPersister,
        string $name = null,
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $categories = $this->createCategories();
        $laptops = $this->createLaptops();
        $computers = $this->createComputers();
        $mouses = $this->createMouses();

        $this->assignProductsToCategory($computers, $categories[1]);
        $this->assignProductsToCategory($laptops, $categories[0]);
        $this->assignProductsToCategory($mouses, $categories[2]);

        $this->objectPersister->saveMultipleObjects($categories);
        $this->objectPersister->saveMultipleObjects($computers);
        $this->objectPersister->saveMultipleObjects($laptops);
        $this->objectPersister->saveMultipleObjects($mouses);

        return Command::SUCCESS;
    }

    /**
     * @return Category[]
     */
    private function createCategories(): array
    {
        $categories = [];
        $categoriesName = ProductCategoryDictionary::getProductCategories();
        $description = 'To jest kategoria z przedmiotów typu: ';

        foreach ($categoriesName as $categoryName) {
            $categories[] = (new Category())
                ->setName($categoryName)
                ->setDescription(sprintf($description.'%s', $categoryName));
        }

        return $categories;
    }

    /**
     * @return Product[]
     */
    private function createLaptops(): array
    {
        $products = [];
        $laptops = ['laptop 1', 'laptop 2', 'laptop 3', 'laptop 4', 'laptop 5'];
        $computers = ['computer 1', 'computer 2'];
        $mouses = ['mouse 1', 'mouse 2', 'mouse 3', 'mouse 4', 'mouse 5', 'mouse 6', 'mouse 7', 'mouse 8'];

        $categoriesName = ProductCategoryDictionary::getProductCategories();

        foreach ($laptops as $laptop) {
            $products[] = (new Product())
                ->setName($laptop)
                ->setDescription('Najnowocześniejsze laptopy')
                ->setPrice(1500)
                ->setStockQuantity(10);
        }

        return $products;
    }

    /**
     * @return Product[]
     */
    private function createMouses(): array
    {
        $products = [];

        $mouses = ['mouse 1', 'mouse 2', 'mouse 3', 'mouse 4', 'mouse 5', 'mouse 6', 'mouse 7', 'mouse 8'];

        $categoriesName = ProductCategoryDictionary::getProductCategories();

        foreach ($mouses as $mouse) {
            $products[] = (new Product())
                ->setName($mouse)
                ->setDescription('Najnowocześniejsze myszki')
                ->setPrice(400)
                ->setStockQuantity(10);
        }

        return $products;
    }

    /**
     * @return Product[]
     */
    private function createComputers(): array
    {
        $products = [];
        $computers = ['computer 1', 'computer 2'];

        $categoriesName = ProductCategoryDictionary::getProductCategories();

        foreach ($computers as $computer) {
            $products[] = (new Product())
                ->setName($computer)
                ->setDescription('Najnowocześniejsze komputery')
                ->setPrice(7000)
                ->setStockQuantity(10);
        }

        return $products;
    }

    /**
     * @param Product[] $products
     */
    private function assignProductsToCategory(array $products, Category $category): void
    {
        foreach ($products as $product) {
            $product->setCategory($category);
        }
    }
}
