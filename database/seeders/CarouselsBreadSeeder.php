<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use VoyagerBread\Traits\BreadSeeder;

class CarouselsBreadSeeder extends Seeder
{
    use BreadSeeder;

    public function bread()
    {
        return [
            // usually the name of the table
            'name'                  => 'carousels',
            'slug'                  => 'carousels',
            'display_name_singular' => __('輪播'),
            'display_name_plural'   => __('輪播'),
            'icon'                  => 'voyager-video',
            'model_name'            => 'App\Models\Carousel',
            'controller'            => null,
            'generate_permissions'  => 1,
            'description'           => null,
            'details'               => [
                "order_column"         => null,
                "order_display_column" => null,
                "order_direction"      => "asc",
                "default_search_key"   => null,
            ],
        ];
    }

    public function inputFields()
    {
        return [
            'id'         => [
                'type'         => 'number',
                'display_name' => 'ID',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ],
            'title'      => [
                'type'         => 'text',
                'display_name' => __('標題'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ],
            'body'       => [
                'type'         => 'rich_text_box',
                'display_name' => __('內容'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ],
            'image'      => [
                'type'         => 'image',
                'display_name' => __('圖片'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'resize'     => [
                        'width'  => '1000',
                        'height' => 'null',
                    ],
                    'quality'    => '70%',
                    'upsize'     => true,
                    'thumbnails' => [
                        [
                            'name'  => 'medium',
                            'scale' => '50%',
                        ],
                        [
                            'name'  => 'small',
                            'scale' => '25%',
                        ],
                        [
                            'name' => 'cropped',
                            'crop' => [
                                'width'  => '300',
                                'height' => '250',
                            ],
                        ],
                    ],
                ],
                'order'        => 4,
            ],
            'url'        => [
                'type'         => 'text',
                'display_name' => __('連結網址'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 5,
            ],
            'order'      => [
                'type'         => 'number',
                'display_name' => __('排序'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'default' => 0,
                ],
                'order'        => 6,
            ],
            'created_at' => [
                'type'         => 'timestamp',
                'display_name' => __('建立於'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 1,
                'details'      => '',
                'order'        => 6,
            ],
            'updated_at' => [
                'type'         => 'timestamp',
                'display_name' => __('更新於'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 7,
            ],
        ];
    }

    public function menuEntry()
    {
        return [
            'role'       => 'admin',
            'title'      => __('輪播'),
            'url'        => '',
            'route'      => 'voyager.carousels.index',
            'target'     => '_self',
            'icon_class' => 'voyager-video',
            'color'      => null,
            'parent_id'  => null,
            'parameters' => null,
            'order'      => 8,
        ];
    }
}
