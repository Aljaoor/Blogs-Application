<div>
    <article class="bg-white flex flex-col shadow my-4">
        <!-- Article Image -->
        <a href="{{route('view',$post)}}" class="hover:opacity-75">
            <img src="{{$post->image}}">
        </a>
        <div class="bg-white flex flex-col justify-start p-6">
            <div class="flex gap-4 justify-between">
                <div>
                    @forelse($post->categories as $category)
                        <a href="#" class="text-blue-700 text-sm font-bold uppercase mr-3 mb-4">{{$category->name}}</a>
                    @empty
                        <a href="#" class="text-blue-700 text-sm font-bold uppercase mr-2">This post doesn't have categories yet</a>
                    @endforelse
                </div>
                <div>
                    @forelse($post->tags as $tag)
                        <a href="#" class="text-blue-700 text-sm font-bold uppercase mr-3 mb-4">#{{$tag->name}}</a>
                    @empty
                        <a href="#" class="text-blue-700 text-sm font-bold uppercase mr-2">This post doesn't have tags yet</a>
                    @endforelse
                </div>
            </div>
            <a href="{{route('view',$post)}}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$post->title}}</a>
            <p href="#" class="text-sm pb-3">
                By <a href="#" class="font-semibold hover:text-gray-800">{{$post->author->name}}</a>, Published on {{\Carbon\Carbon::parse($post->published_at)->format('F jS Y')}}
            </p>
            <a href="{{route('view',$post)}}" class="pb-6">{{$post->shortBody()}}..</a>
            <a href="{{route('view',$post)}}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
        </div>
    </article>
</div>
