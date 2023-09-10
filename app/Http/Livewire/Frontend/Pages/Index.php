<?php

namespace App\Http\Livewire\Frontend\Pages;

use Livewire\Component;

class Index extends Component
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

        $services = [
            [
                'icon' => 'bi-bag-check-fill',
                'title' => 'Product Ownership Tracking',
                'details' => 'Effortlessly track the ownership history of your products from manufacturer to customer with our robust system.',
            ],
            [
                'icon' => 'bi-calendar3',
                'title' => 'Warranty Management',
                'details' => 'Manage product warranties with ease. Know when warranties start and end, ensuring timely customer support.',
            ],
            [
                'icon' => 'bi-qr-code',
                'title' => 'Secure QR Code Integration',
                'details' => 'Each product comes with a unique QR code for easy verification, providing assurance of authenticity.',
            ],
            [
                'icon' => 'bi-bell-fill',
                'title' => 'Real-time Notifications',
                'details' => 'Stay informed with real-time notifications on product sales, ownership changes, and warranty updates.',
            ],
            [
                'icon' => 'bi-ui-checks-grid',
                'title' => 'User-Friendly Dashboards',
                'details' => 'Intuitive dashboards for manufacturers, shops, and customers, making product management a breeze.',
            ],
            [
                'icon' => 'bi-clock-history',
                'title' => 'Ownership History',
                'details' => 'Access a detailed ownership history log for each product, enhancing accountability.',
            ],
            [
                'icon' => 'bi-diagram-3-fill',
                'title' => 'Seamless Transactions',
                'details' => 'Facilitate smooth transactions between manufacturers, shops, and customers, fostering trust.',
            ],
            [
                'icon' => 'bi-patch-check-fill',
                'title' => 'Product Verification',
                'details' => 'Verify product authenticity instantly with our QR code scanning feature.',
            ],
            [
                'icon' => 'bi-shield-fill-check',
                'title' => 'Data Security',
                'details' => 'We prioritize your data security. Rest assured, your information is protected.',
            ],
        ];

        $faqs = [
            [
                'title' => 'What is the purpose of this platform?',
                'details' => 'Our platform is designed to connect Manufacturers, Shops, and Customers to efficiently manage and trade products. It provides a secure and transparent way to track product ownership, manage warranties, and facilitate product transactions.'
            ],
            [
                'title' => 'Who can use this platform?',
                'details' => 'Manufacturers, Shops, and Customers can use this platform. Manufacturers can list their products, Shops can buy products from Manufacturers and sell them to other Shops or Customers, and Customers can purchase products.'
            ],
            [
                'title' => 'How does product ownership work?',
                'details' => 'Product ownership can change through legitimate transactions on the platform. When a Shop or Customer purchases a product, ownership is transferred to them, and a record of ownership history is maintained.'
            ],
            [
                'title' => 'What happens if I need support or have a problem with a transaction?',
                'details' => 'We have a dedicated support team to assist you. If you encounter any issues or have questions about transactions, product details, or warranties, please contact our support team for prompt assistance.'
            ],
            [
                'title' => 'How are warranties handled?',
                'details' => 'Warranties are tied to products and calculated from the date of sale to the end customer. If you have a warranty claim, please reach out to the seller (Shop or Manufacturer) for assistance.',
            ],
            [
                'title' => 'Is my personal information secure on this platform?',
                'details' => 'We take user privacy seriously. Please review our Privacy Policy for detailed information on how we collect, use, and protect your personal data. We implement security measures to keep your information safe.',
            ],
            [
                'title' => 'Can I trust the ownership records on the platform?',
                'details' => 'Yes, ownership records are maintained securely and can be verified through QR codes on products. The platform ensures transparency and accuracy in tracking ownership changes.',
            ],
            [
                'title' => 'How do I create an account?',
                'details' => 'To create an account, visit our registration page and follow the provided instructions. You will need to provide accurate information during the registration process.',
            ],
            [
                'title' => 'Are there any fees for using the platform?',
                'details' => 'Our fee structure may vary depending on the type of user (Manufacturer, Shop, or Customer) and the services used. Please refer to our Pricing section for detailed information.',
            ],
            [
                'title' => 'Can I sell products globally on this platform?',
                'details' => 'Yes, our platform is designed for global trade. Manufacturers and Shops can reach a broad audience and trade products internationally.',
            ],
            [
                'title' => 'How can I verify a product?',
                'details' => 'To verify a product, use our QR code scanner. Scan the QR code on the product\'s label to access ownership history and warranty details, ensuring authenticity and transparency.',
            ],
            [
                'title' => 'How often are the Terms and Conditions updated?',
                'details' => 'We may update the Terms and Conditions as needed. Users will be notified of any material changes. It\'s important to review the Terms periodically for updates.',
            ],
            [
                'title' => 'What should I do if I forget my password?',
                'details' => 'If you forget your password, you can use the "Forgot Password" link on the login page to reset it. Follow the instructions sent to your registered email address.',
            ],
            [
                'title' => 'How do I contact customer support?',
                'details' => 'You can contact our customer support team through the "Contact Us" page on the platform. We are here to assist you with any inquiries or issues you may have.',
            ]
        ];

        $testimonials = [
            [
                'title' => 'Apple Inc.',
                'logo' => 'assets/apple.png',
                'details' => 'We\'ve been using this platform for a while now, and it has truly streamlined our product tracking and ownership verification processes. The QR code feature is fantastic, providing our customers with real-time information about their Apple products. Kudos to the team behind this innovation',
            ],
            [
                'title' => 'Samsung Electronics',
                'logo' => 'assets/samsung.png',
                'details' => 'This platform has significantly enhanced our supply chain management. With its robust tracking system, we\'ve improved transparency and trust among our partners and customers. It\'s an invaluable tool for our business',
            ],
            [
                'title' => 'Nokia Corporation',
                'logo' => 'assets/nokia.png',
                'details' => 'We appreciate the commitment to security and authenticity this platform offers. It has helped us ensure the legitimacy of our products and maintain customer trust. The ease of use and comprehensive ownership history are standout features',
            ],
            [
                'title' => 'HP Inc.',
                'logo' => 'assets/hp.png',
                'details' => 'As a technology company, we understand the importance of digital solutions. This platform has revolutionized the way we handle product ownership. It\'s a reliable and efficient system that has simplified our operations.',
            ],
            [
                'title' => 'AsusTek Computer Inc.',
                'logo' => 'assets/asus.png',
                'details' => 'Our partnership with this platform has been invaluable. It has given us a competitive edge by improving customer confidence and ensuring the authenticity of our products. The ownership tracking and verification capabilities are top-notch.',
            ],
            [
                'title' => 'Lenovo Group Ltd.',
                'logo' => 'assets/lenovo.png',
                'details' => 'This platform has been instrumental in enhancing our customer experience. The QR code system has made it easy for our customers to verify their product authenticity, and the ownership history feature is a game-changer in our industry.',
            ],
            [
                'title' => 'Dell Technologies',
                'logo' => 'assets/dell.png',
                'details' => 'We\'ve seen a significant improvement in customer trust and satisfaction since implementing this platform. It has streamlined our processes and provided us with a clear overview of product ownership. It\'s a valuable asset for our business',
            ],
            [
                'title' => 'DJI Technology Co., Ltd.',
                'logo' => 'assets/dji.png',
                'details' => 'At DJI, we\'re committed to innovation and excellence, and this platform aligns perfectly with our values. It has given us an effective way to ensure the authenticity of our drones and accessories. The product tracking and ownership history features are unmatched in the industry.',
            ],
            [
                'title' => 'Huawei Technologies Co., Ltd.',
                'logo' => 'assets/huawei.png',
                'details' => 'Huawei has always stood for quality and trust, and we\'re thrilled to partner with this platform to reinforce those values. The ownership verification system ensures that our customers receive genuine Huawei products. It\'s a reliable solution that adds a layer of confidence to our brand.',
            ],
        ];

        return view('livewire.frontend.pages.index', compact('pricings', 'services', 'faqs', 'testimonials'));
    }
}
