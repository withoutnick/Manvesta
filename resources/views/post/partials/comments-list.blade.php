<section id="comments">

    <div class="max-w-3xl text-lg mx-auto pb-10 px-4 sm:px-6 lg:px-8">
        
        <head>
            <h2 class="font-bold text-3xl mt-10 mb-10">
                {{ __('Comments') }}
            </h2>
        </head>

        <body>

            @if($comments->isNotEmpty())
                @foreach($comments as $comment)
                    @include('post.partials.single-comment')
                @endforeach
            @endif

            @if(Auth::check())
                <h2 class="font-bold text-3xl mt-20 mb-5">{{ __('Leave a Comment') }}</h2>
                @include('post.partials.comment-form')
            @else
                <div class="mt-8">
                    {{ __('Only registered users can comment our posts. Please sign-in to express your mind!') }}
                </div>
            @endif

        </body>

    </div>

</section>