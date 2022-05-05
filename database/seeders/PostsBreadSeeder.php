<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\MenuItem;
use VoyagerBread\Traits\BreadSeeder;

class PostsBreadSeeder extends Seeder
{
    use BreadSeeder;

    public function bread()
    {
        return [
            // usually the name of the table
            'name'                  => 'posts',
            'slug'                  => 'posts',
            'display_name_singular' => __('文章'),
            'display_name_plural'   => __('文章'),
            'icon'                  => 'voyager-news',
            'model_name'            => 'App\Models\Post',
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
            'id'                                   => [
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
            'category_id'                          => [
                'type'         => 'number',
                'display_name' => 'category_id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 2,
            ],
            'post_belongsto_category_relationship' => [
                'type'         => 'relationship',
                'display_name' => '分類',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'model'       => 'App\\Models\\Category',
                    'table'       => 'posts',
                    'type'        => 'belongsTo',
                    'column'      => 'category_id',
                    'key'         => 'id',
                    'label'       => 'name',
                    'pivot_table' => 'categories',
                    'pivot'       => 0,
                ],
                'order'        => 2,
            ],
            'title'                                => [
                'type'         => 'text',
                'display_name' => '*標題',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ],
            'seo_title'                            => [
                'type'         => 'text',
                'display_name' => 'SEO 標題',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ],
            'slug'                                 => [
                'type'         => 'text',
                'display_name' => '*URL 別名',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'slugify'    => [
                        'origin'      => 'title',
                        'forceUpdate' => true,
                    ],
                    'validation' => [
                        'rule' => 'unique:posts,slug',
                    ],
                ],
                'order'        => 5,
            ],
            'excerpt'                              => [
                'type'         => 'text_area',
                'display_name' => '摘要',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 6,
            ],
            'body'                                 => [
                'type'         => 'rich_text_box',
                'display_name' => '*內容',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'validation' => [
                        'rule' => 'required',
                    ],
                ],
                'order'        => 7,
            ],
            'image'                                => [
                'type'         => 'image',
                'display_name' => '圖片',
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
                'order'        => 8,
            ],
            'meta_description'                     => [
                'type'         => 'text',
                'display_name' => 'Meta 描述',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 9,
            ],
            'meta_keywords'                        => [
                'type'         => 'text',
                'display_name' => 'Meta 關鍵字',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 10,
            ],
            'status'                               => [
                'type'         => 'select_dropdown',
                'display_name' => '啟用',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'default' => 'PENDING',
                    'options' => [
                        'PUBLISHED' => '發表',
                        'DRAFT'     => '草稿',
                        'PENDING'   => '準備中',
                    ],
                ],
                'order'        => 11,
            ],
            'created_at'                           => [
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 1,
                'details'      => '',
                'order'        => 12,
            ],
            'updated_at'                           => [
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 13,
            ],
        ];
    }

    public function menuEntry()
    {
        $item = MenuItem::where('title', __('網誌'))->first();

        return [
            'role'       => 'admin',
            'title'      => __('文章'),
            'url'        => '',
            'route'      => 'voyager.posts.index',
            'target'     => '_self',
            'icon_class' => 'voyager-news',
            'color'      => null,
            'parent_id'  => is_null($item) ? $item : $item->id,
            'parameters' => null,
            'order'      => 2,
        ];
    }
}
