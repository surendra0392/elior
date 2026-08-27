<div class="rounded-[14px] bg-white border border-slate-200 overflow-hidden">
    @for ($i = 1; $i <= 4; $i++)
        <div class="border-b border-slate-100 last:border-b-0 p-4 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3.5">
                <div class="shimmer h-12 w-12 rounded-[10px]"></div>

                <div class="flex flex-col gap-1.5">
                    <div class="shimmer h-4 w-32 rounded"></div>
                    <div class="shimmer h-3 w-20 rounded"></div>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <div class="flex flex-col items-end gap-1.5">
                    <div class="shimmer h-4 w-16 rounded"></div>
                    <div class="shimmer h-4 w-20 rounded-full"></div>
                </div>

                <div class="shimmer h-8 w-8 rounded-full"></div>
            </div>
        </div>
    @endfor
</div>