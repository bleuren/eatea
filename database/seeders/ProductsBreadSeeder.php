<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\MenuItem;
use VoyagerBread\Traits\BreadSeeder;

class ProductsBreadSeeder extends Seeder
{
    use BreadSeeder;

    public function bread()
    {
        return [
            // usually the name of the table
            'name'                  => 'products',
            'slug'                  => 'products',
            'display_name_singular' => __('商品'),
            'display_name_plural'   => __('商品'),
            'icon'                  => 'voyager-basket',
            'model_name'            => 'App\Models\Product',
            'controller'            => '',
            'generate_permissions'  => 1,
            'description'           => '',
            'details'               => [
                "order_column"         => null,
                "order_display_column" => null,
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
            'name'       => [
                'type'         => 'text',
                'display_name' => '*名稱',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ],
            'tags'       => [
                'type'         => 'select_multiple',
                'display_name' => '類型',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'options' => [
                        'new'    => '新上市',
                        'summer' => '夏季限定',
                        'winter' => '冬季限定',
                    ],
                ],
                'order'        => 3,
            ],
            'body'       => [
                'type'         => 'rich_text_box',
                'display_name' => '內容',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ],
            'image'      => [
                'type'         => 'image',
                'display_name' => '*圖片',
                'required'     => 1,
                'browse'       => 1,
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
                'order'        => 5,
            ],
            'slug'       => [
                'type'         => 'text',
                'display_name' => '*Slug',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'slugify'    => [
                        'origin'      => 'name',
                        'forceUpdate' => true,
                    ],
                    'validation' => [
                        'rule' => 'unique:posts,slug',
                    ],
                ],
                'order'        => 6,
            ],
            'price'      => [
                'type'         => 'number',
                'display_name' => '*售價',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => ['min' => 0],
                'order'        => 7,
            ],
            'stock'      => [
                'type'         => 'number',
                'display_name' => '*庫存',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => ['min' => 0],
                'order'        => 8,
            ],
            'order'      => [
                'type'         => 'number',
                'display_name' => '排序',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'default' => 0,
                ],
                'order'        => 9,
            ],
            'enabled'    => [
                'type'         => 'checkbox',
                'display_name' => '啟用',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'on'      => '啟用',
                    'off'     => '待用',
                    'checked' => true,
                ],
                'order'        => 10,
            ],
            'created_at' => [
                'type'         => 'timestamp',
                'display_name' => __('建立於'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 11,
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
                'order'        => 12,
            ],
        ];
    }

    public function menuEntry()
    {
        $item = MenuItem::where('title', __('電商管理'))->first();

        return [
            'role'       => 'admin',
            'title'      => __('商品管理'),
            'url'        => '',
            'route'      => 'voyager.products.index',
            'target'     => '_self',
            'icon_class' => 'voyager-list',
            'color'      => null,
            'parent_id'  => is_null($item) ? $item : $item->id,
            'parameters' => null,
            'order'      => 1,
        ];
    }
}
