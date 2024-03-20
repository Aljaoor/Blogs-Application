<x-app-layout meta-title="Blog Application - About us" meta-description="this is personal blogs appliaction about coding ">

    <div class="container mx-auto flex flex-wrap py-6 items-center">

        <!-- Post Section -->
        <section class="w-full md:w-full flex flex-col items-center px-3">

            <article class="flex flex-col shadow my-4">
                    @if($widget && $widget->image)
                        <img src="{{ $widget->getImage() }}">
                    @endif


                <div class="bg-white flex flex-col justify-start p-6">
                    <h1 class="text-3xl font-bold hover:text-gray-700 pb-4">
                        {{$widget ? $widget->title : ''}}
                    </h1>
                    <div>
                        {!! $widget ? $widget->content : '' !!}
                    </div>
                </div>
            </article>
        </section>

    </div>
</x-app-layout>
