<?php

namespace App\Http\Livewire\Frontend\Components;

use Illuminate\Support\Facades\Vite;
use Livewire\Component;

class TestimonialsSection extends Component
{
    public function render()
    {
        $testimonials = [
            [
                'title' => 'Apple Inc.',
                'logo' => Vite::asset('resources/images/apple.png'),
                'details' => 'We\'ve been using this platform for a while now, and it has truly streamlined our product tracking and ownership verification processes. The QR code feature is fantastic, providing our customers with real-time information about their Apple products. Kudos to the team behind this innovation',
            ],
            [
                'title' => 'Samsung Electronics',
                'logo' => Vite::asset('resources/images/samsung.png'),
                'details' => 'This platform has significantly enhanced our supply chain management. With its robust tracking system, we\'ve improved transparency and trust among our partners and customers. It\'s an invaluable tool for our business',
            ],
            [
                'title' => 'Nokia Corporation',
                'logo' => Vite::asset('resources/images/nokia.png'),
                'details' => 'We appreciate the commitment to security and authenticity this platform offers. It has helped us ensure the legitimacy of our products and maintain customer trust. The ease of use and comprehensive ownership history are standout features',
            ],
            [
                'title' => 'HP Inc.',
                'logo' => Vite::asset('resources/images/hp.png'),
                'details' => 'As a technology company, we understand the importance of digital solutions. This platform has revolutionized the way we handle product ownership. It\'s a reliable and efficient system that has simplified our operations.',
            ],
            [
                'title' => 'AsusTek Computer Inc.',
                'logo' => Vite::asset('resources/images/asus.png'),
                'details' => 'Our partnership with this platform has been invaluable. It has given us a competitive edge by improving customer confidence and ensuring the authenticity of our products. The ownership tracking and verification capabilities are top-notch.',
            ],
            [
                'title' => 'Lenovo Group Ltd.',
                'logo' => Vite::asset('resources/images/lenovo.png'),
                'details' => 'This platform has been instrumental in enhancing our customer experience. The QR code system has made it easy for our customers to verify their product authenticity, and the ownership history feature is a game-changer in our industry.',
            ],
            [
                'title' => 'Dell Technologies',
                'logo' => Vite::asset('resources/images/dell.png'),
                'details' => 'We\'ve seen a significant improvement in customer trust and satisfaction since implementing this platform. It has streamlined our processes and provided us with a clear overview of product ownership. It\'s a valuable asset for our business',
            ],
            [
                'title' => 'DJI Technology Co., Ltd.',
                'logo' => Vite::asset('resources/images/dji.png'),
                'details' => 'At DJI, we\'re committed to innovation and excellence, and this platform aligns perfectly with our values. It has given us an effective way to ensure the authenticity of our drones and accessories. The product tracking and ownership history features are unmatched in the industry.',
            ],
            [
                'title' => 'Huawei Technologies Co., Ltd.',
                'logo' => Vite::asset('resources/images/huawei.png'),
                'details' => 'Huawei has always stood for quality and trust, and we\'re thrilled to partner with this platform to reinforce those values. The ownership verification system ensures that our customers receive genuine Huawei products. It\'s a reliable solution that adds a layer of confidence to our brand.',
            ],
        ];

        return view('livewire.frontend.components.testimonials-section', compact('testimonials'));
    }
}
