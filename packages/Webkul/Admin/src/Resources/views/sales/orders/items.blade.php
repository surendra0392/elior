<div class="flex flex-wrap items-center gap-2">
    @php
        $restCount = max($order->items->count() - 3, 0);
    @endphp

    @foreach ($order->items->take(3) as $item)
        <div class="relative group">
            <div class="relative h-12 w-12 overflow-hidden rounded-[10px] border border-slate-200/90 bg-white p-0.5 shadow-xs transition-transform group-hover:scale-105">
                @if ($item->product && $item->product->images->count() > 0)
                    <img 
                        class="h-full w-full rounded-[8px] object-cover" 
                        src="{{ $item->product->base_image_url }}"
                        alt="{{ $item->name }}"
                        title="{{ $item->name }} (Qty: {{ $item->qty_ordered }})"
                    >

                    <span class="absolute -bottom-0.5 -right-0.5 flex h-4 min-w-[16px] items-center justify-center rounded-full bg-[#205132] px-1 text-[10px] font-bold leading-none text-white shadow-xs">
                        {{ $item->qty_ordered }}
                    </span>
                @else
                    <div class="flex h-full w-full items-center justify-center rounded-[8px] bg-slate-50 text-slate-400">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                            <path d="m3.3 7 8.7 5 8.7-5"/>
                            <path d="M12 22V12"/>
                        </svg>
                    </div>

                    @if ($item->qty_ordered > 1)
                        <span class="absolute -bottom-0.5 -right-0.5 flex h-4 min-w-[16px] items-center justify-center rounded-full bg-slate-600 px-1 text-[10px] font-bold leading-none text-white shadow-xs">
                            {{ $item->qty_ordered }}
                        </span>
                    @endif
                @endif
            </div>
        </div>
    @endforeach

    @if ($restCount >= 1)
        <a 
            href="{{ route('admin.sales.orders.view', $order->id) }}"
            class="flex h-12 w-12 items-center justify-center rounded-[10px] border border-slate-200 bg-slate-50 text-xs font-bold text-slate-700 hover:bg-[#205132]/10 hover:text-[#205132] hover:border-[#205132]/30 transition-all shadow-xs"
            title="+{{ $restCount }} more items"
        >
            +{{ $restCount }}
        </a>
    @endif
</div>