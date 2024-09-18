<!-- header.blade.php -->

<a href="{{ route('wishlist') }}" class="wishlist-link">
    <i class="icon-heart-o"></i>
    <span class="wishlist-count">
        @livewire('header')
    </span>
    <span class="wishlist-txt">قائمة الأمنيات</span>
</a>
