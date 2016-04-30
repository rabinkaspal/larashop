<?php
namespace App\Http\Controllers;
use App\Brand;
use App\Category;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Cart;

class Front extends Controller
{

    var $brands;
    var $categories;
    var $products;
    var $title;
    var $description;

    public function __construct(){
        $this->brands = Brand::all(array('name'));
        $this->categories = Category::all(array('name'));
        $this->products = Product::all(array('name','id','price'));
    }

  public function index() {
        return view('home', array('title' => 'Welcome','description' => '','page' => 'home', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function products() {
        return view('products', array('title' => 'Products Listing','description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function product_details($id) {
        $product = Product::find($id);
        return view('product_details', array('product' => $product, 'title' => $product->name,'description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function product_categories($name) {
        return view('products', array('title' => 'Welcome','description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function product_brands($name, $category = null) {
        return view('products', array('title' => 'Welcome','description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function blog() {
        return view('blog', array('title' => 'Welcome','description' => '','page' => 'blog', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function blog_post($id) {
        return view('blog_post', array('title' => 'Welcome','description' => '','page' => 'blog', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function contact_us() {
        return view('contact_us', array('title' => 'Welcome','description' => '','page' => 'contact_us'));
    }

    public function login() {
        return view('login', array('title' => 'Welcome','description' => '','page' => 'home'));
    }

    public function logout() {
        return view('login', array('title' => 'Welcome','description' => '','page' => 'home'));
    }

    public function cart() {

        if(Request::isMethod("post")){
            $product_id = Request::get('product_id');
            $product = Product::find($product_id);

            Cart::add(array('id'=> $product_id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price));
        }

        if(Request::get('product_id') && Request::get('increment') == 1){
            $items = Cart::search(array('id'=> Request::get('product_id')));
            $item = Cart::get($items[0]);

            Cart::update($items[0], $item->qty + 1);
        }


        if(Request::get('product_id') && Request::get('decrease') == 1){
            $items = Cart::search(array('id'=> Request::get('product_id')));
            $item = Cart::get($items[0]);

            Cart::update($items[0], $item->qty - 1);
        }

        if(Request::get('product_id') && Request::get('remove') == 1){
            $items = Cart::search(array('id'=> Request::get('product_id')));
            $item = Cart::remove($items[0]);
        }

        $cart = Cart::content();
        return view('cart', array('cart'=>$cart, 'title' => 'Welcome','description' => '','page' => 'home'));
    }

    public function clear_cart(){
        Cart::destroy();
        return redirect('cart');
    }

    public function checkout() {
        return view('checkout', array('title' => 'Welcome','description' => '','page' => 'home'));
    }

    public function search($query) {
        return view('products', array('title' => 'Welcome','description' => '','page' => 'products'));
    }

}
