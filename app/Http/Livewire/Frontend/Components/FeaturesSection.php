<?php

namespace App\Http\Livewire\Frontend\Components;

use Livewire\Component;

class FeaturesSection extends Component
{
    public function render()
    {
        $features = [
            [
                'icon'    => 'bi-bag-check-fill',
                'title'   => 'Product Ownership Tracking',
                'details' => 'Effortlessly track the ownership history of your products from manufacturer to customer with our robust system.',
            ],
            [
                'icon'    => 'bi-calendar3',
                'title'   => 'Warranty Management',
                'details' => 'Manage product warranties with ease. Know when warranties start and end, ensuring timely customer support.',
            ],
            [
                'icon'    => 'bi-qr-code',
                'title'   => 'Secure QR Code Integration',
                'details' => 'Each product comes with a unique QR code for easy verification, providing assurance of authenticity.',
            ],
            [
                'icon'    => 'bi-bell-fill',
                'title'   => 'Real-time Notifications',
                'details' => 'Stay informed with real-time notifications on product sales, ownership changes, and warranty updates.',
            ],
            [
                'icon'    => 'bi-ui-checks-grid',
                'title'   => 'User-Friendly Dashboards',
                'details' => 'Intuitive dashboards for manufacturers, shops/resellers, and customers, making product management a breeze.',
            ],
            [
                'icon'    => 'bi-clock-history',
                'title'   => 'Ownership History',
                'details' => 'Access a detailed ownership history log for each product, enhancing accountability.',
            ],
            [
                'icon'    => 'bi-diagram-3-fill',
                'title'   => 'Seamless Transactions',
                'details' => 'Facilitate smooth transactions between manufacturers, shops/resellers, and customers, fostering trust.',
            ],
            [
                'icon'    => 'bi-patch-check-fill',
                'title'   => 'Product Verification',
                'details' => 'Verify product authenticity instantly with our QR code scanning feature.',
            ],
            [
                'icon'    => 'bi-shield-fill-check',
                'title'   => 'Data Security',
                'details' => 'We prioritize your data security. Rest assured, your information is protected.',
            ],
        ];

        return view('livewire.frontend.components.features-section', compact('features'));
    }
}
