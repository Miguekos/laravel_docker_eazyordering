<?php

namespace App\Http\Livewire;

use Auth;
use App\Models\User;
use App\Models\Product as ProductModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Product extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    protected $queryString = [
        'search' => ['except' => ''], 
        'perPage'  => ['except' => 100], 
    ];

    public $product, $code, $category, $family, $description_en, $description_es, $description_it, $unit_weight, $total_weight, $pieces, $uom, $pack_description, $photo, $stock, $availability, $availability_date, $unit_price, $total_price, $product_id, $excel, $warehouse_id, $path;

    public $categoriesOptions;
    public $familyOptions;
    public $packOptions;
    public $availabilityOptions;
    public $uomOptions;
    public $warehouses;
    
    public $search = '';
    public $perPage = 100;
    public $isOpen = false;
    public $isOpenImport = false;
    public $isOpenView = false;
    public $confirmingProductDeletion = false;

    public function mount()
    {        
        $this->categoriesOptions = ProductModel::getCategoriesArr();
        $this->familyOptions = ProductModel::getFamilyArr();
        $this->availabilityOptions = ProductModel::getAvailabilityArr();
        $this->uomOptions = ProductModel::getUOMArr();
        $this->packOptions = ProductModel::getPackArr();
        $this->warehouses = User::where('role_id', 2)->pluck('name', 'id')->toArray();     
    }

    public function render()
    {
        $products = ProductModel::where('description_en', 'LIKE', "%{$this->search}%")
            ->orWhere('description_es', 'LIKE', "%{$this->search}%")
            ->orWhere('description_it', 'LIKE', "%{$this->search}%")
            ->orWhere('total_price', 'LIKE', "%{$this->search}%")
            ->orWhere('category', 'LIKE', "%{$this->search}%")
            ->orWhere('family', 'LIKE', "%{$this->search}%")
            ->filterWarehouse()
            ->orderBy('code', 'asc')
            ->paginate($this->perPage);

        return view('livewire.product', [
            'products' => $products
        ]);
    }

    public function confirmProductAdd()
    {
        $this->resetInputFields();
        //$this->reset(['user']);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->authorize('create', Product::class);       
        $this->openModal();
    }

    public function confirmProductImport()
    {
        $this->resetInputFields();
        //$this->reset(['user']);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->authorize('create', Product::class);       
        $this->openModalImport();
    }

    public function confirmProductView($id)
    {
        $product = ProductModel::findOrFail($id);

        $this->product_id = $id;
        $this->warehouse_id = $product->warehouse->name;
        $this->code = $product->code;
        $this->category = $product->category;
        $this->family = $product->family;
        $this->description_en = $product->description_en;
        $this->description_es = $product->description_es;
        $this->description_it = $product->description_it;
        $this->unit_weight = $product->unit_weight;
        $this->total_weight = $product->total_weight;
        $this->pieces = $product->pieces;
        $this->uom = $product->uom;
        $this->pack_description = $product->pack_description;
        $this->photo = $product->photo;
        $this->stock = $product->stock;
        $this->availability = $product->availability;
        $this->availability_date = $product->availability_date;
        $this->unit_price = $product->unit_price;
        $this->total_price = $product->total_price;
    
        $this->openModalView();
    }

    public function confirmProductEdit($id)
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $product = ProductModel::findOrFail($id);
        $this->product_id = $id;
        $this->warehouse_id = $product->warehouse_id;
        $this->code = $product->code;
        $this->category = $product->category;
        $this->family = $product->family;
        $this->description_en = $product->description_en;
        $this->description_es = $product->description_es;
        $this->description_it = $product->description_it;
        $this->unit_weight = $product->unit_weight;
        $this->total_weight = $product->total_weight;
        $this->pieces = $product->pieces;
        $this->uom = $product->uom;
        $this->pack_description = $product->pack_description;
        $this->photo = $product->photo;
        $this->stock = $product->stock;
        $this->availability = $product->availability;
        $this->availability_date = $product->availability_date;
        $this->unit_price = $product->unit_price;
        $this->total_price = $product->total_price;

        $this->authorize('update', $product);
        $this->openModal();
    }

    public function confirmProductDeletion(Product $product)
    {
        //$this->authorize('delete', $product);

        $this->confirmingProductDeletion = $product->id;
    }

    public function store()
    {

        $this->validate([
            'code' => 'required',
            'description_en' => 'required',
            'total_price' => 'required',
        ]);

        // photo
        if (!empty($this->photo)) {
            $pathRelative = $this->photo->store('photos', 'public');
            $path = "storage/{$pathRelative}";
        }
   
        ProductModel::updateOrCreate(['id' => $this->product_id], [
            'code' => $this->code,
            'warehouse_id' => $this->warehouse_id,
            'category' => $this->category,
            'family' => $this->family,
            'description_en' => $this->description_en,
            'description_es' => $this->description_es,
            'description_it' => $this->description_it,
            'unit_weight' => $this->unit_weight,
            'total_weight' => $this->total_weight,
            'pieces' => $this->pieces,
            'uom' => $this->uom,
            'pack_description' => $this->pack_description,
            'photo' => isset($path) ? $path : '',
            'stock' => $this->stock,
            'availability' => $this->availability,
            'availability_date' => $this->availability_date,
            'unit_price' => $this->unit_price,
            'total_price' => $this->unit_price*$this->pieces
        ]);
  
        session()->flash('message', 
            $this->product_id ? 'Product Updated Successfully.' : 'Product Created Successfully.');
  
        $this->resetInputFields();
        //$this->reset(['product']);        
        $this->closeModal();
    }

    public function import()
    {
        $rules = [
            'excel' => 'required',
        ];

        if (Auth::user()->isAdmin()) {
            $rules['warehouse_id'] = 'required';
        }

        $this->validate($rules);

        $this->warehouse_id = Auth::user()->isWarehouse() ?  Auth::id() : (int)$this->warehouse_id;

        Excel::import(new ProductsImport($this->warehouse_id), $this->excel);
  
        $this->resetInputFields(); 
        session()->flash('message', 'Products Imported Successfully.');
  
        //$this->reset(['product']);     
        $this->closeModalImport();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function openModalImport()
    {
        $this->isOpenImport = true;
    }

    public function closeModalImport()
    {
        $this->isOpenImport = false;
    }

    public function openModalView()
    {
        $this->isOpenView = true;
    }

    public function closeModalView()
    {
        $this->isOpenView = false;
    }

    public function edit($id)
    {
        $product = ProductModel::findOrFail($id);
        $this->warehouse_id = $id;
        $this->product_id = $id;
        $this->code = $product->code;
        $this->category = $product->category;
        $this->family = $product->family;
        $this->description_en = $product->description_en;
        $this->description_es = $product->description_es;
        $this->description_it = $product->description_it;
        $this->unit_weight = $product->unit_weight;
        $this->total_weight = $product->total_weight;
        $this->pieces = $product->pieces;
        $this->uom = $product->uom;
        $this->pack_description = $product->pack_description;
        $this->photo = $product->photo;
        $this->stock = $product->stock;
        $this->availability = $product->availability;
        $this->availability_date = $product->availability_date;
        $this->unit_price = $product->unit_price;
        $this->total_price = $product->total_price;
    
        $this->openModal();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     */     
    public function delete($id)
    {
        Product::find($id)->delete();
        $this->confirmingProductDeletion = false;
        session()->flash('message', 'Product Deleted Successfully.');
    }

    public function resetModel()
    {
        $this->reset(['product']);
        $this->closeModal();
    }

    private function resetInputFields(){
        $this->warehouse_id = '';
        $this->code = '';
        $this->category = '';
        $this->family = '';
        $this->description_en = '';
        $this->description_es = '';
        $this->description_it = '';
        $this->unit_weight = '';
        $this->total_weight = '';
        $this->pieces = '';
        $this->uom = '';
        $this->pack_description = '';
        $this->photo = '';
        $this->stock = '';
        $this->availability = '';
        $this->availability_date = '';
        $this->unit_price = '';
        $this->total_price = '';
        $this->excel = '';
    }

    public function clear()
    {
        $this->search = '';
        $this->page = 1;
        $this->perPage = 100;
    }
}
