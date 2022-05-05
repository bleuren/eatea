<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\MenuItem;
use VoyagerBread\Traits\BreadSeeder;

class OrderItemSubsBreadSeeder extends Seeder
{
    use BreadSeeder;

    public function bread()
    {
        return [
            // usually the name of the table
            'name'                  => 'order_item_subs',
            'slug'                  => 'order_item_subs',
            'display_name_singular' => __('訂閱資料'),
            'display_name_plural'   => __('訂閱資料'),
            'icon'                  => 'voyager-calendar',
            'model_name'            => 'App\Models\OrderItemSub',
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
            'id'                                              => [
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
            'order_item_id'                                   => [
                'type'         => 'number',
                'display_name' => 'order_item_id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ],
            'order_item_sub_belongsto_orderItem_relationship' => [
                'type'         => 'relationship',
                'display_name' => __('*訂單商品'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'model'       => 'App\\Models\\OrderItem',
                    'table'       => 'orderItems',
                    'type'        => 'belongsTo',
                    'column'      => 'order_item_id',
                    'key'         => 'id',
                    'label'       => 'order_id',
                    'pivot_table' => 'orderItems',
                    'pivot'       => 0,
                ],
                'order'        => 2,
            ],
            'received_at'                                     => [
                'type'         => 'date',
                'display_name' => __('*收件日期'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ],
            'qty'                                             => [
                'type'         => 'number',
                'display_name' => __('*數量'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => ['min' => 0],
                'order'        => 4,
            ],
            'status'                                          => [
                'type'         => 'select_dropdown',
                'display_name' => __('*狀態'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'default' => 'SUBSCRIBE',
                    'options' => [
                        'PENDING'   => __('待送'),
                        'ARRIVED'   => __('已送達'),
                        'UNCLAIMED' => __('未取'),
                    ],
                ],
                'order'        => 5,
            ],
            'created_at'                                      => [
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ],
            'updated_at'                                      => [
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
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
        $item = MenuItem::where('title', __('電商管理'))->first();

        return [
            'role'       => 'admin',
            'title'      => __('訂閱資料'),
            'url'        => '',
            'route'      => 'voyager.order_item_subs.index',
            'target'     => '_self',
            'icon_class' => 'voyager-calendar',
            'color'      => null,
            'parent_id'  => is_null($item) ? $item : $item->id,
            'parameters' => null,
            'order'      => 4,
        ];
    }
}
