<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Tag;
use App\Models\WishlistProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public $hasCategory;
    public $category;
    public $categories;
    public $icon;
    public $background;
    public $search;
    public $tag;
    public $tags;
    public $price;
    public $mainCategories;


    public function mount($slug = null)
    {
        $this->mainCategories = Category::where('parent_category_id', null)->where('is_active', 1)->get();
        $tagId = request()->query('tagId');
        $search = request()->query('search');
        $this->tags = Tag::all();
        if ($slug) {
            $this->setCategory($slug);
        }
        if ($search){
            $this->search = $search;
        }
        if ($tagId){
            $this->setTag($tagId);
        }
    }

    public function gotoPage($page)
    {
//        $this->dispatchBrowserEvent('urlChanged', ['url' => $this->category->slug ?? '' . "?page=" . $page]);
        $this->setPage($page);
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setCategory($slug, $mount = 0)
    {
        if (!request()->query('page')){
            $this->resetPage();
        }
        $this->hasCategory = ($this->category) ? $slug : 'category/'.$slug;

        $this->category = Category::with('images')->where('slug', $slug)->firstOrFail();

        $this->dispatchBrowserEvent('metaChanged', [
            'title' => 'Lumen Lux | ' . $this->category->title,
            'description' => $this->category->seo_description ?? 'Бра, споты, трековые системы, Проектирование и светорасчет, Бесплатная доставка, Гарантия качества до 5 лет',
            'keywords' => $this->category->seo_title.' '.$this->category->seo_description // Assuming you have seo_keywords
        ]);
        if (!$mount){
            $this->dispatchBrowserEvent('urlChanged', ['url' => $this->hasCategory]);
        }
        $this->tag = null;
        $this->search = null;
    }

    public function setTag($id)
    {
        $this->resetPage();
        $this->tag = Tag::find($id);
        if ($this->category){
            $this->dispatchBrowserEvent('urlChanged', ['url' => $this->category->slug.'?tagId='.$id]);
        } else{
            $this->dispatchBrowserEvent('urlChanged', ['url' => '?tagId='.$id]);
        }
    }

    public function render()
    {
        $products = Product::where('status', '!=', 0);

        if ($this->category) {
            $products->whereHas('categories', function ($query) {
                $query->where('categories.id', $this->category->id);
            });
        }

        if ($this->tag) {
            $products->whereHas('tags', function ($query) {
                $query->where('tags.id', $this->tag->id);
            });
        }

        if ($this->search) {
            $products->where(function ($query) {
                $query->where('title', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('short_description', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('long_description', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('price', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('discount_price', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('additional', 'LIKE', '%' . $this->search . '%');
            });
        }

        $products = $products->orderBy('created_at', 'desc')->paginate(12);
//        if ($this->category && $this->tag === null) {
//            $products = $this->category->products();
//        } else if ($this->tag && $this->category) {
//            $tagId = $this->tag->id;
//            $products = Product::where('category_id', $this->category->id)
//                ->whereHas('tags', function ($query) use ($tagId) {
//                    $query->whereIn('tags.id',[$tagId]);
//                });
//        } else {
//            $products = new Product;
//        }
//        $products = $products->where(function ($query) {
//            $query->where('title', 'LIKE', '%' . $this->search . '%')->
//            orWhere('short_description', 'LIKE', '%' . $this->search . '%')->
//            orWhere('long_description', 'LIKE', '%' . $this->search . '%')->
//            orWhere('price', 'LIKE', '%' . $this->search . '%')->
//            orWhere('discount_price', 'LIKE', '%' . $this->search . '%')->
//            orWhere('additional', 'LIKE', '%' . $this->search . '%');
//        })->orderBy('created_at', 'desc')->paginate(12);

        return view('livewire.category', compact('products'))->extends('front.layout')
            ->section('content');
    }
}
