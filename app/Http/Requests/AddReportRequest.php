<?php

namespace App\Http\Requests;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AddReportRequest
 * @package App\Http\Requests
 * @property UploadedFile $report
 */
class AddReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return (bool)\auth()->user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'report' => 'file|required|mimes:jpeg,bmp,png,xls,xlsx,pdf,doc,dox'
        ];
    }
}
