<?php

namespace App\Services\Sell;

use App\DTOs\SellSaveDTO;
use App\Models\BaseModel;
use App\Models\Sell;
use App\Repositories\ProductSellRepository;
use App\Repositories\SellRepository;
use Illuminate\Support\Arr;

readonly class SellSaveService
{
    public function __construct(
        private SellRepository        $repository,
        private ProductSellRepository $productSellRepository
    )
    {
    }

    public function execute(SellSaveDTO $data, Sell $sell = null): BaseModel|Sell
    {
        $sell = $this->repository->storeOrUpdate(
            ['id' => Arr::get($sell, 'id', 0)],
            $data->toArray()
        );

        if (!isset($sell->id)) {
            throw new \Error('failed to store sell');
        }

        $tempDetails = $data->details;

        foreach ($tempDetails as $key => $detail) {
            $tempDetails[$key]['sell_id'] = $sell->id;
        }

        $details = array_map(fn($detail) => $this->productSellRepository->store($detail), $tempDetails);
        $sell['details'] = $details;
        return $sell;
    }
}

