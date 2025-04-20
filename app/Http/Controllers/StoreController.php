<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Store::orderBy('id', 'desc')->paginate(5);
        return view("index", compact("data"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        // Convert Bangla numbers to English before validation
        // $request->merge([
        //     'number' => $this->convert($request->input('number'))
        // ]);
        
        $data = $request->validate([
            "name" => "required|string",
            "number" => "required|numeric|digits:11|starts_with:01|unique:stores,number"
        ]);
        
        Store::create($data);
        flash()->success($data['number']." Added successfully!");
        return redirect()->route('index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Store::findOrFail($id);
        // dd($data);
        return view("edit", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Convert Bangla numbers to English before validation
        // $request->merge([
        //     'number' => $this->convert($request->input('number'))
        // ]);
        
        
        $data = $request->validate([
            "name" => "required|string",
            "number" => "required|numeric|digits:11|starts_with:01|unique:stores,number"
        ]);
        
        Store::findOrFail($id)->update($data);
        flash()->success($data['number']." Updated successfully!");
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Store::destroy($id);
        flash()->success("Deleted successfully!");
        return redirect()->route('index');
    }
    
    // private function convert($number)
    // {
    //     $banglaDigits = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    //     $englishDigits = ['0','1','2','3','4','5','6','7','8','9'];
    //     return str_replace($banglaDigits, $englishDigits, $number);
    // }
}
