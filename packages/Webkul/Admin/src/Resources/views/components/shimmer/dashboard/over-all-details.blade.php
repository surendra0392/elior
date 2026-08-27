<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3.5">
    @for ($i = 0; $i < 5; $i++)
        <div class="rounded-[14px] bg-white border border-slate-200 p-4 flex flex-col justify-between h-[105px]">
            <div class="flex items-center justify-between">
                <div class="shimmer h-3 w-20 rounded"></div>
                <div class="shimmer h-8 w-8 rounded-[10px]"></div>
            </div>

            <div class="flex items-baseline justify-between mt-auto">
                <div class="shimmer h-6 w-24 rounded"></div>
                <div class="shimmer h-4 w-12 rounded-full"></div>
            </div>
        </div>
    @endfor
</div>