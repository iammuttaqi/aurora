<?php

namespace App\Http\Livewire\Frontend\Components;

use Livewire\Component;

class FaqSection extends Component
{
    public function render()
    {
        $faqs = [
            [
                'title'   => 'What is the purpose of this platform?',
                'details' => 'Our platform is designed to connect Manufacturers, Shops, and Customers to efficiently manage and trade products. It provides a secure and transparent way to track product ownership, manage warranties, and facilitate product transactions.',
            ],
            [
                'title'   => 'Who can use this platform?',
                'details' => 'Manufacturers, Shops, and Customers can use this platform. Manufacturers can list their products, Shops can buy products from Manufacturers and sell them to other Shops or Customers, and Customers can purchase products.',
            ],
            [
                'title'   => 'How does product ownership work?',
                'details' => 'Product ownership can change through legitimate transactions on the platform. When a Shop or Customer purchases a product, ownership is transferred to them, and a record of ownership history is maintained.',
            ],
            [
                'title'   => 'What happens if I need support or have a problem with a transaction?',
                'details' => 'We have a dedicated support team to assist you. If you encounter any issues or have questions about transactions, product details, or warranties, please contact our support team for prompt assistance.',
            ],
            [
                'title'   => 'How are warranties handled?',
                'details' => 'Warranties are tied to products and calculated from the date of sale to the end customer. If you have a warranty claim, please reach out to the seller (Shop or Manufacturer) for assistance.',
            ],
            [
                'title'   => 'Is my personal information secure on this platform?',
                'details' => 'We take user privacy seriously. Please review our Privacy Policy for detailed information on how we collect, use, and protect your personal data. We implement security measures to keep your information safe.',
            ],
            [
                'title'   => 'Can I trust the ownership records on the platform?',
                'details' => 'Yes, ownership records are maintained securely and can be verified through QR codes on products. The platform ensures transparency and accuracy in tracking ownership changes.',
            ],
            [
                'title'   => 'How do I create an account?',
                'details' => 'To create an account, visit our registration page and follow the provided instructions. You will need to provide accurate information during the registration process.',
            ],
            [
                'title'   => 'Are there any fees for using the platform?',
                'details' => 'Our fee structure may vary depending on the type of user (Manufacturer, Shop, or Customer) and the services used. Please refer to our Pricing section for detailed information.',
            ],
            [
                'title'   => 'Can I sell products globally on this platform?',
                'details' => 'Yes, our platform is designed for global trade. Manufacturers and Shops can reach a broad audience and trade products internationally.',
            ],
            [
                'title'   => 'How can I verify a product?',
                'details' => 'To verify a product, use our QR code scanner. Scan the QR code on the product\'s label to access ownership history and warranty details, ensuring authenticity and transparency.',
            ],
            [
                'title'   => 'How often are the Terms and Conditions updated?',
                'details' => 'We may update the Terms and Conditions as needed. Users will be notified of any material changes. It\'s important to review the Terms periodically for updates.',
            ],
            [
                'title'   => 'What should I do if I forget my password?',
                'details' => 'If you forget your password, you can use the "Forgot Password" link on the login page to reset it. Follow the instructions sent to your registered email address.',
            ],
            [
                'title'   => 'How do I contact customer support?',
                'details' => 'You can contact our customer support team through the "Contact Us" page on the platform. We are here to assist you with any inquiries or issues you may have.',
            ],
        ];

        return view('livewire.frontend.components.faq-section', compact('faqs'));
    }
}
