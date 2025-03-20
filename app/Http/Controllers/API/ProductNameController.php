<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductNameController extends Controller
{
    public function view(Request $req)
    {
        $search = $req->input('search', ''); // Get search parameter

        if (!empty($search)) {
            // Search products by Title (partial match) or Function (exact match)
            $products = Product::where('Title', 'LIKE', '%' . $search . '%')
                ->orWhere('Function', $search)
                ->orderBy('Title', 'ASC')
                ->select('Title', 'MRP') // Fetch both Title and MRP
                ->get();
        } else {
            // Fetch all product names and their MRP sorted alphabetically
            $products = Product::orderBy('Title', 'ASC')
                ->select('Title', 'MRP') // Fetch both fields
                ->get();
        }

        return response()->json([
            'success' => true,
            'message' => 'Product names and MRP retrieved successfully',
            'data' => $products,
        ], 200);
    }

}
