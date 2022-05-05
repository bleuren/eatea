<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use TCG\Voyager\Models\Role;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    /*
    public function test_add_order()
    {
    $this->withoutExceptionHandling();
    $user = User::factory(2)->create();
    $product = Product::factory(2)->create();
    $cartService = new CartService(new CartRepository);
    $cartService->create(
    ['id' => $product[0]->id,
    'qty' => 1,
    'mode' => 'PICKUP'
    ]
    );
    $cartService->create(
    ['id' => $product[1]->id,
    'qty' => 1,
    'mode' => 'DELIVERY'
    ]
    );
    $cart = $cartService->index();
    $orderService = new OrderService(
    new OrderRepository,
    new OrderItemRepository,
    new OrderItemSubRepository,
    new ProductRepository,
    new CartRepository
    );

    $request = Order::factory()->create(['user_id' => $user[0]->id]);
    $order = $orderService->create($request);
    $this->assertEquals('50', $order->fee);

    $response = $this->actingAs($user[0])->get(route('order.show', ['order' => $order->id]));
    $response->assertStatus(200);
    $response->assertSee($product[0]->name);
    $response->assertSee($product[1]->name);
    $response->assertSee($cart->total);
    }

    public function test_admin_can_browse_all_orders()
    {
    $user = User::factory()->create([]);
    $orderService = new OrderService(
    new OrderRepository,
    new OrderItemRepository,
    new OrderItemSubRepository,
    new ProductRepository,
    new CartRepository
    );
    $request = Order::factory(100)->create();
    $response = $this->actingAs($user[0])->get(route('order.index'));
    $response->assertStatus(200);
    $response = $this->actingAs($user[1])->get(route('order.show', ['order' => $order->id]));
    $response->assertStatus(500);
    }

    public function test_user_can_not_read_unauth_order()
    {
    $user = User::factory(2)->create();
    $orderService = new OrderService(
    new OrderRepository,
    new OrderItemRepository,
    new OrderItemSubRepository,
    new ProductRepository,
    new CartRepository
    );
    $request = Order::factory()->create(['user_id' => $user[0]->id]);
    $order = $orderService->create($request);
    $response = $this->actingAs($user[0])->get(route('order.show', ['order' => $order->id]));
    $response->assertStatus(200);
    $response = $this->actingAs($user[1])->get(route('order.show', ['order' => $order->id]));
    $response->assertStatus(500);
    }
     */
    public function testUserCreateOrder()
    {
        $this->withoutExceptionHandling();

        $role = Role::firstOrNew(['name' => 'admin']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('管理員'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'staff']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('工作人員'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'user']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('一般使用者'),
            ])->save();
        }

        $user          = User::factory()->create();
        $user->role_id = 1;
        $product       = Product::factory(5)->create();
        $response      = $this->actingAs($user)->get(route('product.show', ['product' => $product[0]->slug]));
        $response->assertStatus(200);
        $response = $this->get(route('cart.index'));
        $response->assertStatus(200);
        $cartRequest[] = ['id' => $product[0]->id, 'received_at' => null, 'mode' => 'DELIVERY', 'qty' => 1];
        $cartRequest[] = ['id' => $product[1]->id, 'received_at' => null, 'mode' => 'PICKUP', 'qty' => 2];
        $cartRequest[] = ['id' => $product[2]->id, 'received_at' => '2021-7-13, 2021-7-14, 2021-7-15', 'mode' => 'SUBSCRIBE', 'qty' => 3];

        foreach ($cartRequest as $request) {
            $response = $this->post(route('cart.store', $request));
        }
        $response->assertRedirect(route('cart.index'));
        $rowId = \Cart::search(function ($cartRequest, $rowId) {
            return $cartRequest->options['mode'] === 'DELIVERY';
        })->keys();

        Livewire::test('cart-update-qty', ['rowId' => $rowId[0]])
            ->set('qty', 1)
            ->call('updateQty');
        $total = \Cart::total(0, '.', '');
        if ($total < 300) {
            $total = intval($total) + 50;
        }
        $response = $this->get(route('cart.index'));
        $response->assertSeeLivewire('cart.index');
        $response->assertSeeLivewire('cart.patch-qty');
        $response->assertSee($product[0]->name);
        $response->assertSee($product[1]->name);
        $response->assertSee($product[2]->name);
        $response = $this->get(route('cart.addinfo'));
        $response->assertStatus(200);
        $response = $this->followingRedirects()->post(route('order.store',
            [
                'name'    => $user->name,
                'mobile'  => '0900000000',
                'address' => '台北市文山區萬寧街',
                'message' => '測試訊息',
            ]));
        $response->assertSeeLivewire('order-edit');
        $response->assertSeeLivewire('order.calendar');
        $response->assertSee('訂單價值: ' . strval($total));
        $response->assertSee(Product::find($cartRequest[2]['id'])->name . ' : 1');
    }

}
