<?php
namespace App\Services\AffiliateLink;

use App\Helpers\AffiliateCodeHelper;
use App\Models\AffiliateLink;
class AffiliateLinkServices
{
    public function index()
    {
        $affiliates = AffiliateLink::all();

        return [
            'success' => true,
            'message' => 'Showing all model data',
            'status' => 200,
            'data' => [
                'AffiliateLink' => $affiliates
            ],
        ];
    }

    public function getMyAffiliateLinks($requestUser)
    {
        $myAffiliateLinks = AffiliateLink::where('affiliate_id', $requestUser->id)
            ->get();

        return [
            'success' => true,
            'message' => 'Showing all user affiliate links',
            'status' => 200,
            'data' => [
                'Affiliate Links' => $myAffiliateLinks,
            ],
        ];
    }

    public function store($requestUser, $validatedData): array
    {
        $affiliateLink = AffiliateLink::where('product_id', $validatedData['product_id'])
            ->where('affiliate_id', $requestUser->id)
            ->first();

        if ($affiliateLink) {
            return [
                'success' => false,
                'message' => 'You already have affiliated to this product',
                'status' => 400
            ];
        }

        $affiliateLink = AffiliateLink::create([
            'product_id' => $validatedData['product_id'],
            'affiliate_id' => $requestUser->id,
            'unique_code' => AffiliateCodeHelper::generate($requestUser->id, $validatedData['product_id']),
            'clicks' => 0
        ]);

        return [
            'success' => true,
            'message' => 'Affiliate Link created successfully',
            'status' => 201,
            'data' => [
                'Affiliate Link' => $affiliateLink,
            ],
        ];
    }

    public function destroy($validatedData)
    {

    }
}
