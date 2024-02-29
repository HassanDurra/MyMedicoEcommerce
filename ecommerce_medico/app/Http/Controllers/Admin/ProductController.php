<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Product , ProductSubImages , Brands , Category , SubCategory };
class ProductController extends Controller
{
    public $parentModel = Product::class;
    public $childModel  = ProductSubImages::class;
    public $brand       = Brands::class;
    public $category    = Category::class;
    public $subcategory = SubCategory::class;
    // {Pages}
    public $parentView  = "Admin.Product";
    public $parentRoute = 'product';

    public function index(){
        $data['product'] = $this->parentModel::with('brand' , 'category' , 'subcategory')->withoutTrashed()->paginate(15);
        return view($this->parentView.'.index')->with('data' , $data);
    }
    public function trash(){
        $data['product'] = $this->parentModel::with('brand' , 'category' , 'subcategory')->onlyTrashed()->paginate(15);
        return view($this->parentView.'.trash')->with('data' , $data);
    }
    public function create($id=null){
        $data['product']     = $this->parentModel::where('id' , $id)->with('subcategory')->first();
        $data['brand']       = $this->brand::withoutTrashed()->get();
        $data['category']    = $this->category::withoutTrashed()->get();
        $data['action']      = $data['product'] != null ? 'edit' : 'create';
        return view($this->parentView.'.create')->with('data' , $data);
    }
    // Storing Data
    public function store(Request $request){
        $data = $request->except("_token");

        if($request->hasFile('image') && $request->hasFile("subimage")){
            $data['image'] =  time().".".$data['image']->getClientOriginalExtension();
            $request->file('image')->move("Admin/ProductImages/" , $data['image']);
            $storeProduct = $this->parentModel::create($data);
            if($storeProduct){

            foreach($data['subimage'] as $key => $value){
                $filename =  time().".".$request->file('subimage')[$key]->getClientOriginalExtension();
                $request->file('subimage')[$key]->move("Admin/ProductSubImages/" , $filename);
                   $storeSubImage = $this->childModel::create([
                    'product_id' => $storeProduct->id,
                    'subimage' => $filename
                   ]);
            }
            // return redirect()->route($this->parentRoute.'.index')->with('success' , 'Product has been Added..!');
            echo "success";
            }
            else{
               return redirect()->back()->with('error' , 'Failed to add Products..!');

            }
        }
        else{
        return redirect()->back()->with('error' , 'Failed to add Image or sub Images For Products..!');
        }
    }
    // //Update Function
    // public function update($id = null , Request $request){
    //     $data     = $request->except('_token');
    //     $products = $this->parentModel::where("id" , $id)->first();
    //     $updateProduct = $this->parentModel::where("id" , $id)->update($data);

    //     if($request->hasFile("image")){
    //         $fileName = time().'.'.$request->file("image")->getClientOriginalExtension();
    //         $request->file('image')->move("Admin/ProductImages/" , $fileName);
    //         $data['image'] = $fileName;
    //         $updateProduct = $this->parentModel::where("id" , $id)->update([
    //             'image' => $data['image']
    //         ]);
    //         $existingImage = public_path('Admin/ProductImages/'.$products->image);
    //         if(file_exists($existingImage)){
    //             unlink($existingImage);
    //         }

    //     }
    //     if($request->hasFile('subimage')){
    //         foreach($data['subimage'] as $key => $value){
    //             $filename =  time().".".$request->file('subimage')[$key]->getClientOriginalExtension();
    //             $request->file('subimage')[$key]->move("Admin/ProductSubImages/" , $filename);
    //                $storeSubImage = $this->childModel::create([
    //                 'product_id' => $id,
    //                 'subimage' => $filename
    //                ]);
    //         }
    //     }

    //     if($updateProduct){
    //         return redirect()->route($this->parentRoute.'.index')->with('success' , 'Product has been Updated..!');
    //     }
    //     else{
    //         return redirect()->back()->with('error' , 'Failed to Update Products..!');

    //     }

    // }
    // CasCading DropDown
    public function subcategory($id = null)
    {
        $subcategory   = $this->subcategory::withoutTrashed()->where("category_id" , $id)->get();
        if($subcategory){
            return response()->json($subcategory);
        }
        else{
            echo "No Data Found";
        }
    }
    // public function delete($id = null){
    //     $delete        = $this->parentModel::where('id' , $id)->delete();
    //     $changeStatus  = $this->parentModel::where('id' , $id)->update(['is_publised' => 0]);

    //     if($delete){
    //         return redirect()->route($this->parentRoute.'.index')->with('success' , 'Product Has been sent to trash..!');
    //     }
    //     else{
    //         return redirect()->back()->with('error' , 'Failed to Delete Product..!');
    //     }
    // }
    // public function restore($id = null){
    //     $delete  = $this->parentModel::where('id' , $id)->restore();
    //     if($delete){
    //         return redirect()->route($this->parentRoute.'.index')->with('success' , 'Product Has been Restored..!');
    //     }
    //     else{
    //         return redirect()->back()->with('error' , 'Failed to Restore Product..!');
    //     }
    // }
    // public function destroy($id = null){
    //     $delete  = $this->parentModel::where('id' , $id)->forceDelete();
    //     if($delete){
    //         return redirect()->route($this->parentRoute.'.index')->with('success' , 'Product Has been Deleted..!');
    //     }
    //     else{
    //         return redirect()->back()->with('error' , 'Failed to Delete Product..!');
    //     }
    // }
    // public function publish($id = null){
    //     $delete  = $this->parentModel::where('id' , $id)->update(['is_publised' => 1]);
    //     if($delete){
    //         return redirect()->route($this->parentRoute.'.index')->with('success' , 'Product Has been Published..!');
    //     }
    //     else{
    //         return redirect()->back()->with('error' , 'Failed to Publish Product..!');
    //     }
    // }

}
