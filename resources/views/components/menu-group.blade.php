{{-- resources/views/components/menu-group.blade.php --}}
@props(['title', 'items', 'icon' => 'folder'])

<div class="menu-group" style="margin-bottom: 14px;">
    <div class="menu-group-title"
        style="display: flex; align-items: center; padding: 12px 20px; color: #fff; font-weight: 600; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 8px;">
        <i data-lucide="{{ $icon }}" style="width: 16px; height: 16px; margin-right: 8px; opacity: 0.8;"></i>
        {{ $title }}
    </div>
    <ul class="menu-group-list" style="list-style: none; padding: 0; margin-left:10px;">
        @foreach ($items as $item)
            @php
                $isActive = isset($item['highlight']) && $item['highlight'];
            @endphp
            <li style="margin-bottom: 2px;">
                <a href="{{ $item['href'] }}"
                    style="display: flex; align-items: center; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 6px; transition: all 0.3s ease; font-size: 14px; 
                    {{ $isActive ? 'background: #0b2545; font-weight: 600; border-left: 3px solid #3b82f6; box-shadow: 0 2px 4px rgba(0,0,0,0.1);' : 'opacity: 0.9; border-left: 3px solid transparent;' }}"
                    onmouseover="if (!{{ $isActive ? 'true' : 'false' }}) { this.style.backgroundColor='rgba(255,255,255,0.1)'; this.style.transform='translateX(4px)'; }"
                    onmouseout="this.style.backgroundColor='{{ $isActive ? '#0b2545' : 'transparent' }}'; this.style.transform='translateX(0)';">
                    @if (isset($item['icon']))
                        <i data-lucide="{{ $item['icon'] }}"
                            style="width: 16px; height: 16px; margin-right: 12px; opacity: {{ $isActive ? '1' : '0.8' }};"></i>
                    @endif
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
