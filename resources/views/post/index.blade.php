<x-app-layout :meta-title="'TheCodeholic Blog - ' . $title"
              :meta-description="'Posts filtered by category or tag ' .  $title">
    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Posts Section -->
        <section class="w-full md:w-2/3  px-3">
            <div class=" flex flex-col items-center">
                @foreach($posts as $post)
                    <x-posts.post-item :post="$post"/>
                @endforeach
            </div>
            {{ $posts->links() }}
        </section>

        <!-- Sidebar Section -->
        <x-layouts.sidebar/>

    </div>
</x-app-layout>
