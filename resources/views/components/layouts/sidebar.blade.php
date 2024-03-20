<aside class="w-full md:w-1/3 flex flex-col items-center px-3">
    <div class="w-full bg-white shadow flex flex-col my-4 p-6">
        <p class="text-xl font-semibold pb-5 uppercase">{{ \App\Models\TextWidget::getTitle('about-me') }}</p>
        <p class="pb-2">{!! \App\Models\TextWidget::getContent('about-me') !!}</p>
        <a href="{{route('about')}}"
           class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
            Get to know us
        </a>
    </div>
    <div class="w-full bg-white shadow flex flex-col my-4 p-6">
        <h3 class="text-xl font-semibold mb-3">All Tags
        </h3>
        @foreach($tags as $tag)
            <a href="{{route('by-tag', $tag)}}"
               class="text-semibold block py-2 px-3 rounded {{ request('tag')?->name === $tag->name
                ? 'bg-blue-600 text-white' :  ''}}">
                {{$tag->name}} ({{$tag->total}})
            </a>
        @endforeach
    </div>
    <div class="w-full bg-white shadow flex flex-col my-4 p-6">
        <h3 class="text-xl font-semibold mb-3">All Categories
        </h3>
        @foreach($categories as $category)
            <a href="{{route('by-category', $category)}}"
               class="text-semibold block py-2 px-3 rounded {{ request('category')?->name === $category->name
                ? 'bg-blue-600 text-white' :  ''}}">
                {{$category->name}} ({{$category->total}})
            </a>
        @endforeach
    </div>
</aside>
