<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\MenuItem;
use VoyagerBread\Traits\BreadSeeder;

class OrderItemsBreadSeeder extends Seeder
{
    use BreadSeeder;

    public function bread()
    {
        return [
            // usually the name of the table
            'name'                  => 'order_items',
            'slug'                  => 'order_items',
            'display_name_singular' => __('訂單商品'),
            'display_name_plural'   => __('訂單商品'),
            'icon'                  => 'voyager-basket',
            'model_name'            => 'App\Models\OrderItem',
            'controller'            => null,
            'generate_permissions'  => 1,
            'server_side'           => true,
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
            'id'                                        => [
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
            'order_id'                                  => [
                'type'         => 'number',
                'display_name' => 'order_id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ],
            'order_item_belongsto_order_relationship'   => [
                'type'         => 'relationship',
                'display_name' => __('*訂單'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'model'       => 'App\\Models\\Order',
                    'table'       => 'orders',
                    'type'        => 'belongsTo',
                    'column'      => 'order_id',
                    'key'         => 'id',
                    'label'       => 'id',
                    'pivot_table' => 'orders',
                    'pivot'       => 0,
                ],
                'order'        => 2,
            ],
            'product_id'                                => [
                'type'         => 'number',
                'display_name' => __('產品編號'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ],
            'order_item_belongsto_product_relationship' => [
                'type'         => 'relationship',
                'display_name' => __('*產品'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'model'       => 'App\\Models\\Product',
                    'table'       => 'products',
                    'type'        => 'belongsTo',
                    'column'      => 'product_id',
                    'key'         => 'id',
                    'label'       => 'name',
                    'pivot_table' => 'products',
                    'pivot'       => 0,
                ],
                'order'        => 3,
            ],
            'mode'                                      => [
                'type'         => 'select_dropdown',
                'display_name' => __('*訂單類型'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'default' => 'SUBSCRIBE',
                    'options' => [
                        'SUBSCRIBE' => __('訂閱'),
                        'PICKUP'    => __('到店取貨'),
                        'DELIVERY'  => __('宅配'),
                    ],
                ],
                'order'        => 4,
            ],
            'price'                                     => [
                'type'         => 'number',
                'display_name' => __('*價格'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => ['min' => 0],
                'order'        => 5,
            ],
            'qty'                                       => [
                'type'         => 'number',
                'display_name' => __('*數量'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => ['min' => 0],
                'order'        => 6,
            ],
            'discount'                                  => [
                'type'         => 'number',
                'display_name' => __('*折扣'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'default' => 0,
                ],
                'order'        => 7,
            ],
        ];
    }

    public function menuEntry()
    {
        $item = MenuItem::where('title', __('電商管理'))->first();

        return [
            'role'       => 'admin',
            'title'      => __('訂單商品'),
            'url'        => '',
            'route'      => 'voyager.order_items.index',
            'target'     => '_self',
            'icon_class' => 'voyager-basket',
            'color'      => null,
            'parent_id'  => is_null($item) ? $item : $item->id,
            'parameters' => null,
            'order'      => 3,
        ];
    }
}
