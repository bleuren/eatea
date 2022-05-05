<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\MenuItem;
use VoyagerBread\Traits\BreadSeeder;

class OrdersBreadSeeder extends Seeder
{
    use BreadSeeder;

    public function bread()
    {
        return [
            // usually the name of the table
            'name'                  => 'orders',
            'slug'                  => 'orders',
            'display_name_singular' => __('訂單'),
            'display_name_plural'   => __('訂單'),
            'icon'                  => 'voyager-receipt',
            'model_name'            => 'App\Models\Order',
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
            'id'                                => [
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
            'user_id'                           => [
                'type'         => 'number',
                'display_name' => 'user_id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ],
            'order_belongsto_user_relationship' => [
                'type'         => 'relationship',
                'display_name' => __('用戶'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'model'       => 'App\\Models\\User',
                    'table'       => 'users',
                    'type'        => 'belongsTo',
                    'column'      => 'user_id',
                    'key'         => 'id',
                    'label'       => 'name',
                    'pivot_table' => 'users',
                    'pivot'       => 0,
                ],
                'order'        => 2,
            ],
            'name'                              => [
                'type'         => 'text',
                'display_name' => __('*收件人姓名'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ],
            'address'                           => [
                'type'         => 'text',
                'display_name' => __('*收件地址'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ],
            'mobile'                            => [
                'type'         => 'text',
                'display_name' => __('*聯絡手機'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 5,
            ],
            'payment'                           => [
                'type'         => 'text',
                'display_name' => __('*匯款帳號末五碼'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 6,
            ],
            'message'                           => [
                'type'         => 'text_area',
                'display_name' => __('附加訊息'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 7,
            ],
            'fee'                               => [
                'type'         => 'number',
                'display_name' => __('運費'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'default' => 0,
                    'min'     => 0,
                ],
                'order'        => 6,
            ],
            'status'                            => [
                'type'         => 'select_dropdown',
                'display_name' => __('訂單狀態'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'default' => 'PENDING',
                    'options' => [
                        'PENDING' => '待審核',
                        'CHECKED' => '已確認訂單',
                        'PAID'    => '確認已付款',
                        'ARRIVED' => '送達',
                    ],
                ],
                'order'        => 8,
            ],
            'created_at'                        => [
                'type'         => 'timestamp',
                'display_name' => __('建立於'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 1,
                'details'      => '',
                'order'        => 9,
            ],
            'updated_at'                        => [
                'type'         => 'timestamp',
                'display_name' => __('更新於'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 10,
            ],
        ];
    }

    public function menuEntry()
    {
        $item = MenuItem::where('title', __('電商管理'))->first();

        return [
            'role'       => 'admin',
            'title'      => __('訂單'),
            'url'        => '',
            'route'      => 'voyager.orders.index',
            'target'     => '_self',
            'icon_class' => 'voyager-receipt',
            'color'      => null,
            'parent_id'  => is_null($item) ? $item : $item->id,
            'parameters' => null,
            'order'      => 2,
        ];
    }
}
