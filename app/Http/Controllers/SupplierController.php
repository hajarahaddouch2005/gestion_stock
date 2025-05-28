<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function addForm(){
        return view('suppliers.add');
    }

    public function add(CustomerRequest $request){
        Supplier::create($request->validated());
        return redirect()
            ->route('suppliers')
            ->with('success', 'Supplier saved successfuly');
    }

    public function updateForm($id){
        $supplier = Supplier::find($id);
        return view('suppliers.update', compact('supplier'));
    }

    public function update(CustomerRequest $request, $id){
        $supplier = Supplier::find($id);
        $supplier->update($request->validated());
        return redirect()
            ->route('suppliers')
            ->with('success', 'Supplier updated successfuly');
    }

    public function deleteForm($id){
        $supplier = Supplier::find($id);
        return view('suppliers.delete', compact('supplier'));
    }
    public function delete($id){
        Product::where('supplier_id',$id)->delete();
        Supplier::find($id)->delete();

        return redirect()
            ->route('suppliers')
            ->with('success', 'Supplier deleted successfully');
    }
}
