<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //يعرض ليك فورم (form) باش تضيفي سبلايير جديد.
    public function addForm(){
        return view('suppliers.add');
    }
//يسجل سبلايير جديد في قاعدة البيانات.
    public function add(CustomerRequest $request){
        Supplier::create($request->validated());
        return redirect()
            ->route('suppliers')
            ->with('success', 'Supplier saved successfuly');
    }

    //يعرض فورم باش تعدلي سبلايير موجود.
    public function updateForm($id){
        $supplier = Supplier::find($id);
        return view('suppliers.update', compact('supplier'));
    }


    // كيدير تعديل لسبلايير فقاعدة البيانات
    public function update(CustomerRequest $request, $id){
        $supplier = Supplier::find($id);
        $supplier->update($request->validated());
        return redirect()
            ->route('suppliers')
            ->with('success', 'Supplier updated successfuly');
    }
//كيعرض ليك صفحة التأكيد باش تحيد سبلايير.
    public function deleteForm($id){
        $supplier = Supplier::find($id);
        return view('suppliers.delete', compact('supplier'));
    }
    //كيمسح السبلايير، ولكن قبل كيمسح المنتجات اللي مربوطة معاه.
    public function delete($id){
        Product::where('supplier_id',$id)->delete();
        Supplier::find($id)->delete();

        return redirect()
            ->route('suppliers')
            ->with('success', 'Supplier deleted successfully');
    }
}
