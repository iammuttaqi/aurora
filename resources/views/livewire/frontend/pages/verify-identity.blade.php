@push('title', 'Verification')

<div class="min-h-screen bg-gray-100">
    <div class="mx-auto max-w-4xl p-8">
        @if ($profile)
            <div class="rounded-lg bg-white p-6 shadow-lg">
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-900">Verification</h1>
                    <p class="text-lg text-gray-600">Verify the authenticity of this company</p>
                </div>

                <hr class="my-6 border-t-2 border-gray-300">

                <!-- Company Name and Verification Status -->
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="text-2xl font-semibold">{{ $profile->name }}</h2>
                    <span class="rounded-full bg-green-500 px-5 py-1 text-white">Verified</span>
                </div>

                <!-- Company Information -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold">Information</h2>
                    <p><strong>Location:</strong> {{ $profile->address }}</p>
                    <p><strong>Contact:</strong> {{ $profile->contact_number_1 }}</p>
                    <p><strong>Description:</strong> Brief Description of Services/Products</p>
                </div>

                <!-- Contact Information -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold">Contact Information</h2>
                    <p><strong>Contact Person:</strong> {{ $profile->contact_person }}</p>
                    <p><strong>Email: </strong>
                    <ul class="list-disc pl-5">
                        <li>{{ $profile->email_1 }}</li>
                        <li>{{ $profile->email_2 }}</li>
                        <li>{{ $profile->email_3 }}</li>
                    </ul>
                    </p>

                    <p><strong>Phone: </strong>
                    <ul class="list-disc pl-5">
                        <li>{{ $profile->contact_number_1 }}</li>
                        <li>{{ $profile->contact_number_2 }}</li>
                        <li>{{ $profile->contact_number_3 }}</li>
                    </ul>
                    </p>
                </div>

                <!-- Explanation of Verification Process -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold">Verification Process</h2>
                    <p>
                        This company has successfully completed a verification process to ensure its authenticity. The information displayed here is accurate to the best of our knowledge.
                    </p>
                </div>

                <!-- Legal Disclaimers -->
                <div class="mb-6">
                    <p class="text-sm italic text-gray-600">
                        Legal disclaimers or terms and conditions related to the verification process can be found on our website.
                    </p>
                </div>

                <!-- Help/Support Links -->
                <div class="mb-6">
                    <p>For assistance or reporting issues, please contact:</p>
                    <p><strong>Email:</strong> {{ config('mail.from.address') }}</p>
                </div>

                <!-- FAQ Section (Optional) -->
                <details class="mb-6">
                    <summary class="cursor-pointer text-blue-600">Frequently Asked Questions</summary>
                    <div class="mt-2">
                        <!-- Include your FAQ items here -->
                        <p><strong>Question:</strong> How can I verify a product?</p>
                        <p><strong>Answer:</strong> To verify a product, follow these steps...</p>
                        <ul class="list-disc pl-5">
                            <li>Use a QR code scanning app on your smartphone or mobile device.</li>
                            <li>Point your device's camera at the QR code on the product label.</li>
                            <li>After scanning the QR code, your device will display a link or URL.</li>
                            <li>Tap on the link to open it in your web browser.</li>
                        </ul>
                    </div>
                </details>
            </div>
        @else
            <div class="rounded-lg bg-white p-6 shadow-lg">
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-900">Verification</h1>
                    <p class="text-lg text-red-500">The Manufacturer/Shop you are looking for doesn't exist.<br>or the QR code is invalid</p>
                </div>
            </div>
        @endif
    </div>
</div>
