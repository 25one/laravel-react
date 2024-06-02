import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import Swal from 'sweetalert2';

class LayoutDialog extends React.Component {

   constructor(props) {
      super(props);

      this.handleMessage = this.handleMessage.bind(this);
      this.handleContact = this.handleContact.bind(this);
      this.clickMailer = this.clickMailer.bind(this);

      this.state = {
         message: '',
         contact: '',  
      }
   }

   componentDidMount() {
      //...   
   }

   handleMessage(event) {
       this.setState({
          message: event.target.value,  
       });
   } 

   handleContact(event) {
      this.setState({
         contact: event.target.value,  
      });
   } 

   clickMailer() {
      let self = this; //!!!self - becouse axios
      axios
       .post('/mailer', {message: this.state.message, contact: this.state.contact})
         .then(function (resp) {
             console.log(resp.data);

             if (resp.data.mail) {
               self.setState({
                  message: '',
                  contact: '',  
               });

               Swal.fire({
                  title: "Сongratulations!",
                  text: "Your message has been sending successfully!",
                  icon: "success",
               });
             } else {
               Swal.fire({
                  title: "Oops!",
                  text: "There is any mistake!",
                  icon: "error",
               });               
             }             
         })
         .catch(function (resp) {
             console.log(resp);
             alert("Could not send message");
         });                  
   }

   render() {
      return (
      <div>   
         <input type="text" value={this.state.message} name="newsletter_input_message" className="newsletter_input message" placeholder="Ваше сообщение" onChange={this.handleMessage} />
         <input type="text" value={this.state.contact} name="newsletter_input_email" className="newsletter_input email" placeholder="Ваш контакт(email, skype,...)" onChange={this.handleContact} />
         <br />
         <button type="button" className="newsletter_button" onClick={this.clickMailer}>{'>'}</button><br></br>
      </div>           
      );    	
   }

}

const elem = document.querySelector('.newsletter'); 

if (elem) {
  ReactDOM.render(<LayoutDialog />, elem);
}
