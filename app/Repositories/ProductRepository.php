<?php

namespace App\Repositories;

use App\Models\ {
    Product,
    Cart,
    Comment,
    Size
};
use DB;

class ProductRepository
{
    /**
     * The Model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $modelProduct;
    protected $modelCart;
    protected $modelComment;
    protected $modelSize;

    /**
     * Create a new ProductRepository instance.
     *
     * @param  \App\Models\Product $product
     */
    public function __construct(Product $product, Cart $cart, Comment $comment, Size $size)
    {
        $this->modelProduct = $product;
        $this->modelCart = $cart;
        $this->modelComment = $comment;
        $this->modelSize = $size;
    }

    /**
     * Create a query for Product.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function funcSelect($request)
    {       
        $query = $this->modelProduct
                      ->orderBy('price', 'asc');

        if(isset($request->more) && $request->more) $query = $query;                
        else $query = $query->where('top9', 1); 
        
        if(isset($request->search) && $request->search) $query = $query->where('name', 'like', '%' . $request->search . '%');

        return $query->get();              
    }

    /**
     * Get items from comment.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function funcSelectComment($request)
    {
        return $this->modelProduct
                    ->with('comments')
                    ->find($request->id);
    }     

    /**
     * Get rating product.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function funcGetRating($request)
    {
       $comments = $this->funcSelectComment($request);

       $countComments = $comments->comments->count();

       $sumRating = 0;
       foreach ($comments->comments as $comment) {
          $sumRating += $comment->rating;   
       }

       if ($countComments) $ratingComments = $sumRating / $countComments; 
       else $ratingComments = 0;

       return ['ratingComments' => round($ratingComments, 2), 'countComments' => $countComments];
    } 

    /**
     * Store item to cart.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function funcStore($request)
    {
       $this->modelCart->product_id = $request->product_id;
       $this->modelCart->user_id = auth()->user()->id; //!!! or \Auth::user()->id
       $this->modelCart->size_id = $request->size_id;

       $this->modelCart->save();
    }   
    
    /**
     * Store item to comment.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function funcStoreComment($request)
    {
       $this->modelComment->product_id = $request->id;
       $this->modelComment->user_id = auth()->user()->id;
       $this->modelComment->comment = $request->comment;
       $this->modelComment->rating = $request->rating;

       $this->modelComment->save();
    }    

    /**
     * Get items from cart.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function funcSelectCart()
    {
       return $this->modelCart
                   ->with('product')
                   ->with('size')
                   ->where('user_id', \Auth::user()->id)
                   ->get();
    }

    /**
     * Get items from size.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function funcSelectSize($request)
    {
        return $this->modelSize
                    ->get();
    }    

}
