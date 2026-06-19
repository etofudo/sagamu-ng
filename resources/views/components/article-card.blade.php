@props(['article'])

<div class="article-card">
    <a href="{{ route('article.show', $article->slug) }}">
        <img src="{{ $article->hero_image ?? asset('images/blog (1).jpg') }}" alt="{{ $article->title }}" />
    </a>
    <div class="article-card__body">
        @if($article->kicker)
            <span class="article-card__kicker">{{ $article->kicker }}</span>
        @endif
        <h3 class="article-card__title">
            <a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a>
        </h3>
        @if($article->excerpt)
            <p class="article-card__excerpt">{{ Str::limit($article->excerpt, 90) }}</p>
        @endif
        <a href="{{ route('article.show', $article->slug) }}" class="article-card__cta">Read more &rarr;</a>
    </div>
</div>
