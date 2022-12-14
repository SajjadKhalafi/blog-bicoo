<x-app-layout>
    <x-slot name="title">
        - صفحه اصلی
    </x-slot>
    <main>
        <article class="container article">
            <div class="articles">
                @forelse($posts as $post)
                    <div class="articles__item">
                        <a href="{{ route('post.show' , $post->slug) }}" class="articles__link">
                            <div class="articles__img">
                                <img src="{{ $post->getBannerUrl() }}" class="articles__img-src">
                            </div>
                            <div class="articles__title">
                                <h2>{{ $post->title }}</h2>
                            </div>
                            {{--                            <div class="articles__desc">--}}
                            {{--                                ساعاتی قبل شیائومی از جدیدترین ساعت هوشمند خود رونمایی کرد که قرار است با نام می واچ--}}
                            {{--                                لایت راهی--}}
                            {{--                                بازار ...--}}
                            {{--                                ساعاتی قبل شیائومی از جدیدترین ساعت هوشمند خود رونمایی کرد که قرار است با نام می واچ--}}
                            {{--                                لایت راهی--}}
                            {{--                                بازار ...--}}
                            {{--                            </div>--}}
                            <div class="articles__details">
                                <div class="articles__author">نویسنده :{{ $post->user->name }}</div>
                                <div class="articles__date">تاریخ : {{ $post->getCreatedAtInJalali() }}</div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="articles__item">
                        <h3>نتایج جستجو برای: "{{ request()->search ?? request()->category->name }}"</h3>
                        <p>این جستجو دارای ۰ نتیجه است.</p>
                    </div>
                @endforelse
            </div>
        </article>
        {{ $posts->appends(request()->query())->links() }}
    </main>
</x-app-layout>
