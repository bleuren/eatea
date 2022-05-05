<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\MenuItem;
use VoyagerBread\Traits\BreadSeeder;

class CategoriesBreadSeeder extends Seeder
{
    use BreadSeeder;

    public function bread()
    {
        return [
            // usually the name of the table
            'name'                  => 'categories',
            'slug'                  => 'categories',
            'display_name_singular' => __('文章分類'),
            'display_name_plural'   => __('文章分類'),
            'icon'                  => 'voyager-categories',
            'model_name'            => 'App\Models\Category',
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
            'id'                                       => [
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
            'parent_id'                                => [
                'type'         => 'number',
                'display_name' => 'ID',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 2,
            ],
            'category_belongsto_category_relationship' => [
                'type'         => 'relationship',
                'display_name' => __('父分類'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'model'       => 'App\\Models\\Category',
                    'table'       => 'categories',
                    'type'        => 'belongsTo',
                    'column'      => 'parent_id',
                    'key'         => 'id',
                    'label'       => 'name',
                    'pivot_table' => 'categories',
                    'pivot'       => 0,
                ],
                'order'        => 2,
            ],
            'name'                                     => [
                'type'         => 'text',
                'display_name' => __('*名稱'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ],
            'slug'                                     => [
                'type'         => 'text',
                'display_name' => __('*URL 別名'),
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
                        'rule' => 'unique:categories,slug',
                    ],
                ],
                'order'        => 4,
            ],
            'image'                                    => [
                'type'         => 'image',
                'display_name' => __('圖片'),
                'required'     => 0,
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
            'order'                                    => [
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
            'enabled'                                  => [
                'type'         => 'checkbox',
                'display_name' => __('啟用'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'on'      => __('啟用'),
                    'off'     => __('待用'),
                    'checked' => true,
                ],
                'order'        => 7,
            ],
            'created_at'                               => [
                'type'         => 'timestamp',
                'display_name' => __('建立於'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 1,
                'details'      => '',
                'order'        => 8,
            ],
            'updated_at'                               => [
                'type'         => 'timestamp',
                'display_name' => __('更新於'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 9,
            ],
        ];
    }

    public function menuEntry()
    {
        $item = MenuItem::where('title', __('網誌'))->first();

        return [
            'role'       => 'admin',
            'title'      => __('文章分類'),
            'url'        => '',
            'route'      => 'voyager.categories.index',
            'target'     => '_self',
            'icon_class' => 'voyager-categories',
            'color'      => null,
            'parent_id'  => is_null($item) ? $item : $item->id,
            'parameters' => null,
            'order'      => 1,
        ];
    }
}
