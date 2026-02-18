<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Ανοιχτά Δεδομένα',
                'slug' => 'anoichta-dedomena',
                'description' => 'Άρθρα σχετικά με τα ανοιχτά δεδομένα',
            ],
            [
                'name' => 'Τεχνολογία',
                'slug' => 'technologia',
                'description' => 'Τεχνολογικά θέματα και καινοτομίες',
            ],
            [
                'name' => 'Εκπαίδευση',
                'slug' => 'ekpaidefsi',
                'description' => 'Εκπαιδευτικό υλικό και πρωτοβουλίες',
            ],
            [
                'name' => 'Ερευνα',
                'slug' => 'erevna',
                'description' => 'Ερευνητικές εργασίες και μελέτες',
            ],
            [
                'name' => 'Νέα',
                'slug' => 'nea',
                'description' => 'Νέα και ανακοινώσεις',
            ],
            [
                'name' => 'Εκδηλώσεις',
                'slug' => 'ekdilosis',
                'description' => 'Εκδηλώσεις/Events',
            ],
        ];

        foreach ($categories as $category) {
            if (!Category::where('slug', $category['slug'])->exists()) {
                Category::create($category);
                $this->command->info("✓ Category created: {$category['name']}");
            } else {
                $this->command->warn("⚠ Category '{$category['name']}' already exists. Skipping...");
            }
        }
    }
}