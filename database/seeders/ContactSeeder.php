<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('ja_JP');
        $categories = Category::all();
        $tags = Tag::all();

        for ($i = 0; $i < 20; $i++) {
            $contact = Contact::create([
                'category_id' => $categories->random()->id,
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'gender' => $faker->numberBetween(1, 3),
                'email' => $faker->unique()->safeEmail(),
                'tel' => $faker->numerify('###########'),
                'address' => $faker->address(),
                'building' => $faker->optional()->secondaryAddress(),
                'detail' => $faker->realText(100),
            ]);

            $contact->tags()->attach(
                $tags->random($faker->numberBetween(1, 3))->pluck('id')
            );
        }
    }
}
