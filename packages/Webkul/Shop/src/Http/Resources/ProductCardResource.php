<?php

namespace Webkul\Shop\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Webkul\Product\Helpers\Review;

class ProductCardResource extends JsonResource
{
    /**
     * Review helper instance.
     *
     * @var Review
     */
    protected $reviewHelper;

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource)
    {
        $this->reviewHelper = app(Review::class);

        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * This is a slim variant of {@see ProductResource} used for product
     * listings and carousels. The heavy `description` field and the full
     * `images` gallery are intentionally omitted - the product card never
     * renders them - which keeps listing payloads small and avoids
     * generating cached gallery image URLs for every product.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $productTypeInstance = $this->getTypeInstance();
        $haveDiscount = (bool) $productTypeInstance->haveDiscount();
        $minimalPrice = $productTypeInstance->getMinimalPrice();
        $regularPrice = $productTypeInstance->getRegularMinimalPrice();

        $weight = (float) ($this->weight ?? 0);
        $formattedWeight = null;
        if ($weight > 0) {
            $unit = core()->getConfigData('general.general.locale_options.weight_unit') ?: 'kgs';
            if ($unit === 'lbs') {
                $formattedWeight = ((float) $weight) . ' lbs Net Wt';
            } elseif ($unit === 'grams') {
                $formattedWeight = ($weight < 1 ? ((int) round($weight * 1000)) : ((float) $weight)) . 'g Net Wt';
            } else {
                $formattedWeight = $weight < 1 ? ((int) round($weight * 1000)) . 'g Net Wt' : ((float) $weight) . 'kg Net Wt';
            }
        }

        $discountPercent = 0;
        if ($haveDiscount && $regularPrice > 0 && $regularPrice > $minimalPrice) {
            $discountPercent = (int) round((($regularPrice - $minimalPrice) / $regularPrice) * 100);
        }

        $firstCategory = $this->categories->where('id', '!=', 1)->first() ?? $this->categories->first();
        $categoryName = $firstCategory?->name ?? null;

        return [
            'id'               => $this->id,
            'sku'              => $this->sku,
            'name'             => $this->name,
            'url_key'          => $this->url_key,
            'category_name'    => $categoryName,
            'base_image'       => product_image()->getProductBaseImage($this),
            'gallery_images'   => product_image()->getGalleryImages($this),
            'weight'           => $weight,
            'formatted_weight' => $formattedWeight,
            'is_new'           => (bool) $this->new,
            'is_featured'      => (bool) $this->featured,
            'on_sale'          => $haveDiscount,
            'is_saleable'      => (bool) $productTypeInstance->isSaleable(),
            'is_wishlist'      => (bool) auth()->guard()->user()?->wishlist_items
                ->where('channel_id', core()->getCurrentChannel()->id)
                ->where('product_id', $this->id)->count(),
            'min_price'        => core()->formatPrice($minimalPrice),
            'regular_price'    => core()->currency($regularPrice),
            'special_price'    => $haveDiscount ? core()->currency($minimalPrice) : null,
            'discount_percent' => $discountPercent,
            'price_html'       => $productTypeInstance->getPriceHtml(),
            'short_description'=> strip_tags($this->short_description ?? ''),
            'ratings'          => [
                'average' => $this->reviewHelper->getAverageRating($this),
                'total'   => $this->reviewHelper->getTotalRating($this),
            ],
            'reviews'          => [
                'total'   => $this->reviewHelper->getTotalReviews($this),
            ],
        ];
    }
}
