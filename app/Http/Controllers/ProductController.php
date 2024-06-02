<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Services\Mail;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Comment;
use App\Http\Requests\CartRequest;
use App\Http\Requests\CommentRequest;
use DB;

class ProductController extends Controller
{

    protected $repository;
    protected $modelProduct;
    protected $modelCart;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductRepository $repository, Product $product, Cart $cart)
    {
        //$this->middleware('auth');

        $this->repository = $repository;
        $this->modelProduct = $product;
        $this->modelCart = $cart;
    }

    /**
     * Show the index-page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $products = $this->repository->funcSelect($request);

        // Ajax response
        if ($request->ajax()) {
            return response()->json([
                'table' => view("product.brick-standard", ['products' => $products])->render(),
            ]);
        }

        return view('product.index', ['products' => $products]);
    }

    /**
     * Show the product-page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function product(Request $request)
    {
        $product = $this->modelProduct->find($request->id);

        $sizes = $this->repository->funcSelectSize($request);

        $rating = $this->repository->funcGetRating($request);

        if ($product == null) {
            return view('404');
        } else {
            return view('product.product', ['product' => $product, 'sizes' => $sizes, 'rating' => $rating]);
        }
    }

    /**
     * Show the comment-page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function comment(Request $request)
    {
        $product = $this->repository->funcSelectComment($request); 

        if ($product == null) {
            return view('404');
        } else {
            return view('product.comment', ['product' => $product]);
        }
    } 
    
    /**
     * Store item to comment.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addcomment(CommentRequest $request)
    {
        $this->repository->funcStoreComment($request);

        return $this->repository->funcSelectComment($request);
    }    

    /**
     * Clear one item from comment.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function removecomment(Request $request)
    {
       $removeone = Comment::find($request->commentId); //!!!commentId: commentId

       $this->authorize('manage', $removeone); //!!!

       $removeone->delete();

       return $this->repository->funcSelectComment($request); //!!!id: product.id
    }     

    /**
     * Store item to cart.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tocart(CartRequest $request)
    {
        $this->repository->funcStore($request);

        return redirect(route('cart'));
    }     
    
    /**
     * Show the cart-page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cart(Request $request)
    {
        $carts = $this->repository->funcSelectCart();

        // Ajax response //!!!ajax
        if ($request->ajax()) {
            return response()->json([
                'table' => view("product.cart-standard", ['carts' => $carts])->render(), //!!!cart-standard, 'carts' => $carts
            ]);
        }  

        return view('product.cart', ['carts' => $carts]);
    }
    
    /**
     * Clear all cart.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clearall(Cart $cart)
    {
       $cart->where('user_id', \Auth::user()->id)
            ->delete(); 
       
       return $this->repository->funcSelectCart();
    }
    
    /**
     * Clear one item from cart.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clearone(Request $request, Cart $cart)
    {
       $clearone = $this->modelCart->find($request->id);

       $clearone->delete();

       return $this->repository->funcSelectCart();
    }  
    
    /**
     * Mailer.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function mailer(Request $request, Mail $mailer)
    {
       return $mailer->funcSend($request->message, $request->contact);
    }     
}
