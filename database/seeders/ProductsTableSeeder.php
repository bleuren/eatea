<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = $this->findBySlug('mesona-tea');
        if (!$product->exists) {
            $product->fill([
                'name'    => __('仙草茶'),
                'body'    => '成份：陳年仙草乾、鳳尾草、含殼草、雞骨草等多種天然植物青草遵古法提煉。說明：促進唾液分泌、潤喉、生津止渴、使排便順暢，幫助維持消化道機能。',
                'image'   => 'products/products-1.webp',
                'price'   => 80,
                'stock'   => 100,
                'order'   => 0,
                'enabled' => true,
            ])->save();
        }
        $product = $this->findBySlug('herbal-tea');
        if (!$product->exists) {
            $product->fill([
                'name'    => __('涼茶'),
                'tags'    => '["summer"]',
                'body'    => '成份：白鶴靈芝、 黃花密菜、薄荷、仙草、紫蘇、香茹等多種天然植物青草遵古法提煉。說明：清爽解膩、生津止渴、清涼怡神、消暑退火、健胃祛風、緩解壓力、醒腦解鬱、通氣潤喉。',
                'image'   => 'products/products-2.webp',
                'price'   => 80,
                'stock'   => 100,
                'order'   => 1,
                'enabled' => true,
            ])->save();
        }
        $product = $this->findBySlug('nourishing-tea');
        if (!$product->exists) {
            $product->fill([
                'name'    => __('養干茶'),
                'body'    => '成份：金線蓮、一葉草、石上伯、鹿角草、功勞葉、七葉膽、康復力等多種天然植物青草遵古法提煉。說明：促進新陳代謝、調節生理機能、減少疲勞感、增強體力、精氣神旺。',
                'image'   => 'products/products-3.webp',
                'price'   => 120,
                'stock'   => 100,
                'order'   => 0,
                'enabled' => true,
            ])->save();
        }
        $product = $this->findBySlug('bitter-tea');
        if (!$product->exists) {
            $product->fill([
                'name'    => __('苦茶'),
                'body'    => '成份：石牡丹、金線蓮、穿心蓮、七葉膽、半枝蓮、還魂草、小金英等多種天然植物青草遵古法提煉。說明：開胃、降火氣，使口氣芬芳、調整體質、養顏美容、健康維持、清血解毒、潤肺鎮咳、增強免疫力。',
                'image'   => 'products/products-4.webp',
                'price'   => 120,
                'stock'   => 100,
                'order'   => 0,
                'enabled' => true,
            ])->save();
        }
        $product = $this->findBySlug('herbal-jelly');
        if (!$product->exists) {
            $product->fill([
                'name'    => __('天仙凍'),
                'tags'    => '["new"]',
                'body'    => '“石伯仙草凍”採用上等陳年仙草乾與一定比例之獨家青草配方，純正草乾遵古法長時間精心熬合煉製，並加入富含膳食纖維且低熱量的“寒天”，可增加飽足感並促進腸道蠕動，口味香醇獨家!絕非化學粉末調製，無添加化學色素及香料。安心，實在，爽口！',
                'image'   => 'products/products-5.webp',
                'price'   => 80,
                'stock'   => 100,
                'order'   => 0,
                'enabled' => true,
            ])->save();
        }
        $product = $this->findBySlug('hot-herbal-jelly');
        if (!$product->exists) {
            $product->fill([
                'name'    => __('燒仙草'),
                'tags'    => '["winter"]',
                'body'    => '遵循古法提煉，採用上等陳年仙草乾與多種植物青草乾長時間精心熬製，口味香醇獨家！',
                'image'   => 'products/products-6.webp',
                'price'   => 80,
                'stock'   => 100,
                'order'   => 0,
                'enabled' => true,
            ])->save();
        }
        $product = $this->findBySlug('ginger-tea');
        if (!$product->exists) {
            $product->fill([
                'name'    => __('暖身薑茶'),
                'tags'    => '["new","winter"]',
                'body'    => '採用品質優良之老薑、黃耆、桂圓、紅棗、枸杞等天然植物配方，與黑糖經一定比例熬煮，性質溫和，活血祛寒，天冷時溫熱喝一杯，更是益氣暖身，通體舒暢!',
                'image'   => 'products/products-7.webp',
                'price'   => 80,
                'stock'   => 100,
                'order'   => 0,
                'enabled' => true,
            ])->save();
        }
        $product = $this->findBySlug('fruit-and-vegetable-enzymes');
        if (!$product->exists) {
            $product->fill([
                'name'    => __('綜合蔬果酵素'),
                'body'    => '使用鳳梨、酪梨、火龍果、葡萄、檸檬、蘋果、木瓜......等多種新鮮蔬果發酵。本產品為活菌酵素，仍在微量發酵中，請務必冷藏保存，並將瓶蓋旋鬆，如有沉澱物，屬自然現象，請安心飲用。',
                'image'   => 'products/products-8.webp',
                'price'   => 80,
                'stock'   => 100,
                'order'   => 0,
                'enabled' => true,
            ])->save();
        }
    }

    /**
     * [product description].
     *
     * @param [type] $key [description]
     *
     * @return [type] [description]
     */
    protected function findBySlug($slug)
    {
        return Product::firstOrNew(['slug' => $slug]);
    }
}
