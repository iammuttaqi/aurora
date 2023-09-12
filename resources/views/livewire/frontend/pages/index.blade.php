@push('title', config('app.name'))

<div>
    <livewire:frontend.components.hero-section />
    <livewire:frontend.components.services-section lazy />
    <livewire:frontend.components.pricing-section lazy />
    <livewire:frontend.components.faq-section lazy />
    <livewire:frontend.components.testimonials-section lazy />
    <livewire:frontend.components.features-section lazy />
    <livewire:frontend.components.annoucement-section lazy />
    <livewire:frontend.components.clients-section lazy />
</div>
