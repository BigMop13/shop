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
        $laptops = ['laptop dell', 'laptop acer', 'laptop razer', 'laptop dell xps', 'laptop razer blade'];

        foreach ($laptops as $laptop) {
            $products[] = (new Product())
                ->setName($laptop)
                ->setDescription('Najnowocześniejsze laptopy')
                ->setPrice(1500)
                ->setStockQuantity(10)
                ->setPhoto('data:image/jpeg;base64,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');
        }

        return $products;
    }

    /**
     * @return Product[]
     */
    private function createMouses(): array
    {
        $products = [];

        $mouses = ['mouse logitech', 'mouse logitech x', 'mouse logitech u', 'mouse razer small', 'mouse razer big', 'mouse classic', 'mouse retro', 'mouse modernisto'];

        $categoriesName = ProductCategoryDictionary::getProductCategories();

        foreach ($mouses as $mouse) {
            $products[] = (new Product())
                ->setName($mouse)
                ->setDescription('Najnowocześniejsze myszki')
                ->setPrice(400)
                ->setStockQuantity(10)
                ->setPhoto('https://5.imimg.com/data5/GK/WE/MY-54308179/wired-computer-mouse.jpg');
        }

        return $products;
    }

    /**
     * @return Product[]
     */
    private function createComputers(): array
    {
        $products = [];
        $computers = ['computer dell biurowy', 'computer dell gamingowy'];

        $categoriesName = ProductCategoryDictionary::getProductCategories();

        foreach ($computers as $computer) {
            $products[] = (new Product())
                ->setName($computer)
                ->setDescription('Najnowocześniejsze komputery')
                ->setPrice(7000)
                ->setStockQuantity(10)
                ->setPhoto('https://5.imimg.com/data5/SELLER/Default/2021/6/PR/NL/LS/79058348/desktop-computer.jpg');
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
