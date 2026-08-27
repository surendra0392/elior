<div class="flex flex-col gap-3.5">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
        @for ($i = 0; $i < 3; $i++)
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

    <div class="rounded-[14px] bg-white border border-slate-200 overflow-hidden">
        @for ($i = 1; $i <= 4; $i++)
            <div class="border-b border-slate-100 last:border-b-0 p-4 flex items-center justify-between gap-4">
                <div class="flex flex-col gap-2 min-w-[140px]">
                    <div class="shimmer h-4 w-24 rounded"></div>
                    <div class="shimmer h-3 w-16 rounded"></div>
                </div>

                <div class="flex flex-col gap-2 min-w-[120px]">
                    <div class="shimmer h-4 w-20 rounded"></div>
                    <div class="shimmer h-3 w-14 rounded"></div>
                </div>

                <div class="flex flex-col gap-2 flex-1 min-w-[160px]">
                    <div class="shimmer h-4 w-28 rounded"></div>
                    <div class="shimmer h-3 w-36 rounded"></div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="shimmer h-10 w-10 rounded-[8px]"></div>
                    <div class="shimmer h-8 w-8 rounded-full"></div>
                </div>
            </div>
        @endfor
    </div>
</div>