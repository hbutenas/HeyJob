<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Service industry',
            'Production / Manufacturing',
            'Information technology',
            'Finance / Accounting',
            'Organisation and management',
            'Sales',
            'Administration / Secretarial',
            'Technical Engineering',
            'Transport / Logistics',
            'Banking / Insurance',
            'Trade / Purchase / Supply',
            'Construction / Real estate',
            'Electronics / Telecommunication',
            'Human resources',
            'Energetics / Eletricity',
            'Law / Legal aid',
            'Marketing / Advertising',
            'State and public administration',
            'Health care / Social care',
            'Quality assurance',
            'Tourism, Hotels, Catering',
            'Education / Science',
            'Media / Public relations',
            'Culture / Arts / Entertainment / Sport',
            'Agriculture / Environmnetal services',
            'Pharmacy',
            'Security / Rescue services',
            'Forestry / Woodworking',
            'Third sector / NGO',
            'Temporary / Seasonal',
            'Voluntary job',
            'Other'
        ];

        foreach ($categories as $category) {
            Category::create([
                'category' => $category,
            ]);
        }
    }
}
