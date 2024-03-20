<x-app-layout meta-title="Blogs Application - Home">
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">

        @forelse($posts as $post)
            <x-posts.post-item :post="$post"></x-posts.post-item>

        @empty
            NO Posts Yet . . . . ..
        @endforelse


        <!-- Pagination -->
            {{$posts->links()}}

    </section>
    <x-layouts.sidebar/>
</x-app-layout>
