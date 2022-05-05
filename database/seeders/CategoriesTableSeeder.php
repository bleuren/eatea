<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $category = $this->findBySlug('news');
        if (!$category->exists) {
            $category->fill([
                'name' => '新聞',
            ])->save();
        }

        $category = $this->findBySlug('recommends');
        if (!$category->exists) {
            $category->fill([
                'name' => '部落客口中的石伯',
            ])->save();
        }

        $category = $this->findBySlug('articles');
        if (!$category->exists) {
            $category->fill([
                'name' => '文章',
            ])->save();
        }
    }

    /**
     * [category description].
     *
     * @param [type] $slug [description]
     *
     * @return [type] [description]
     */
    protected function findBySlug($slug)
    {
        return Category::firstOrNew(['slug' => $slug]);
    }
}
