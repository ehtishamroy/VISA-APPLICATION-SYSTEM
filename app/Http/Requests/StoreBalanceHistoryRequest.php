<?php

namespace App\Http\Requests;

use App\Models\BalanceHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBalanceHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('balance_history_create');
    }

    public function rules()
    {
        return [
            'amount' => [
                'numeric',
            ],
        ];
    }
}
