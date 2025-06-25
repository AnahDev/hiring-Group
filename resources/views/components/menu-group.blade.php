{{-- resources/views/components/menu-group.blade.php --}}
@props(['title', 'items', 'open' => false])

<div class="menu-group">
    {{-- <input type="checkbox" id="group-{{ Str::slug($title) }}" class="menu-group-toggle" {{ $open ? 'checked' : '' }}> --}}
    <label for="group-{{ Str::slug($title) }}" class="menu-group-title">{{ $title }}</label>
    <ul class="menu-group-list" style="list-style: none; padding: 6px; margin: 6px;">
        @foreach ($items as $item)
            <li>
                <a href="{{ $item['href'] }}"
                    style="color:#fff;  text-decoration:none; {{ isset($item['highlight']) && $item['highlight'] ? 'font-weight:bold;background:#0b2545;' : '' }}">
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
