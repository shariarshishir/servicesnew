<?php

namespace App\Http\Requests;

use App\Rules\MoqUnitRule;
use Illuminate\Http\Request;
use App\Rules\ReadyStockFullStockRule;
use App\Rules\NonClothingFullStockRule;
use App\Rules\ReadyStockPriceBreakDownRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NonClothingPriceBreakDownRule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'business_profile_id' => 'required',
            'name'      => 'required',
            'product_tag' => 'required',
            'product_type' => 'required',
            'product_type_mapping' => 'required',
            'studio_id'         => 'required_if:product_type_mapping,1',
            'raw_materials_id'  => 'required_if:product_type_mapping,2',
            'moq'         => [new MoqUnitRule($request, $request->product_type)],
            'lead_time'   => 'required_if:product_type,4',
            'price_range'   => 'required_if:product_type,4',
            'qty_unit'  => 'required',
            'price_unit'  => 'required',
            'gender' => 'required',
            'sample_availability' => 'required',
            'description'  => 'required',

            'ready_stock_availability'  => 'required_if:product_type,2',
            'non_clothing_availability'  => 'required_if:product_type,3',
            'quantity_min.*' => 'required_if:product_type,1',
            'quantity_max.*' => 'required_if:product_type,1',
            'price.*' => 'required_if:product_type,1',
            'lead_time.*' => 'required_if:product_type,1',
            'ready_quantity_min.*' => [new ReadyStockPriceBreakDownRule($request, $request->product_type)],
            'ready_quantity_max.*' => [new ReadyStockPriceBreakDownRule($request, $request->product_type)],
            'ready_price.*' => [new ReadyStockPriceBreakDownRule($request, $request->product_type)],
            'non_clothing_min.*' => [new NonClothingPriceBreakDownRule($request, $request->product_type)],
            'non_clothing_max.*' => [new NonClothingPriceBreakDownRule($request, $request->product_type)],
            'non_clothing_price.*' => [new NonClothingPriceBreakDownRule($request, $request->product_type)],
            'full_stock_price' => [new ReadyStockFullStockRule($request, $request->product_type)],
            'non_clothing_full_stock_price' => [new NonClothingFullStockRule($request, $request->product_type)],
            // 'images'  => 'required',
            // 'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,JPEG,PNG,JPG,GIF,SVG|max:25600',
            // 'overlay_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,JPEG,PNG,JPG,GIF,SVG|max:25600',
            // 'video' => 'mimes:mp4,3gp,mkv,mov|max:150000',

        ];
    }
    public function messages()
    {
        return [
            'non_clothing_availability.required_if' => 'The  availability field is required when product type is Non Clothing.',
            'ready_stock_availability.required_if' => 'The  availability field is required when product type is Ready Stock.',
            'quantity_min.*.required_if' => 'the :attribute are required',
            'quantity_max.*.required_if' => 'the :attribute are required',
            'price.*.required_if' => 'the :attribute are required',
            'lead_time.*.required_if' => 'the :attribute are required',
            'studio_id.required_if' => 'the studio type is required when studio selected',
            'raw_materials_id.required_if' => 'the raw materials type is required when raw materials selected',
            'lead_time.required_if' => 'lead time requird',
            'price_range.required_if' => 'price range requird',
        ];
    }
}
