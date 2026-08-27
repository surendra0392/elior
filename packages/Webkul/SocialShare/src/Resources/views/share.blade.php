@if (core()->getConfigData('catalog.products.social_share.enabled'))
    @php
        $message = core()->getConfigData('catalog.products.social_share.share_message');
    @endphp

    <div class="pt-2 flex items-center gap-3">
        {!! view_render_event('bagisto.shop.products.view.share.before', ['product' => $product]) !!}

        <!-- Subtle Botanical Share Label -->
        <div class="flex items-center gap-1.5 text-[11px] font-semibold uppercase tracking-[0.14em] text-elior-muted select-none">
            <span class="material-symbols-outlined text-sm text-elior-botanical align-middle" style="font-size: 15px;">share</span>
            <span>@lang('admin::app.configuration.index.catalog.products.social-share.share')</span>
        </div>

        <!-- Social Share Icons List -->
        <div>
            <ul class="flex items-center gap-2">
                @foreach(['facebook', 'twitter', 'pinterest', 'linkedin', 'whatsapp', 'email'] as $social)
                    @if (! core()->getConfigData('catalog.products.social_share.' . $social))
                        @continue
                    @endif

                    @include('social_share::links.' . $social , compact('product', 'message'))
                @endforeach
            </ul>
        </div>

        {!! view_render_event('bagisto.shop.products.view.share.after', ['product' => $product]) !!}
    </div>

    @push('scripts')
        <script>
            function shareProduct() {
                let productName = "{{ $product->name }}";
                let productUrl = "{{ route('shop.product_or_category.index', [$product->url_key]) }}";

                if (navigator.share) {
                    navigator.share({
                        title: productName,
                        text: productName + ' ' + productUrl,
                        url: productUrl
                    })
                    .catch((error) => console.error('Error sharing:', error));
                } else {
                    alert('Your browser does not support sharing.');
                }
            }
        </script>    
    @endpush
@endif
