<?php

namespace App\Http\Controllers;

use App\Services\RecentlyViewedProductService;
use Illuminate\Http\Request;

class RecentlyViewedProductController extends Controller
{

    private $recentlyViewedProductService;

    public function __construct(RecentlyViewedProductService $recentlyViewedProductService)
    {
        $this->recentlyViewedProductService = $recentlyViewedProductService;
    }

    public function list($userId)
    {
        $validator = \Illuminate\Support\Facades\Validator::make(['user_id' => $userId], [
            'user_id' => 'required|int|exists:users,id'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return response()->json($this->recentlyViewedProductService->getByUserId(intval($userId)));
    }

    public function save(Request $request, $userId)
    {
        $validator = \Illuminate\Support\Facades\Validator::make(
            ['user_id' => $userId, 'product_id' => $request->get('product_id', null)],
            [
                'user_id' => 'required|int|exists:users,id',
                'product_id' => 'required|int|exists:products,id'
            ]
        );

        if ($validator->fails()) {
            return $validator->errors();
        }

        $data = ['product_id' => $request->get('product_id'), 'user_id' => $userId];
        $product = $this->recentlyViewedProductService->save($data);
        return response()->json($product);
    }

    public function delete($userId, $productId)
    {
        $validator = \Illuminate\Support\Facades\Validator::make(
            ['user_id' => $userId, 'product_id' => $productId],
            [
                'user_id' => 'required|int|exists:users,id',
                'product_id' => 'required|int|exists:products,id'
            ]
        );

        if ($validator->fails()) {
            return $validator->errors();
        }

        $this->recentlyViewedProductService->delete($userId, $productId);
        
        return response('', 204);
    }
}
