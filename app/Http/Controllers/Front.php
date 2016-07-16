<?php
namespace App\Http\Controllers;
use App\User;
use App\Post;
use App\BlogPostTag;
use App\Brand;
use App\Category;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
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
        $posts = Post::where('id', '>', 0)->paginate(3);
        $posts->setPath('blog');

        $data['posts'] = $posts;

        return view('blog', array('data' => $data, 'title' => 'Latest Blog Posts', 'description' => '', 'page' => 'blog', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }
    

    public function blog_post($url) {
        $post = Post::where('url', '=', $url)->get();
        $post_id = $post[0]['id'];
        
        $tags = BlogPostTag::postTags($post_id);

        $previous_url = Post::prevBlogPostUrl($post_id);
        $next_url = Post::nextBlogPostUrl($post_id);

        $data['previous_url'] = $previous_url;
        $data['next_url'] = $next_url;
        $data['tags'] = $tags;
        $data['post'] = $post[0];

        return view('blog_post', array('data' => $data, 'title' => $post[0]['title'], 'description' => $post[0]['description'], 'page' => 'blog', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function contact_us() {
        return view('contact_us', array('title' => 'Welcome','description' => '','page' => 'contact_us'));
    }

    public function login() {
        return view('login', array('title' => 'Welcome','description' => '','page' => 'home'));
    }

    public function register(){
        if(Request::isMethod('post')){
            User::create([
                'name'=>Request::get('name'),
                'email'=>Request::get('email'),
                'password'=>bcrypt(Request::get('password'))
            ]);
        }
        return Redirect::away('login');
    }
    
    
      public function authenticate() {
        if (Auth::attempt([
                'email' => Request::get('email'),
                'password' => Request::get('password')
                ])) {
            return redirect()->intended('checkout');
        } else {
            return redirect('login');
        }
    }

    public function logout() {
    Auth::logout();
    
    return Redirect::away('login');
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
