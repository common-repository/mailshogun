<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
wp_enqueue_script( 'bootstrap', plugin_dir_url( __FILE__ ).'public/js/bootstrap.3.3.5.min.js', array('jquery'), '3.3.5', true );
wp_enqueue_script("jquery"); 
wp_enqueue_script('jquery-cookie', plugin_dir_url( __FILE__ ) .'public/js/jquery.cookie.min.1.4.1.js', array(), null, true);
wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) .'public/css/bootstrap.min.3.3.7.min.css', array(), 20141119 )
?>
<div>
<div class="updated">
  <img src="<?php echo plugin_dir_url( __FILE__ ) . 'public/img/logo24.png'; ?>">
   <p><strong>Please note:</strong> You can define one address of your domain (for instance info@mywordpress-domain.com to your regular email (preferabbly your gmail). The free version of the plugin will let you configure one address. In the coming Pro version, we will can configure limitless addresses.  </p>
</div>
<div>
   <p>
      Here you can configure the free address. Remember to direct the MX from your domain provider to mail.mailshogun.com. Here you will find insructions how to do it. (dont worry...it is very simple)<a href="https://mailshogun.com/documentation/#setting-mx-record">Configure MX record</a> Here you will find instruction how to setup Gmail, so we will be able to send emails from your branded domain name. <a href="https://mailshogun.com/documentation/#setup-gmail-to-send-back-emails">How to Configure Gmail</a>     
   </p>
   <wbr>
   <div id="message" classs="address-field red"></div>
   <div id="myProgress">
      <div id="myBar">
      <div class="progressbar-text">processing.....</div>
    </div>
  </div>
   <table id="address_table" class=" table table-striped"">
      <thead>
         <tr>
            <th scope="row">Domain Email</th>
            <th scope="row">Forward to...</th>
            <th scope="row">SMTP Password</th>
            <th scope="row">Enable</th>
            <th scope="row">Save</th>
         </tr>
      </thead>
      <tbody id="tbody-address">
      </tbody>       
   </table>
   <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
      <input type="hidden" name="cmd" value="_s-xclick">
      <input id="domain_custom" type="hidden" name="custom" value=""/>
      <input type="hidden" name="hosted_button_id" value="7AJLWYUT2996E">
      <INPUT TYPE="hidden" NAME="return" value="https://www.smolani.com">
      <table>
         <tr>
            <td><input type="hidden" name="on0" value="Program">Program</td>
         </tr>
         <tr>
            <td>
               <select name="os0">
                  <option value="1 Mailbox">1 Mailbox : $10.00 USD - yearly</option>
                  <option value="2 Mailboxes">2 Mailboxes : $20.00 USD - yearly</option>
                  <option value="3 Mailboxes">3 Mailboxes : $30.00 USD  - yearly</option>
                  <option value="4 Mailboxes">4 Mailboxes : $40.00 USD - yearly</option>
                  <option value="5 Mailboxes">5 Mailboxes : $50.00 USD  - yearly</option>
                  <option value="6 Mailboxes">6 Mailboxes : $60.00 USD  - yearly</option>
                  <option value="7 Mailboxes">7 Mailboxes : $70.00 USD - yearly</option>
                  <option value="8 Mailboxes">8 Mailboxes : $80.00 USD  - yearly</option>
                  <option value="9 Mailboxes">9 Mailboxes : $90.00 USD  - yearly</option>
                  <option value="10 Mailboxes">10 Mailboxes : $100.00 USD - yearly</option>
               </select>
            </td>
         </tr>
      </table>
      <input type="hidden" name="currency_code" value="USD">
      <input id="submit-paypal" type="image" src="https://www.paypalobjects.com/en_US/IL/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
      <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
   </form>
</div>
<div id="pro" class ="tabcontent">
</div>
<script>
   var domain; 
   var loc; 
   var payament_response; 
   var $= jQuery.noConflict();
   $(document).ready(function () {
     loc= window.location.href; 
     domain=extractRootDomain(window.location.hostname);
     ////console.log (loc);
   
      $("#domain_custom").attr('value', domain);
      //$("#return_location").attr('value', loc);
      
      check_page_status(); 
       
   
   });


   

   $( '#address_table' ).on( 'click',"input[type='button']", function (){
        var row = this.id.split("-id")[1];
        //console.log('clicked: '+row)
        id= $("#address_table").find("#idfield"+row).val()
        //console.log ("id",id)
        address=$("#address_table").find("#from_address"+row).val()
        forwarding=$("#address_table").find("#to_address"+row).val()
        checked =$("#address_table").find("#enable_address"+row).is(":checked")
        if (checked)
          active=1
        else 
          active=0
        
        //console.log("id"+id+"address"+address+"forwarding"+forwarding+"active"+active)

        jQuery.ajax({
                    
                    type: 'POST',
                    url: "https://apidev.mailshogun.com/upsert_address",   
                    data: {
                            id :JSON.stringify(id),
                            address: JSON.stringify(address),
                            forwarding:JSON.stringify(forwarding),
                            address_type:0,
                            active:active
                          },
                    //contentType: 'application/json;charset=UTF-8',  
                            
                    success: function(response){
                     //alert('success');
                     //console.log(response);
                     show_message(response,"info");
   
                     check_page_status(); 
                    },
                    error: function (xhr, status) {
                      show_message("error inserting new address","info");
                    },
   
                });
    });
  
   
  
  
   check_page_status = function(){
        var elem = document.getElementById("myBar");   
        cockie=$.cookie('payment-in-progress');    
        if (typeof cockie == 'undefined') {
          elem.style.display = "none"; 
          refresh_address()
        }
        else {  //payment is in progress
          var width = 1;
          var id = setInterval(frame, 1000);
          function frame() {
            check_payament_status()
            //console.log ("response-------",payament_response)
            cockie=$.cookie('payment-in-progress');   
            if ((typeof cockie == 'undefined')|| (payament_response=="payement completed"))  {
              clearInterval(id);
              elem.style.display = "none"; 
              if (typeof cockie == 'undefined') {
                show_message ("error in payment","error")
              }
              refresh_address()
            } else {
              width++; 
              elem.style.width = width + '%'; 
            }
          }
        }

   }

   check_payament_status = function() {

        jQuery.ajax({
                    
                    type: 'POST',
                    url: "https://apidev.mailshogun.com/payment_progress",   
                    data: {
                            domain :JSON.stringify(domain),
                          },
                    //contentType: 'application/json;charset=UTF-8',  
                            
                    success: function(response){
                     //alert('success');
                     //console.log(response);
                     payament_response=response
                    },
                    error: function (xhr, status) {
                      //console.log(xhr)
                      show_message("payment error","error");
                    },
   
                });

   }

   
   
   refresh_address =function (){

      
      
   
       //console.log ("refresh_address")
       jQuery.ajax({
                    
                    type: 'POST',
                    url: "https://apidev.mailshogun.com/read",   
                    data: {domain: JSON.stringify(domain)},
                    //contentType: 'application/json;charset=UTF-8',
                    success: function(response){
                     try {
                         //alert(response.address);
                         if (response.constructor != Array) {
                            if (response == "MX not defined"){
                              //console.log (response) 
                              message ="You cannot define address for this domain, since the MX is not directed to mailshogun. Please click on the click above \"how to configure MX receord\""
                              show_message(message,"error");
                             $("#savebtn").prop('disabled', true);
   
                           }
                            else  {
                              show_message("")
                              $('#tbody-address').empty();
                              str=build_row(0,0,"","",0)
                              $('#address_table').append(str);

                            }
                         }
                         else {
                           //console.log("hewrerwerwer88888")
                           //addRows (2)
                           //console.log (response)
                           response_len =response.length
                           show_message("")
                           $('#tbody-address').empty();
                           str=""
                           array_is_empty=true
                           for(var i=0;i<=response_len-1;i++)
                           {
                              array_is_empty=false
                              str+=build_row(i,response[i].id,response[i].address,response[i].forwarding,response[i].password,response[i].active)
                          }
                          if (array_is_empty)                              
                             str=build_row(0,0,"","",0)
                           
                            $('#address_table').append(str);
                          
                        }
                      }
                      catch (err) {
                        //console.log ("error:",err)
                      }
   
                     
   
                    },
                    error: function (xhr, status) {
                      alert(status);
                    },
   
                });
   }

   $( '#submit-paypal' ).on( 'click', function (){
       //setCookie ("pay","1","111111") 
       //document.cookie="name"  
       var date = new Date();
       date.setTime(date.getTime() + (60 * 3000)); //expriration is 5 min
       $.cookie('payment-in-progress', domain, { expires: date });  // expires after 1 minute
                            
    });
   
   

   build_row = function(i,id,address,forwarding,password,active) {
    //console.log("build")
    str=""
    str+="<tr>";
    str+="<input id=\"idfield"+i+"\" class=\"address-field\" type=\"hidden\" name=\"idfield\" placeholder=\"e.g. info@mydomain.com\" value=\""+clean(id)+"\" />";
    str+="<td><input  id=\"from_address"+i+"\" class=\"address-field id"+i+"\" type=\"text\" name=\"wpt_text_field\" placeholder=\"e.g. info@mydomain.com\" value=\""+clean(address)+"\" /></td>";
    str+="<td><input id=\"to_address"+i+"\" class=\"address-field\" type=\"text\" name=\"wpt_text_field\" placeholder=\"e.g. info@mydomain.com\" value=\""+clean(forwarding)+"\"/></td>";
    str+="<td><div id=\"password"+i+"\" classs=\"address-field id"+i+"\"></div>"+clean(password)+"</td>";
    if (active=="1" )
      str+="<td><input type=\"checkbox\" checked id=\"enable_address"+i+"\" classs=\"address-field\"></input></td>";
    else
       str+="<td><input type=\"checkbox\"  id=\"enable_address"+i+"\" classs=\"address-field\"></input></td>";
    str+="<td><input type=\"button\" class=\"button-primary \" id=\"savebtn-id"+i+"\" value=\"Save Email Definitions\" /></td>"
    str+="</tr>";
    return (str)
   }
   
   show_message = function (message,level) {
    ////console.log ("here111")
    $("#message").text(message);
    if (level=="error")
       $("#message").css('color', 'red');
    else 
      $("#message").css('color', '');
   }
   
   
   
   
   extractRootDomain = function (url) {
    var domain = extractHostname(url),
        splitArr = domain.split('.'),
        arrLen = splitArr.length;
   
    // extracting the root domain here
    //if there is a subdomain 
    if (arrLen > 2) {
        domain = splitArr[arrLen - 2] + '.' + splitArr[arrLen - 1];
        //check to see if it's using a Country Code Top Level Domain (ccTLD) (i.e. ".me.uk")
        if (splitArr[arrLen - 2].length == 2 && splitArr[arrLen - 1].length == 2) {
            //this is using a ccTLD
            domain = splitArr[arrLen - 3] + '.' + domain;
        }
    }
    return domain;
   }
   
   extractHostname = function (url) {
    var hostname;
    //find & remove protocol (http, ftp, etc.) and get hostname
   
    if (url.indexOf("//") > -1) {
        hostname = url.split('/')[2];
    }
    else {
        hostname = url.split('/')[0];
    }
   
    //find & remove port number
    hostname = hostname.split(':')[0];
    //find & remove "?"
    hostname = hostname.split('?')[0];
   
    return hostname;
   }
   
   clean = function(value){
     return (value == null) ? "" : value
   }

  
   
   
</script>