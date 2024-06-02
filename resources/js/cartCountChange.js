import BaseNative from './base.js';

class CartNative extends BaseNative {

    constructor() {
       super();

       //...
    }

    countChange(newCount) {
        document.querySelector('#lblCartCount').innerText = newCount;    
    }

}

export let objCartNative = new CartNative;
