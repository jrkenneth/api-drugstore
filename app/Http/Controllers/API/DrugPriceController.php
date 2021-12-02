<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\DrugPrice;

class DrugPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = DrugPrice::all();
        $data = $prices->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Drug Prices Listed Successfully'
        ];
        
        return response()->json($response, 202);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input,
        [
            'drug_id'=>'required',
            'user_id'=>'required',
            'price'=>'required',
            'location'=>'required'
        ]);

        if ($validator->fails()){
            $response = [
                'success' => false,
                'data' => 'Validation Error',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        $drug_prices = DrugPrice::create($input);

        $data = $drug_prices->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Price Inserted Successfully'
        ];        
        return response()->json($response, 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $drug_price = DrugPrice::find($id);
        $data = $drug_price->toArray();

        if(is_null($drug_price)){
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'Price Not Found'
            ];
            return response()->json($response, 404);
        }else{
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Price Retrieved Successfully'
            ];
            return response()->json($response, 202);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
