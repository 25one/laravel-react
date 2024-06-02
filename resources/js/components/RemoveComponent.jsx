import React from 'react'
import axios from 'axios'
import {store} from '../reducer'

export default class RemoveDialog extends React.Component {

   constructor(props) {
      super(props);

      this.state = {
         //...   
      }
   }

   componentDidMount() {
      //...   
   }

   removeCart(id) {
      let self = this; //!!!self - becouse axios
      axios
       .post('/clearone', {id: id})
         .then(function (resp) {
             console.log(resp.data);

             self.handleCart(resp.data); //!!!self - becouse axios
         })
         .catch(function (resp) {
             console.log(resp);
             alert("Could not delete cart");
         });            
    }

    handleCart(carts) {
       //this.props.handleCart(carts); //props
       store.dispatch({ type: 'CHANGE_STATE_CARTS', cartsAfterRemove: carts }) //redux
    }   

   render() {
      return (
         <div><a className="btn btn-danger listbuttonremove" href="#" onClick={(e) => {this.removeCart(this.props.cartId); e.preventDefault()}}><i className="fa fa-trash-o" aria-hidden="true"></i></a></div>
      );    	
   }

}
