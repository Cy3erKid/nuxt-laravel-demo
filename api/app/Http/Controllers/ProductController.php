<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    //

    public function index(Request $request){

        if($request->q || $request->orderBy || $request->sortType)
        {
            $products = Product::where('name','like','%'.$request->q.'%')
            ->orderBy($request->orderBy,$request->sortType)
            ->paginate(10);
        }else{
            $products = Product::paginate(10);
        }
        return response()->json($products);
    }

    public function export(){
        return Excel::download(new ProductExport,'product.xlsx');
    }
}
