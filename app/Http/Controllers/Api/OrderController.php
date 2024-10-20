<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\{FilterRequest, CreateRequest, DeleteRequest, UpdateRequest};
use App\Jobs\Order\OrderStatusUpdatedJob;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService) {
        $this->orderService = $orderService;
    }

    public function index(FilterRequest $request) {
        $orders = $this->orderService->index()
            ->where('user_id', Auth::user()->id)
            ->where(function ($q) use ($request) {
                if (!empty($request->product_name)) {
                    $q->where('product_name', 'like', '%' . $request->product_name . '%');
                }
                if (!empty($request->amount)) {
                    $q->where('amount', $request->amount);
                }
                if (!empty($request->status)) {
                    $q->whereIn('status', $request->status);
                }
            })
            ->orderBy($request->sortBy['key'] ?? 'id', $request->sortBy['by'] ?? 'asc')
            ->paginate($request->count_items ?? 10);

        return response()->json(['orders' => $orders], 200);
    }

    public function create(CreateRequest $request) {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $order = $this->orderService->create($data);

        return response()->json(['order' => $order], 201);
    }

    public function update(UpdateRequest $request) {
        $data = $request->validated();

        $order = $this->orderService->getById($data['id']);

        $updated_order = $this->orderService->update($data['id'], $data);

        if ($request->status != $order->status) {
            OrderStatusUpdatedJob::dispatch($updated_order);
        }

        return response()->json(['order' => $updated_order], 200);
    }

    public function delete(DeleteRequest $request) {
        $this->orderService->delete($request->id);

        return response()->json(['status' => true], 200);
    }
}
