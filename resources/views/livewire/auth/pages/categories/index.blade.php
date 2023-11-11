@push('title', 'Categories')

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __('Categories') }}
    </h2>
</x-slot>

<div class="py-12" x-data="{
    modal: @entangle('modal'),
    modalCreate() {
        $wire.create();
    },
    modalEdit(id) {
        $wire.edit(id);
    },
}">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                    <caption class="bg-white p-5 text-left text-lg font-semibold text-gray-900 dark:bg-gray-800 dark:text-white">
                        <button class="rounded-lg bg-blue-700 px-3 py-2 text-center text-xs font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" x-on:click="modalCreate">Add Category</button>
                    </caption>

                    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3" scope="col">
                                Category Title
                            </th>
                            <th class="px-6 py-3" scope="col">
                                Slug
                            </th>
                            <th class="px-6 py-3" scope="col">
                                Number Of Partners
                            </th>
                            <th class="px-6 py-3" scope="col">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-900">
                                <th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white" scope="row">
                                    {{ $category->title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $category->slug }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $category->profiles_count }}
                                </td>
                                <td class="flex gap-2 px-6 py-4">
                                    <button class="font-medium text-blue-600 hover:underline dark:text-blue-500" type="button" x-on:click="modalEdit('{{ $category->id }}')">Edit</button>
                                    @can('delete', $category)
                                        <button class="font-medium text-red-600 hover:underline dark:text-red-500" type="button" x-on:click.prevent="if(confirm('Are You Sure?')) $wire.destroy('{{ $category->id }}');">Delete</button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->links('components.pagination') }}
            </div>

        </div>
    </div>

    <div aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 grid h-[calc(100%-1rem)] max-h-full w-full place-items-center overflow-y-auto overflow-x-hidden p-4 backdrop-brightness-50 md:inset-0" tabindex="-1" x-cloak x-show="modal" x-transition>
        <div class="relative max-h-full w-full max-w-md" x-on:click.outside="modal = false">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                <button class="absolute right-2.5 top-3 ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal" type="button" x-on:click="modal = false">
                    <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" fill-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <form class="space-y-6" wire:submit.prevent="{{ $submit }}">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white" for="title">Category
                                Title</label>
                            <input class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400" id="title" required type="text" wire:model="form.title">
                        </div>

                        <button class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">{{ $mode == 'create' ? 'Add Category' : 'Update Category' }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
