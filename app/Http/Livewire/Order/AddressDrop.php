<?php

namespace App\Http\Livewire\Order;

use App\Models\Map;
use Livewire\Component;

class AddressDrop extends Component
{
    public $cities = [];

    public $city;

    public $districts = [];

    public $district;

    public $roads = [];

    public $map_id;

    public function mount($map_id = null)
    {
        if ($map_id) {
            $map             = Map::find($map_id);
            $this->city      = $map->city;
            $this->district  = $map->district;
            $this->road      = $map->road;
            $this->districts = Map::where([
                'city' => $this->city,
            ])->distinct()->get('district')->flatten();
            $this->roads = Map::where([
                'city'     => $this->city,
                'district' => $this->district,
            ])->get(['id', 'road'])->unique();
        }

    }

    public function getDistricts()
    {
        $this->roads     = [];
        $this->districts = Map::where([
            'city' => $this->city,
        ])->distinct()->get('district')->flatten();
    }

    public function getRoads()
    {
        $this->roads = Map::where([
            'city'     => $this->city,
            'district' => $this->district,
        ])->get(['id', 'road'])->unique();
    }

    public function render()
    {
        $maxId        = \DB::raw('MAX(id)');
        $this->cities = Map::groupBy('city')->orderBy($maxId)->get('city');
        return view('livewire.order.address-drop');
    }
}
