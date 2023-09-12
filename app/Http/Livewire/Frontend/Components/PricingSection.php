<?php

namespace App\Http\Livewire\Frontend\Components;

use Livewire\Component;

class PricingSection extends Component
{
    public function render()
    {
        $pricings = [
            [
                'popular' => false,
                'label' => 'Free',
                'title' => 'Free',
                'sub_title' => 'Free Plan',
                'features' => [
                    ['title' => '100 Products', 'active' => true],
                    ['title' => 'Technical Support', 'active' => true],
                    ['title' => 'Instant Approval', 'active' => false],
                ],
            ],
            [
                'popular' => true,
                'label' => 'Startup',
                'title' => 'Tk. 5000',
                'sub_title' => 'For new business',
                'features' => [
                    ['title' => '1000 Products', 'active' => true],
                    ['title' => 'Technical Support', 'active' => true],
                    ['title' => 'Instant Approval', 'active' => false],
                ],
            ],
            [
                'popular' => false,
                'label' => 'Growing',
                'title' => 'Tk. 20000',
                'sub_title' => 'For growing business',
                'features' => [
                    ['title' => '5000 Products', 'active' => true],
                    ['title' => 'Technical Support', 'active' => true],
                    ['title' => 'Instant Approval', 'active' => false],
                ],
            ],
            [
                'popular' => false,
                'label' => 'Enterprise',
                'title' => 'Tk. 40000',
                'sub_title' => 'Advanced features',
                'features' => [
                    ['title' => '10000 Products', 'active' => true],
                    ['title' => 'Technical Support', 'active' => true],
                    ['title' => 'Instant Approval', 'active' => true],
                ],
            ],
        ];

        return view('livewire.frontend.components.pricing-section', compact('pricings'));
    }
}
