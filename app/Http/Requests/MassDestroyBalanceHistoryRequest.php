<?php

namespace App\Http\Requests;

use App\Models\BalanceHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBalanceHistoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('balance_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:balance_histories,id',
        ];
    }
}
