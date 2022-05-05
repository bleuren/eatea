<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class AffiliateId extends Component
{
    public $affiliate_id;

    public $user;

    public $isInputVisible = false;

    protected $listeners = ['refreshAffiliateId'];

    protected function rules()
    {
        return [
            'affiliate_id' => [
                'required',
                'min:5',
                'max:8',
                'alpha_num',
                'unique:users,affiliate_id,' . $this->user->id,
            ],
        ];
    }

    public function mount(User $user)
    {
        $this->user         = $user;
        $this->affiliate_id = $user->affiliate_id;
    }

    public function onUpdateClick()
    {
        $this->isInputVisible = true;
    }

    public function offUpdateClick()
    {
        $this->isInputVisible = false;
        $this->emit('refreshAffiliateId');
    }
    public function updateInput()
    {
        $this->validate();
        $this->user->affiliate_id = $this->affiliate_id;
        $this->user->save();
        $this->offUpdateClick();
        $this->emit('refreshAffiliateId');
    }
    public function refreshAffiliateId()
    {
        $this->affiliate_id = $this->user->affiliate_id;
    }

    public function render()
    {
        return view('livewire.user.affiliate-id');
    }
}
