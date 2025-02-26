<div class="mt-2 mb-3 d-flex flex-row flex-wrap">
    <div class="me-2">
        <a href="{{ route('products.index') }}" 
           class="btn {{ Route::currentRouteName() === 'products.index' ? 'btn-success' : 'btn-primary' }}">Все</a>
    </div>
    @foreach ($categories as $category)
        <div class="me-2">
            <a href="{{ route('products.category', $category->id) }}" 
               class="btn {{ Route::currentRouteName() === 'products.category' && request()->id == $category->id ? 'btn-success' : 'btn-primary' }}">
                {{ $category->name }}
            </a>
        </div>
    @endforeach
</div>

