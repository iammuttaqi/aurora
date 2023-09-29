<section class="mx-auto max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14" id="pricing">
    <div class="mx-auto mb-10 max-w-2xl text-center lg:mb-14">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight">Pricing</h2>
        <p class="mt-1 text-gray-600">Whatever your status, our offers evolve according to your needs.</p>
    </div>

    <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4 lg:items-center">
        @foreach ($packages as $package)
            <livewire:frontend.components.pricing-card :package_id="$package->id" />
        @endforeach
    </div>

</section>
