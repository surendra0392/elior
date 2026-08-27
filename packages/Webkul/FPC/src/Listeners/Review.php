<?php

namespace Webkul\FPC\Listeners;

use Spatie\ResponseCache\Facades\ResponseCache;
use Webkul\Product\Repositories\ProductReviewRepository;

class Review
{
    /**
     * Create a new listener instance.
     *
     * @return void
     */
    public function __construct(protected ProductReviewRepository $productReviewRepository) {}

    /**
     * After review is updated
     *
     * @param  \Webkul\Product\Contracts\Review  $review
     * @return void
     */
    public function afterUpdate($review)
    {
        $urls = app(\Webkul\FPC\Listeners\Product::class)->getForgettableUrls($review->product);

        \Spatie\ResponseCache\Facades\ResponseCache::forget($urls);
    }

    /**
     * Before review is deleted
     *
     * @param  int  $reviewId
     * @return void
     */
    public function beforeDelete($reviewId)
    {
        $review = $this->productReviewRepository->find($reviewId);

        $urls = app(\Webkul\FPC\Listeners\Product::class)->getForgettableUrls($review->product);

        \Spatie\ResponseCache\Facades\ResponseCache::forget($urls);
    }
}
