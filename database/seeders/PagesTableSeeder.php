<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $page = $this->findBySlug('about');
        if (!$page->exists) {
            $page->fill([
                'title'            => __('簡介'),
                'html'             => file_get_contents(__DIR__.'/seeds/page/about.html'),
                'meta_description' => 'Yar Meta Description',
                'meta_keywords'    => 'Keyword1, Keyword2',
                'status'           => 'ACTIVE',
            ])->save();
        }
        $page = $this->findBySlug('herbs');
        if (!$page->exists) {
            $page->fill([
                'title'            => __('青草百科'),
                'html'             => file_get_contents(__DIR__.'/seeds/page/herbs.html'),
                'meta_description' => 'Yar Meta Description',
                'meta_keywords'    => 'Keyword1, Keyword2',
                'status'           => 'ACTIVE',
            ])->save();
        }
        $page = $this->findBySlug('faq');
        if (!$page->exists) {
            $page->fill([
                'title'            => __('常見問題'),
                'html'             => file_get_contents(__DIR__.'/seeds/page/faq.html'),
                'meta_description' => 'Yar Meta Description',
                'meta_keywords'    => 'Keyword1, Keyword2',
                'status'           => 'ACTIVE',
            ])->save();
        }
        $page = $this->findBySlug('contact');
        if (!$page->exists) {
            $page->fill([
                'title'            => __('聯絡我們'),
                'html'             => file_get_contents(__DIR__.'/seeds/page/contact.html'),
                'meta_description' => 'Yar Meta Description',
                'meta_keywords'    => 'Keyword1, Keyword2',
                'status'           => 'ACTIVE',
            ])->save();
        }
    }

    /**
     * [post description].
     *
     * @param [type] $slug [description]
     *
     * @return [type] [description]
     */
    protected function findBySlug($slug)
    {
        return Page::firstOrNew(['slug' => $slug]);
    }
}
