import React from 'react'
import ReactDOM from 'react-dom'
import RemoveDialog from './RemoveComponent'
import ClearDialog from './ClearComponent'
import {objCartNative} from '../cartCountChange';
import {store} from '../reducer'

class CartDialog extends React.Component {

   constructor(props) {
      super(props);

      this.handleCart = this.handleCart.bind(this);

      this.state = {
         carts: window.carts   
      }
   }

   componentDidMount() {
      console.log(this.state.carts);   

      store.subscribe(() => this.handleStore(store.getState()));
   }

	handleStore(store) {
      this.handleCart(store.cartsReducer);
   }   

   handleCart(carts) {
       this.setState({
          carts: carts,  
       });

       objCartNative.countChange(carts.length);
   }   

   render() {
      return (
      <div>   
         <div className="cart_items">
            <ul className="cart_items_list">
               {this.state.carts.map((item, key) =>
                  <li key={key} className="cart_item item_list d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-end justify-content-start" style={{ width: "50%" }}>
                     <div className="product d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start mr-auto">
                           <RemoveDialog cartId={item.id} handleCart={this.handleCart} /> {/* !!! cartId={item.id}  handleCart={this.handleCart} */}
                           <div><div className="product_image"><img src={'/images/' + item.product.image} alt="" /></div></div>
                           <div className="product_name_container">
                              <div className="product_name"><a href="#">{item.product.name}</a></div>
                              <div className="product_text">Second line for additional info</div>
                           </div>
                     </div>
                     <div className="product_price product_text">{item.product.price}</div>
                     <div className="product_size product_text">{item.size.name}</div>
                  </li>
               )}
            </ul>
         </div>
         <ClearDialog handleCart={this.handleCart} /> {/* !!! only handleCart={this.handleCart} */}  
      </div>           
      );    	
   }

}

const elem = document.querySelector('.cart_block'); 

if (elem) {
  ReactDOM.render(<CartDialog />, elem);
}
