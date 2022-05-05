<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use VoyagerBread\Traits\BreadSeeder;

class PagesBreadSeeder extends Seeder
{
    use BreadSeeder;

    public function bread()
    {
        return [
            // usually the name of the table
            'name'                  => 'pages',
            'slug'                  => 'pages',
            'display_name_singular' => __('頁面'),
            'display_name_plural'   => __('頁面'),
            'icon'                  => 'voyager-archive',
            'model_name'            => 'App\Models\Page',
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
            'id'               => [
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
            'title'            => [
                'type'         => 'text',
                'display_name' => '*標題',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ],
            'html'             => [
                'type'         => 'rich_text_box',
                'display_name' => '*HTML',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'validation'     => [
                        'rule' => 'required',
                    ],
                    'tinymceOptions' => [
                        'content_css' => '../../../css/app.css',
                    ],
                ],
                'order'        => 4,
            ],
            'slug'             => [
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
                        'rule' => 'unique:pages,slug',
                    ],
                ],
                'order'        => 6,
            ],
            'meta_description' => [
                'type'         => 'text',
                'display_name' => 'Meta 描述',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 7,
            ],
            'meta_keywords'    => [
                'type'         => 'text',
                'display_name' => 'Meta 關鍵字',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 8,
            ],
            'status'           => [
                'type'         => 'select_dropdown',
                'display_name' => '啟用',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'default' => 'INACTIVE',
                    'options' => [
                        'INACTIVE' => '待用',
                        'ACTIVE'   => '啟用',
                    ],
                ],
                'order'        => 9,
            ],
            'created_at'       => [
                'type'         => 'timestamp',
                'display_name' => __('建立於'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 10,
            ],
            'updated_at'       => [
                'type'         => 'timestamp',
                'display_name' => __('更新於'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 11,
            ],
        ];
    }

    public function menuEntry()
    {
        return [
            'role'       => 'admin',
            'title'      => __('頁面'),
            'url'        => '',
            'route'      => 'voyager.pages.index',
            'target'     => '_self',
            'icon_class' => 'voyager-archive',
            'color'      => null,
            'parent_id'  => null,
            'parameters' => null,
            'order'      => 8,
        ];
    }
}
