<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 5, 200),
            'stock' => $this->faker->numberBetween(10, 100),
            'image' => null,
            'estate_id' => 1,
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function ($product) {
            $this->applyCategorySpecificAttributes($product);
        });
    }

    protected function applyCategorySpecificAttributes($product)
    {
        $category = Category::find($product->category_id);

        switch($category->name) {
            case 'Wines & Beverages':
                $this->addWineAttributes($product);
                break;
            case 'Olive Oils & Preserves':
                $this->addOilAttributes($product);
                break;
            case 'Honey & Derivatives':
                $this->addHoneyAttributes($product);
                break;
            case 'Cork & Crafts':
                $this->addCorkAttributes($product);
                break;
            case 'Natural Cosmetics':
                $this->addCosmeticAttributes($product);
                break;
            case 'Decor & Lifestyle':
                $this->addDecorAttributes($product);
                break;
        }
    }

    private function addWineAttributes($product)
    {
        $types = ['Red', 'White', 'Rosé', 'Sparkling', 'Dessert'];
        $vintage = $this->faker->numberBetween(2015, 2023);
        
        $product->name = "{$this->faker->lastName} Estate {$this->faker->randomElement($types)} {$vintage}";
        $product->description = "Premium {$this->faker->randomElement($types)} wine with notes of " . 
                              $this->faker->randomElement(['blackberries', 'citrus', 'vanilla', 'oak', 'spices']);
        $product->price = $this->faker->numberBetween(15, 80);
    }

    private function addOilAttributes($product)
    {
        $infusion = $this->faker->randomElement(['Lemon', 'Garlic', 'Chili', 'Truffle', 'Herbs']);
        $product->name = "Extra Virgin Olive Oil with {$infusion}";
        $product->description = "Cold-pressed olive oil infused with " . 
                              $this->faker->randomElement(['organic', 'fresh', 'natural']) . " {$infusion}";
        $product->price = $this->faker->numberBetween(10, 40);
    }

    private function addHoneyAttributes($product)
    {
        $types = ['Wildflower', 'Lavender', 'Eucalyptus', 'Orange Blossom', 'Acacia'];
        $formats = ['Raw Honey', 'Creamed Honey', 'Comb Honey', 'Infused Honey'];
        
        $product->name = "{$this->faker->randomElement($types)} {$this->faker->randomElement($formats)}";
        $product->description = "Unprocessed honey harvested from {$this->faker->randomElement(['mountain', 'valley', 'forest'])} regions, " .
                              "containing natural {$this->faker->randomElement(['pollen', 'propolis', 'royal jelly'])}";
        $product->price = $this->faker->numberBetween(8, 25);
    }

    private function addCorkAttributes($product)
    {
        $items = ['Coaster Set', 'Cork Bowl', 'Wall Art', 'Journal', 'Placemat'];
        $details = ['Hand-carved', 'Sustainable', 'Artisanal', 'Recycled'];
        
        $product->name = "{$this->faker->randomElement($details)} Cork {$this->faker->randomElement($items)}";
        $product->description = "Eco-friendly cork product featuring {$this->faker->randomElement(['traditional patterns', 'modern design', 'natural texture'])} " .
                              "made by {$this->faker->randomElement(['local artisans', 'master craftsmen', 'family workshops'])}";
        $product->price = $this->faker->numberBetween(12, 60);
    }

    private function addCosmeticAttributes($product)
    {
        $products = ['Body Butter', 'Soap Bar', 'Face Cream', 'Lip Balm', 'Shampoo Bar'];
        $ingredients = ['Argan Oil', 'Shea Butter', 'Aloe Vera', 'Essential Oils', 'Beeswax'];
        
        $product->name = "Organic {$this->faker->randomElement($products)} with {$this->faker->randomElement($ingredients)}";
        $product->description = "Chemical-free cosmetic made with {$this->faker->randomElement(['cold-pressed', 'wild-harvested', 'fair-trade'])} " .
                              "ingredients for {$this->faker->randomElement(['sensitive skin', 'deep hydration', 'natural glow'])}";
        $product->price = $this->faker->numberBetween(5, 35);
    }

    private function addDecorAttributes($product)
    {
        $items = ['Wooden Tray', 'Linen Set', 'Ceramic Vase', 'Candle Holder', 'Throw Pillow'];
        $styles = ['Rustic', 'Farmhouse', 'Mediterranean', 'Bohemian'];
        
        $product->name = "{$this->faker->randomElement($styles)} Style {$this->faker->randomElement($items)}";
        $product->description = "Handcrafted decor piece combining {$this->faker->randomElement(['natural materials', 'traditional techniques', 'modern functionality'])} " .
                              "with {$this->faker->randomElement(['earth tones', 'textured finishes', 'artisanal details'])}";
        $product->price = $this->faker->numberBetween(20, 100);
    }
}