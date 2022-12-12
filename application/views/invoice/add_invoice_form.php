 <!-- Invoice js -->

 <script src="<?php echo base_url() ?>my-assets/js/admin_js/invoice.js" type="text/javascript"></script>



<!-- Customer type change by javascript end -->



<!-- Add New Invoice Start -->

<div class="content-wrapper">

    <section class="content-header">

        <div class="header-icon">

            <i class="pe-7s-note2"></i>

        </div>

        <div class="header-title">

            <h1><?php echo display('new_invoice') ?></h1>

            <small><?php echo display('add_new_invoice') ?></small>

            <ol class="breadcrumb">

                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>

                <li><a href="#"><?php echo display('invoice') ?></a></li>

                <li class="active"><?php echo display('new_invoice') ?></li>

            </ol>

        </div>

    </section>



    <section class="content">

        <!-- Alert Message -->

        <?php

        $message = $this->session->userdata('message');

        if (isset($message)) {

            ?>

            <div class="alert alert-info alert-dismissable">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <?php echo $message ?>                    

            </div>

            <?php

            $this->session->unset_userdata('message');

        }

        $error_message = $this->session->userdata('error_message');

        if (isset($error_message)) {

            ?>

            <div class="alert alert-danger alert-dismissable">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <?php echo $error_message ?>                    

            </div>

            <?php

            $this->session->unset_userdata('error_message');

        }

        ?>

        <div class="row">

            <div class="col-sm-12">

               

       <?php if($this->permission1->method('manage_invoice','read')->access()){ ?>

                    <a href="<?php echo base_url('Cinvoice/manage_invoice') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('manage_invoice') ?> </a>

                    <?php }?>

      <!--    <?php if($this->permission1->method('pos_invoice','create')->access()){ ?>

                    <a href="<?php echo base_url('Cinvoice/pos_invoice') ?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('pos_invoice') ?> </a>

                <?php }?> -->

            </div>

        </div>





        <!--Add Invoice -->

        <div class="row">

            <div class="col-sm-12">

                <div class="panel panel-bd lobidrag">

                    <div class="panel-heading">

                        <div class="panel-title">

                            <h4><?php echo display('new_invoice') ?></h4>

                           

                        </div>

                    </div>

                 



                    

                    <div class="panel-body">

                        <?php echo form_open_multipart('Cinvoice/manual_sales_insert',array('class' => 'form-vertical', 'id' => 'insert_sale','name' => 'insert_sale'))?>

                        <div class="row">



                            <div class="col-sm-6" id="payment_from_1">

                                <div class="form-group row">

                                    <label for="customer_name" class="col-sm-4 col-form-label"><?php

                                        echo display('customer_name');

                                        ?> </label>

                                    <div class="col-sm-7">
   
                                    <select name="customer_name" class="form-control customer_name" onselect="calculate();" id="customer_name">

<option value="">Select Customer</option>

<?php foreach($customer_details as $customer){?>

    <option value="<?php echo html_escape($customer['customer_name'])?>"><?php echo html_escape($customer['customer_name']);?></option>

<?php }?>

</select>


                                        <input id="autocomplete_customer_id" class="customer_hidden_value abc" type="hidden" name="customer_id" value="{customer_id}" style="width100">

                                    </div>

                                     <?php if($this->permission1->method('add_customer','create')->access()){ ?>

                                  

                                         <a href="#" class="client-add-btn btn btn-info" aria-hidden="true" data-toggle="modal" data-target="#cust_info"><i class="ti-plus m-r-2"></i></a>

                                  

                                <?php } ?>

                                </div>

                            
                            </div>

                            <div class="col-sm-6" id="payment_from">

<div class="form-group row">

    <label for="payment_type" class="col-sm-4 col-form-label"><?php

        echo display('payment_type');

        ?> <i class="text-danger">*</i></label>

    <div class="col-sm-5">

        <select name="paytype" class="form-control" required="" onchange="bank_paymet(this.value)" tabindex="3" style="width100">

            <option value="1"><?php echo display('cash_payment') ?></option>

            <option value="2"><?php echo display('bank_payment') ?></option> 

        </select>

    </div>


      <div  class=" col-sm-3">

         <!-- <a href="#" class="client-add-btn btn btn-info" aria-hidden="true" data-toggle="modal" data-target="#payment_type"><i class="ti-plus m-r-2"></i></a> -->
         <!-- <a href="#" class="client-add-btn btn btn-info" aria-hidden="true" >Add Payment</a> -->
         <!-- <a href="#" class="client-add-btn btn btn-info" aria-hidden="true" data-toggle="modal" data-target="#payment_type"><i class="ti-plus m-r-2"></i></a> -->
                                         <a href="#" class="client-add-btn btn btn-info" aria-hidden="true"   data-toggle="modal" data-target="#payment_type" >Add Payment</a>

    </div>

                                 

                                </div>

                            </div>

                        </div>



                        <div class="row">

                            <div class="col-sm-6">

                                <div class="form-group row">

                                    <label for="date" class="col-sm-4 col-form-label">Sales Invoice date <i class="text-danger">*</i></label>

                                    <div class="col-sm-8">

                                        <?php

                               

                                        $date = date('Y-m-d');

                                        ?>

                                        <input class=" form-control" type="date" size="50" name="invoice_date" id="date" required value="<?php echo html_escape($date); ?>" tabindex="4" />

                                    </div>

                                </div>

                                <input type="hidden" id="invoice_hdn1"/>


                                      <div class="form-group row">

                                    <label for="billing_address" class="col-sm-4 col-form-label">Billing Address</label>

                                    <div class="col-sm-8">

                                        <textarea rows="4" cols="50" name="billing_address" class=" form-control" placeholder='Billing Address' id="billing_address"> </textarea>

                                    </div>

                                </div> 

                                <div class="form-group row">

                                    <label for="billing_address" class="col-sm-4     col-form-label">Payment Terms</label>

                                    <div class="col-sm-8">

                                        <select   name="payment_terms" id="payment_terms" class=" form-control" placeholder='Payment Terms' id="payment_terms">
                                         <option value=""></option>   
                                        <option value="100%">100%</option> 
                                        <option value="30-70">30-70%</option> 
                                        <option value="70-30">70-30%</option> 
                                        <option value="75-25">75-25%</option> 
                                        <option value="25-75">25-75%</option> 
                                        </select>

                                    </div>

                                </div>

                                  <div class="form-group row">

                                    <label for="billing_address" class="col-sm-4 col-form-label">Number of days</label>

                                    <div class="col-sm-8">

                                        <select type="text"  name="number_of_days" id=number_of_days class=" form-control" placeholder='Number of days' id="number_of_days"> 
                                            <option value="">number_of_days</option>
                                            <?php 
                                            for($i=1;$i<100;$i++)
                                            {
                                                ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?>days</option>
                                                <?php
                                            }
                                            ?>
                                            <select>
                                    </div>

                                </div> 
                                <div class="form-group row">

                                    <label for="ETA" class="col-sm-4 col-form-label">ETD</label>

                                    <div class="col-sm-8">

                                        <input type="date" name="etd" class="form-control">
                                    </div>

                                </div> 
                                <div class="form-group row">

                                    <label for="ETA" class="col-sm-4 col-form-label">Doc</label>

                                    <div class="col-sm-8">

                                        <input type="file" name="file" class="form-control">
                                    </div>

                                </div> 

                            </div>
                         

                             <div class="col-sm-6">

                                <div class="form-group row">

                                    <label for="date" class="col-sm-4 col-form-label">Commercial Invoice Number<i class="text-danger">*</i></label>

                                    <div class="col-sm-8">
                                        <input class="form-control" placeholder="Commercial Invoice Number" type="text" name="commercial_invoice_number"  value="<?php if(!empty($voucher_no[0]['voucher'])){
                                        $curYear = date('Y'); 
                                        $month = date('m');
                                    $vn = substr($voucher_no[0]['voucher'],9)+1;
                                    echo $voucher_n = 'NS'. $curYear.$month.'-'.$vn;
                                    }else{
                                            $curYear = date('Y'); 
                                        $month = date('m');
                                    echo $voucher_n = 'NS'. $curYear.$month.'-'.'1';
                                    } ?>" readonly />
                                    </div>
                                </div>


                                      <div class="form-group row">

                                    <label for="container_number" class="col-sm-4 col-form-label">Container Number <i class="text-danger">*</i></label>

                                    <div class="col-sm-8">

                                       <input class="form-control" placeholder="Container Number" type="text" size="50" name="container_number" id="date" required value="" tabindex="4" />

                                    </div>

                                </div> 

                            </div>



                                <div class="col-sm-6">

                                <div class="form-group row">

                                    <label for="date" class="col-sm-4 col-form-label">B/L No<i class="text-danger">*</i></label>

                                    <div class="col-sm-8">


                                        <input class="form-control" placeholder="BL Number" type="text" size="50" name="bl_no" required value=""/>

                                    </div>

                                </div>



                                <div class="form-group row">

                                    <label for="port_of_discharge" class="col-sm-4 col-form-label">Port of discharge</label>

                                    <div class="col-sm-8">

                                        <input name="port_of_discharge" class=" form-control" placeholder='Port of discharge' id="port_of_discharge" />
                                    </div>

                                </div>

                                  <div class="form-group row">

                                    <label for="port_of_discharge" class="col-sm-4 col-form-label">  Payment Due date</label>

                                   <div class="col-sm-8">

                                        <?php

                               

                                        $date1 ='26-08-2022';

                                        ?>

                                        <input class="form-control" type="date" size="50" name="payment_due_date" id="date1" required  tabindex="4" />

                                    </div>

                                </div>
                                <div class="form-group row">

                                    <label for="ETA" class="col-sm-4 col-form-label">ETA</label>

                                   <div class="col-sm-8">

                                        <?php

                               

                                        $date1 ='26-08-2022';

                                        ?>

                                        <input class="form-control" type="date" size="50" name="eta" id="date1" required  tabindex="4" />

                                    </div>

                                </div>
                              

                            </div>




                        <div class="col-sm-5" id="bank_div">

                            <div class="form-group row">

                                <label for="bank" class="col-sm-5   col-form-label"><?php

                                    echo display('bank');

                                    ?> <i class="text-danger">*</i></label>

                                <div class="col-sm-6">

                                   <select name="bank_id" class="form-control bankpayment"  id="bank_id">

                                        <option value="">Select Location</option>

                                        <?php foreach($bank_list as $bank){?>

                                            <option value="<?php echo html_escape($bank['bank_id'])?>"><?php echo html_escape($bank['bank_name']);?></option>

                                        <?php }?>

                                    </select>

                                 

                                </div>
                                 <?php if($this->permission1->method('add_customer','create')->access()){ ?>

                                    <div  class=" col-sm-1">

                                         <!-- <a href="#" class="client-add-btn btn btn-info" aria-hidden="true" data-toggle="modal" data-target="#bank_info"><i class="ti-plus m-r-2"></i></a> -->
                                         <a href="#" class="client-add-btn btn btn-info" aria-hidden="true"   data-toggle="modal" data-target="#bank_info" >Add New Bank</a>
                                    </div>

                                <?php } ?>
                             

                            </div>

                        </div>

                        </div>

                        <br>
                <style>
                      .taxtab {
     table-layout: fixed;
     width: 100%;
     text-align: center;
     border-collapse: collapse;
  }
  .taxtab td{
     border: 1px solid #dddddd;
     padding: 8px;
  }
  input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
                </style>      
                        <div class="table-responsive">
                        <table class="taxtab table table-bordered table-hover">
                        <tr>
                      <td class="hiden" style="width:30%;border:none;">
                         </td>
                
                                <td class="hiden" style="width:200px;padding:5px;background-color: #38469f;border:none;font-weight:bold;color:white;">1 <?php  echo $curn_info_default;  ?>
                                 = <input style="width:50px;text-align:center;color:black;padding:5px;" type="text" id="custocurrency_rate"/>&nbsp;<label for="custocurrency" style="color:white;background-color: #38469f;"></label></td>
                    <td style="border:none;text-align:right;font-weight:bold;">Tax : 
                                 </td>
                                <td style="width:40%">
<select name="tx"  id="product_tax" class="form-control" >
<option value="Select the Tax" selected>Select the Tax</option>
<?php foreach($tax as $tx){?>
  
    <option value="<?php echo $tx['tax_id'].'-'.$tx['tax'].'%';?>">  <?php echo $tx['tax_id'].'-'.$tx['tax'].'%';  ?></option>
<?php } ?>
</select>
</td>
</tr>
</table>


<table class="table table-bordered table-hover" id="normalinvoice">
                                <thead>
                                     <tr>
                                            <th class="text-center" width="20%">Product name<i class="text-danger">*</i></th> 
                                            <th class="text-center">In stock</th>
                                            <th class="text-center">Quantity / Sq ft.<i class="text-danger">*</i></th>
                                            <th class="text-center">Amount<i class="text-danger">*</i></th>
                                           
                                            <th class="text-center"><?php echo display('total') ?></th>
                                            <th class="text-center"><?php echo display('action') ?></th>
                                        </tr>
                                </thead>
                                <style>
        input {
    border: none;
    background-color: #eee;
 }
textarea:focus, input:focus{
   
    outline: none;
}
 .text-right {
    text-align: left; 
}
</style>
                                <tbody id="addPurchaseItem">
                                    <tr>
                                        <td>
                                        <select name="prodt[]" id="prodt_1" class="form-control product_name" onchange="available_quantity(1);">
                                        <option value="Select the Product" selected>Select the Product</option>
                                            <?php 
                                       
                                            foreach($product as $tx){?>
                                       
                                                <option value="<?php echo $tx['product_name'].'-'.$tx['product_model'];?>">  <?php echo $tx['product_name'].'-'.$tx['product_model'];  ?></option>
                                           <?php } ?>
                                        </select>
                                        <input type='hidden' class='common_product autocomplete_hidden_value  product_id_1' name='product_id[]' id='SchoolHiddenId' />
                                        </td>

                                       <td class="wt">
                                                <input type="text" id="available_quantity[]" name="available_quantity[]" class="form-control text-right available_quantity_1" placeholder="0.00" readonly/>
                                            </td>
                                        
                                            <td class="text-right">
                                                <input type="text" name="product_quantity[]" id="cartoon_1" required="" min="0" class="form-control text-right store_cal_1" onkeyup="total_amt(1);" placeholder="0.00" value=""  tabindex="6"/>
                                            </td>
                                            <td>
                                            <span class="form-control" style="background-color: #eee;"><?php  echo $currency;  ?>
                                                <input type="text" name="product_rate[]" required=""  id="product_rate_1" class="product_rate_1" placeholder="0.00" value="" min="0" tabindex="7" readonly/>
                                            </span> </td>
                                         

                                            <td style="text-align:left;">
                                            <span class="form-control" style="    background-color: #eee;"><?php  echo $currency;  ?> 
                                                <input class="total_price" type="text" name="total_price[]" id="total_price_1" value="0.00"   readonly="readonly" />
                                                </span></td>


                                            <td>

                                               
                                         
                                                <button  class="btn btn-danger text-right red" type="button" value="<?php echo display('delete')?>" onclick="calculate();total_amt(1);deleteRow(this)" tabindex="8"><i class="fa fa-close"></i></button>
                                            </td>
                                           
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                   
                                        <td style="text-align:right;" colspan="4"><b><?php echo display('total') ?>:</b></td>
                                        <td style="text-align:left;">
                                            <span class="form-control" style="background-color: #eee;"><?php   echo $currency;  ?>
                                            <input type="text" id="Total" class="text-right" name="total"  readonly="readonly" />
                                            </span></td>
                                    
                                           
                                    </tr>
                                    <tr>
                                   
                                   <td style="text-align:right;" colspan="4"><b>Tax Details :</b></td>
                                   <td style="text-align:left;">
                                 <span class="form-control" style="background-color: #eee;"><?php echo $currency;  ?>
                                       <input type="text" id="tax_details" class="text-right" value="0.00" name="tax_details"  readonly="readonly" />
                                       </span></td>
                               
                                      
                               </tr>
                                    <tr> <td style="text-align:right;" colspan="4"><b><?php echo "Grand Total" ?>:</b></td>
                                    <td>
                                            <span class="form-control" style="background-color: #eee;"><?php  echo $currency;  ?>
                                            <input type="text" id="gtotal"  name="gtotal" onchange=""value="0.00" readonly="readonly" />
                                            </span></td>
                                        <td> <button type="button" id="add_invoice_item" class="btn btn-info" name="add-invoice-item" onclick="addInputField('addPurchaseItem');"  tabindex="9" ><i class="fa fa-plus"></i></button>

                                           
                                    </tr>
                                    </tr>
                                    <tr>
                                        
                                    
                                    
                                    <td style="text-align:right;"  colspan="4"><b><?php echo "Grand Total" ?>:</b><br/><b>(Preferred Currency)</b></td>
                                    <td>
                                            <span class="form-control" style="background-color: #eee;" id="custospan"><input style="width:7%;font-weight:bold;" type="text" id="cus"  name="cus"  readonly="readonly" />
                                            <input type="text" id="customer_gtotal"  name="customer_gtotal"  readonly="readonly" />
                                            </span></td>
                                      

                                            <input type="hidden" id="final_gtotal"  name="final_gtotal" />

                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/></td>
                                    </tr>  
                                </tfoot>
                            </table>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 ">
                                <table>
                                <tr>
                                   
                                    <td>
                                    <input type="hidden" name="packing_id" value="" id="packing_id">
                                        <input type="submit" id="add_purchase" class="btn btn-primary btn-large" name="add-packing-list" value="Save" />

                                        <a id="download" style="color: #fff;" class='btn btn-primary'>Download</a>
                                <a id="email" style="color: #fff;" class='btn btn-primary'>Send Email with Attachment</a>  
                                    <td>&nbsp;</td>
                                     </td>
                                    <td>&nbsp;</td>
                                    <td id="btn1_download">

                                    </td>
                                    </td>
                                    <td>&nbsp;</td>
                                     <?php 
                                    if(isset($_SESSION['invoiceid']))
                                        { ?>
                                    <td><a href="<?php echo base_url('Cinvoice/manage_invoice/'); ?>" class="btn btn-primary" id="send_email3" style="color:#fff;">Submit</a></td>
                                    <td >
                                        
                                    <a href="<?php echo base_url('Cinvoice/invoice_inserted_data/'); ?><?php echo $this->session->userdata('invoiceid');?>" class="btn btn-primary" style="color:#fff;" id="send_email1">Pdf Download</a>

                                    </td>

                                    <td>&nbsp;</td>
                                    <td>
                                        <a class="btn  btn-sm" style=" color: #fff;"  data-toggle="modal" data-target="#emailmodal">Send mail with attachment</a>

  <!-- Modal -->
<div id="emailmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">
<form action="insert_role">    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Email Template </h4>
      </div>
      <div class="modal-body">
     <div class="row">
        <div class="col-sm-6" style="border: 1px solid #6666;text-align: center;">  <p style="font-weight: bold;">Standard</p>
            <br>
            <i>Standard Email Temeplate</i>
            <br>
            <br>
         <a href="<?php echo base_url('Cinvoice/newsale_with_attachment_stand/').$this->session->userdata('invoiceid');  ?>" class="btn btn-default">Select</a></div>
        <div class="col-sm-6" style="border: 1px solid #6666;text-align: center;">  <p style="font-weight: bold;">Custom</p>
            <br>
            <i>Custom Email Temeplate</i>
            <br>
            <br>
         <a class="btn btn-default" href="<?php echo base_url('Cinvoice/newsale_with_attachment_cus/').$this->session->userdata('invoiceid');  ?>">Select</a></div>
       
     </div>


</div>
      <div class="modal-footer">
      
      </div>
    </div>

  </div>
</div>

                                    </td>
                                    <td>&nbsp;</td>
                                <?php } ?>
                                    
                                    
                                </tr>
                          
                            </div>
                        </div>

  <div class="form-group row">
      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#packmodal" id="packbutton">Choose Packing Invoice   </button>

  </div>
                           <div class="form-group row">

                                    <label for="billing_address" class="col-sm-4 col-form-label">Account Details/Additional Information</label>

                                    <div class="col-sm-8">

                                        <textarea rows="4" cols="50" id="details" name="ac_details" class=" form-control" placeholder='Account Details/Additional Information' id=""> </textarea>

                                    </div>

                                </div> 
                                <div class="form-group row">

                                    <label for="remark" class="col-sm-4 col-form-label">Remarks/Conditions</label>

                                    <div class="col-sm-8">

                                        <textarea rows="4" cols="50" id="remarks" name="remark" class=" form-control" placeholder='Remarks/Conditions' id=""> </textarea>

                                    </div>

                                </div>
                        <div class="table-responsive">

                            
                        <table class='table'>
                                <tr>
                                    <th colspan='7'>
                                      

                                    </th>
                                </tr>    
                        </table>

                        </div>
<div id='customer-data' style='color:red;'></div>
                               <?php echo form_close()?>
                              
                    </div>
                    <input type="hidden" id="hdn"/>
<input type="text" id="gtotal_dup"/>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">


<style>
 #btn1_download{
display:none;
 }
     #btn1_email{
        display:none;
     }
    </style>
            
                  

                
<script>
$(document).ready(function(){

    $('#product_tax').on('change', function (e) {
        var first=$("#Total").val();
    var tax= $('#product_tax').val();
var field = tax.split('-');

var percent = field[1];
var answer=0;
  var answer = parseInt((percent / 100) * first);
   console.log("Answer : "+answer);
  var gtotal = parseInt(first + answer);
  console.log("gtotal :" +gtotal);
  
 var final_g= $('#final_gtotal').val();


 var amt=parseInt(answer)+parseInt(first);
 var num = isNaN(parseInt(amt)) ? 0 : parseInt(amt)
 var custo_amt=$('#custocurrency_rate').val(); 
 console.log("numhere :"+num +"-"+custo_amt);
 var value=parseInt(num*custo_amt);
 var custo_final = isNaN(parseInt(value)) ? 0 : parseInt(value)
$('#customer_gtotal').val(custo_final);  
calculate();
});
});
$( document ).ready(function() {
                        $('.hiden').css("display","none");

  

$('#custocurrency_rate').on('change textInput input', function (e) {
    calculate();
});

$('.common_qnt').on('change textInput input', function (e) {
    calculate();
});

});

var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';
function available_quantity (id) {
    $('.product_name').on('change', function (e) {
        var name = 'available_quantity_'+ id;
   
   var amount = 'product_rate_'+ id;
   var pdt=$('#prodt_'+id).val();
   const myArray = pdt.split("-");
   var product_nam=myArray[0];
   var product_model=myArray[1];
  var data = {
       amount:'product_rate_'+ id,
       name:'available_quantity_'+ id,
       product_nam:product_nam,
       product_model:product_model
    };
    data[csrfName] = csrfHash;

    $.ajax({
        type:'POST',
        data: data, 
     dataType:"json",
        url:'<?php echo base_url();?>Cinvoice/availability',
        success: function(result, statut) {
            if(result.csrfName){
             
               csrfName = result.csrfName;
               csrfHash = result.csrfHash;
            }
          $(".available_quantity_"+ id).val(result[0]['p_quantity']);
          $("#product_rate_"+ id).val(result[0]['price']);
          $(".product_id_"+ id).val(result[0]['product_id']);
            console.log(result);
        }
    });
});
}



// Restricts input for each element in the set of matched elements to the given inputFilter.
(function($) {
  $.fn.inputFilter = function(callback, errMsg) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function(e) {
      if (callback(this.value)) {
        // Accepted value
        if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
          $(this).removeClass("input-error");
          this.setCustomValidity("");
        }
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        // Rejected value - restore the previous one
        $(this).addClass("input-error");
        this.setCustomValidity(errMsg);
        this.reportValidity();
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        // Rejected value - nothing to restore
        this.value = "";
      }
    });
  };
}(jQuery));

$("#custocurrency_rate").inputFilter(function(value) {
  return /^-?\d*[.,]?\d*$/.test(value); }, "Must be a floating (real) Number");
$('#customer_name').on('change', function (e) {

    var data = {
        value: $('#customer_name').val()
      //  defaultcurrency:'<?php //echo $currency; ?>'
     };
    data[csrfName] = csrfHash;
    $.ajax({
        type:'POST',
        data: data,
      dataType:"json",
        url:'<?php echo base_url();?>Cinvoice/getcustomer_data',
        success: function(result, statut) {
            if(result.csrfName){
              csrfName = result.csrfName;
               csrfHash = result.csrfHash;
            }
         console.log(result[0]['currency_type']);
        $("#cus").val(result[0]['currency_type']);
        $("label[for='custocurrency']").html(result[0]['currency_type']);
       console.log('https://open.er-api.com/v6/latest/<?php echo $curn_info_default; ?>');
       $.getJSON('https://open.er-api.com/v6/latest/<?php echo $curn_info_default; ?>', 
function(data) {
 var custo_currency=result[0]['currency_type'];
    var x=data['rates'][custo_currency];
 var Rate =parseFloat(x).toFixed(3);
  console.log(Rate);
  $('.hiden').show();
  $("#custocurrency_rate").val(Rate);
});
      
        }
    });
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

});
$('#product_tax').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    var total=$('#Total').val();
var tax= $('#product_tax').val();

var field = tax.split('-');

var percent = field[1];
percent=percent.replace("%","");
 var answer = (percent / 100) * parseInt(total);
$('#final_gtotal').val(answer);
   $('#hdn').val(valueSelected);
   console.log("taxi :"+valueSelected);
  $('#tax_details').val(answer +" ( "+tax+" )");
   calculate();
});
var arr=[];

function total_amt(id){

    var sum=0;
  
var total='total_price_'+id;

var quantity='cartoon_'+id;
var amount = 'product_rate_'+ id;
var grand=$('#gtotal').val();
var quan=$('#'+quantity).val();
var amt=$('#'+amount).val();
var result=parseInt(quan) * parseInt(amt);
result = isNaN(result) ? 0 : result;
arr.push(result);
$('#'+total).val(result);

gt();
}
function gt(){
    var sum=0;
    $('.total_price').each(function() {
    sum += parseFloat($(this).val());
});
$('#Total').val(sum);
var final_g= $('#final_gtotal').val();
if(final_g !=''){
var first=$("#Total").val();
    var tax= $('#product_tax').val();

var field = tax.split('-');

var percent = field[1];
var answer=0;
  var answer =(parseInt(percent) / 100) * parseInt(first);
   console.log(answer);
   $('#tax_details').val(answer +" ( "+tax+" )");

  var gtotal = parseInt(first + answer);
  console.log(gtotal);
var amt=parseInt(answer)+parseInt(first);
 var num = isNaN(parseInt(amt)) ? 0 : parseInt(amt)
 var custo_amt=$('#custocurrency_rate').val();
 $("#gtotal").val(num);  
 console.log(num +"-"+custo_amt);
 var value=parseInt(num*custo_amt);
 var custo_final = isNaN(parseInt(value)) ? 0 : parseInt(value)
$('#customer_gtotal').val(custo_final);
}  
}
function calculate(){
  
  var first=$("#Total").val();
  var tax= $('#product_tax').val();
var field = tax.split('-');

var percent = field[1];
var answer=0;
var answer = parseInt((percent / 100) * first);
var gtotal = parseInt(first + answer);
console.log(gtotal);
var final_g= $('#final_gtotal').val();


var amt=parseInt(final_g)+parseInt(first);
var num = isNaN(parseInt(amt)) ? 0 : parseInt(amt);
$("#gtotal").val(num);  
var custo_amt=$('#custocurrency_rate').val();

console.log(num +"-"+custo_amt);
var value=parseInt(num*custo_amt);
var custo_final = isNaN(parseInt(value)) ? 0 : parseInt(value)
$('#customer_gtotal').val(custo_final);  
}



</script>


                   <!--      <div class="form-group row">

                                    <label for="billing_address" class="col-sm-4 col-form-label">Message on invoice</label>

                                    <div class="col-sm-8">

                                        <textarea rows="4" cols="50" name="billing_address" class=" form-control" placeholder='This will show upon the invoice' id=""> </textarea>

                                    </div>

                                </div>  -->

                   

                </div>

            </div>

             <div class="modal fade" id="printconfirmodal" tabindex="-1" role="dialog" aria-labelledby="printconfirmodal" aria-hidden="true">

      <div class="modal-dialog modal-sm">

        <div class="modal-content">

          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            <h4 class="modal-title" id="myModalLabel"><?php echo display('print') ?></h4>

          </div>

          <div class="modal-body">

            <?php echo form_open('Cinvoice/invoice_inserted_data_manual', array('class' => 'form-vertical', 'id' => '', 'name' => '')) ?>

            <div id="outputs" class="hide alert alert-danger"></div>

            <h3> <?php echo display('successfully_inserted') ?></h3>

            <h4><?php echo display('do_you_want_to_print') ?> ??</h4>

            <input type="hidden" name="invoice_id" id="inv_id">

          </div>

          <div class="modal-footer">

            <button type="button" onclick="cancelprint()" class="btn btn-default" data-dismiss="modal"><?php echo display('no') ?></button>

            <button type="submit" class="btn btn-primary" id="yes"><?php echo display('yes') ?></button>

            <?php echo form_close() ?>

          </div>

        </div>

      </div>

    </div>



  <!------ add new product-->  
  <div class="modal fade modal-success" id="product_info" role="dialog">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            

                            <a href="#" class="close" data-dismiss="modal">&times;</a>

                            <h3 class="modal-title"><?php echo display('new_product') ?></h3>

                        </div>

                        

                        <div class="modal-body">

                            <div id="customeMessage" class="alert hide"></div>

                      <?php echo form_open_multipart('Cproduct/insert_product', array('class' => 'form-vertical', 'id' => 'insert_product', 'name' => 'insert_product')) ?>

                    <div class="panel-body">

 <input type ="hidden" name="csrf_test_name" id="" value="<?php echo $this->security->get_csrf_hash();?>">

                      <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="barcode_or_qrcode" class="col-sm-4 col-form-label"><?php echo display('barcode_or_qrcode') ?> <i class="text-danger"></i></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="product_id" type="text" id="product_id" placeholder="<?php echo display('barcode_or_qrcode') ?>"  tabindex="1" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="quantity" class="col-sm-4 col-form-label"><?php echo 'Quantity' ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="quantity" type="number" id="quantity" placeholder="Enter Product Quantity only" required tabindex="1" >
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-4 col-form-label"><?php echo display('product_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="product_name" type="text" id="product_name" placeholder="<?php echo display('product_name') ?>" required tabindex="1" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="serial_no" class="col-sm-4 col-form-label"><?php echo display('serial_no') ?> </label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="" class="form-control " id="serial_no" name="serial_no" placeholder="111,abc,XYz"   />
                                    </div>
                                </div>
                            </div>

                        </div>



                       <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="product_model" class="col-sm-4 col-form-label"><?php echo display('model') ?> <i class="text-danger"></i></label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="" class="form-control" id="product_model" name="model" placeholder="<?php echo display('model') ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-4 col-form-label"><?php echo display('category') ?></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="category_id" name="category_id" tabindex="3">
                                            <option value=""></option>
                                            <?php if ($category_list) { ?>
                                                {category_list}
                                                <option value="{category_id}">{category_name}</option>
                                                {/category_list}
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>      



                         <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="sell_price" class="col-sm-4 col-form-label"><?php echo display('sell_price') ?> <i class="text-danger">*</i> </label>
                                    <div class="col-sm-8">
                                        <input class="form-control text-right" id="sell_price" name="price" type="text" required="" placeholder="0.00" tabindex="5" min="0">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-4 col-form-label"><?php echo display('unit') ?></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="unit" name="unit" tabindex="-1" aria-hidden="true">
                                            <option value="">Select One</option>
                                            <?php if ($unit_list) { ?>
                                                {unit_list}
                                                <option value="{unit_name}">{unit_name}</option>
                                                {/unit_list}
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>



                       <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="image" class="col-sm-4 col-form-label"><?php echo display('image') ?> </label>
                                    <div class="col-sm-8">
                                        <input type="file" name="image" class="form-control" id="image" tabindex="4">
                                    </div>
                                </div> 
                            </div>
                             <?php  $i=0;
                    foreach ($taxfield as $taxss) {?>
                   
                            <div class="col-sm-6">
                         <div class="form-group row">
                            <label for="tax" class="col-sm-4 col-form-label"><?php echo $taxss['tax_name']; ?> <i class="text-danger"></i></label>
                            <div class="col-sm-7">
                              <input type="text" name="tax<?php echo $i;?>" class="form-control" value="<?php echo number_format($taxss['default_value'], 2, '.', ',');?>">
                            </div>
                            <div class="col-sm-1"> <i class="text-success">%</i></div>
                        </div>
                    </div>
               
                       <?php $i++;}?>
                        </div> 
                        <div class="table-responsive product-supplier">
                            <table class="table table-bordered table-hover"  id="product_table">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('supplier') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('supplier_price') ?> <i class="text-danger">*</i></th>


                                        <!-- <th class="text-center"><?php// echo display('action') ?> <i class="text-danger"></i></th> -->
                                    </tr>
                                </thead>
                                <tbody id="proudt_item">
                                    <tr class="">

                                        <td width="300">
                                            <select name="supplier_id[]" class="form-control"  required="">
                                                <option value=""> select Supplier</option>
                                                <?php if ($supplier) { ?>
                                                    {supplier}
                                                    <option value="{supplier_name}">{supplier_name}</option>
                                                    {/supplier}
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td class="">
                                            <input type="text" tabindex="6" class="form-control text-right" name="supplier_price[]" placeholder="0.00"  required  min="0"/>
                                        </td>

                                        <!-- <td width="100"> <a  id="add_purchase_item" class="btn btn-info btn-sm" name="add-invoice-item" onClick="addpruduct('proudt_item');"  tabindex="9"/><i class="fa fa-plus-square" aria-hidden="true"></i></a> <a class="btn btn-danger btn-sm"  value="<?php //echo display('delete') ?>" onclick="deleteRow(this)" tabindex="10"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td> -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                   <div class="row">
                            <div class="col-sm-12">
                                <center><label for="description" class="col-form-label"><?php echo display('product_details') ?></label></center>
                                <textarea class="form-control" name="description" id="description" rows="2" placeholder="<?php echo display('product_details') ?>" tabindex="2"></textarea>
                            </div>
                        </div><br>
                        <div class="form-group row">
                            <div class="col-sm-6">

                                <input type="submit" id="add-product" class="btn btn-primary btn-large" name="add-product" value="<?php echo display('save') ?>" tabindex="10"/>

                            
                             
                            </div>
                        </div>

                    </div>

                    

                        </div>



                        <div class="modal-footer">

                            

                            <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>

                            
                            <input type="submit" id="add-deposit" class="btn btn-success" name="add-deposit" value="<?php echo display('save') ?>" tabindex="6"/>
                           <!--  <input type="submit" class="btn btn-success" value="Submit"> -->

                        </div>

                        <?php echo form_close() ?>

                    </div><!-- /.modal-content -->

                </div><!-- /.modal-dialog -->

            </div><!-- /.modal -->

  <!------ add new bank -->  
      <div class="modal fade modal-success" id="bank_info" role="dialog">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            

                            <a href="#" class="close" data-dismiss="modal">&times;</a>

                            <h3 class="modal-title"><?php echo display('add_new_bank') ?></h3>

                        </div>

                        

                        <div class="modal-body">

                            <div id="customeMessage" class="alert hide"></div>

                      <?php echo form_open_multipart('Csettings/add_new_bank',array('class' => 'form-vertical','id' => 'validate' ))?>

                    <div class="panel-body">

 <input type ="hidden" name="csrf_test_name" id="" value="<?php echo $this->security->get_csrf_hash();?>">

                        <div class="form-group row">

                            <label for="bank_name" class="col-sm-4 col-form-label"><?php echo display('bank_name') ?> <i class="text-danger">*</i></label>

                            <div class="col-sm-6">

                                <input type="text" class="form-control" name="bank_name" id="bank_name" required="" placeholder="<?php echo display('bank_name') ?>" tabindex="1"/>

                            </div>

                        </div>



                        <div class="form-group row">

                            <label for="ac_name" class="col-sm-3 col-form-label"><?php echo display('ac_name') ?> <i class="text-danger">*</i></label>

                            <div class="col-sm-6">

                                <input type="text" class="form-control" name="ac_name" id="ac_name" required="" placeholder="<?php echo display('ac_name') ?>" tabindex="2"/>

                            </div>

                        </div>



                        <div class="form-group row">

                            <label for="ac_no" class="col-sm-3 col-form-label"><?php echo display('ac_no') ?> <i class="text-danger">*</i></label>

                            <div class="col-sm-6">

                                <input type="text" class="form-control" name="ac_no" id="ac_no" required="" placeholder="<?php echo display('ac_no') ?>" tabindex="3"/>

                            </div>

                        </div>



                        <div class="form-group row">

                            <label for="branch" class="col-sm-3 col-form-label"><?php echo display('branch') ?> <i class="text-danger">*</i></label>

                            <div class="col-sm-6">

                                <input type="text" class="form-control" name="branch" id="branch" required="" placeholder="<?php echo display('branch') ?>" tabindex="4"/>

                            </div>

                        </div>



                        <div class="form-group row">

                            <label for="signature_pic" class="col-sm-3 col-form-label"><?php echo display('signature_pic') ?></label>

                            <div class="col-sm-6">

                                <input type="file" class="form-control" name="signature_pic" id="signature_pic" placeholder="<?php echo display('signature_pic') ?>" tabindex="5"/>

                            </div>

                        </div>

                   

                    </div>

                    

                        </div>



                        <div class="modal-footer">

                            

                            <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>

                            
                            <input type="submit" id="add-deposit" class="btn btn-success" name="add-deposit" value="<?php echo display('save') ?>" tabindex="6"/>
                           <!--  <input type="submit" class="btn btn-success" value="Submit"> -->

                        </div>

                        <?php echo form_close() ?>

                    </div><!-- /.modal-content -->

                </div><!-- /.modal-dialog -->

            </div><!-- /.modal -->
  <!------ add new customer -->  

    <div class="modal fade modal-success" id="cust_info" role="dialog">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            

                            <a href="#" class="close" data-dismiss="modal">&times;</a>

                            <h3 class="modal-title"><?php echo display('add_new_customer') ?></h3>

                        </div>

                        

                        <div class="modal-body">

                            <div id="customeMessage" class="alert hide"></div>

                       <?php echo form_open('Cinvoice/instant_customer', array('class' => 'form-vertical', 'id' => 'newcustomer')) ?>

                    <div class="panel-body">

                        <input type ="hidden" name="csrf_test_name" id="" value="<?php echo $this->security->get_csrf_hash();?>">

                        <div class="form-group row">

                            <label for="customer_name" class="col-sm-3 col-form-label"><?php echo display('customer_name') ?> <i class="text-danger">*</i></label>

                            <div class="col-sm-6">

                                <input class="form-control" name ="customer_name" id="" type="text" placeholder="<?php echo display('customer_name') ?>"  required="" tabindex="1">

                            </div>

                        </div>



                        <div class="form-group row">

                             <label for="customer_email" class="col-sm-3 col-form-label">
                                Customer <br>Email
                              <i class="text-danger">*</i></label>

                            <div class="col-sm-6">

                                <input class="form-control" name ="email" id="email" type="email" placeholder="<?php echo display('customer_email') ?>" required tabindex="2"> 

                            </div>

                        </div>



                        <div class="form-group row">

                            <label for="mobile" class="col-sm-3 col-form-label"><?php echo display('customer_mobile') ?><i class="text-danger">*</i></label>

                            <div class="col-sm-6">

                                <input class="form-control" name ="mobile" id="mobile" type="number" placeholder="<?php echo display('customer_mobile') ?>" min="0" tabindex="3" required>

                            </div>

                        </div>



                        <div class="form-group row">

                            <label for="address " class="col-sm-3 col-form-label"><?php echo display('customer_address') ?><i class="text-danger">*</i></label>

                            <div class="col-sm-6">

                                <textarea class="form-control" required name="address" id="address " rows="3" placeholder="<?php echo display('customer_address') ?>" tabindex="4"></textarea>

                            </div>

                        </div>

                      

                    </div>

                    

                        </div>



                        <div class="modal-footer">

                            

                            <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>

                            

                            <input type="submit" class="btn btn-success" onClick="refreshPage()" value="Submit">

                        </div>

                        <?php echo form_close() ?>

                    </div><!-- /.modal-content -->

                </div><!-- /.modal-dialog -->

            </div><!-- /.modal -->

         




<!------ add new Payment Type -->  
          <div class="modal fade modal-success" id="payment_type" role="dialog">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            

                            <a href="#" class="close" data-dismiss="modal">&times;</a>

                            <h3 class="modal-title">Add New Payment Type</h3>

                        </div>

                        

                        <div class="modal-body">

                            <div id="customeMessage" class="alert hide"></div>

                       <?php echo form_open('Cinvoice/instant_customer', array('class' => 'form-vertical', 'id' => 'newcustomer')) ?>

                    <div class="panel-body">

 <input type ="hidden" name="csrf_test_name" id="" value="<?php echo $this->security->get_csrf_hash();?>">

                        <div class="form-group row">

                            <label for="customer_name" class="col-sm-3 col-form-label">New Payment Type <i class="text-danger">*</i></label>

                            <div class="col-sm-6">

                                <input class="form-control" name ="new_payment_type" id="" type="text" placeholder="New Payment Type"  required="" tabindex="1">

                            </div>

                        </div>


                    </div>

                    

                        </div>



                        <div class="modal-footer">

                            

                            <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>

                            

                            <input type="submit" class="btn btn-success" value="Submit">

                        </div>

                        <?php echo form_close() ?>

                    </div><!-- /.modal-content -->

                </div><!-- /.modal-dialog -->

            </div><!-- /.modal -->


        </div>

    </section>

</div>
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="formModalLabel">Contact Us</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-success hidden" id="contactSuccess">
					<strong>Success!</strong> Your message has been sent to us.
				</div>

				<div class="alert alert-danger hidden" id="contactError">
					<strong>Error!</strong> There was an error sending your message.
				</div>
             
			
					<div class="row">
						<div class="form-group">
							<div class="col-md-6">
								<label>Your name *</label>
								<input type="text"  data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name_email" required>
							</div>
							<div class="col-md-6">
								<label>Your email address *</label>
								<input type="email"  data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email_info" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>Subject</label>
								<input type="text"  data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="subject" id="subject_email" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>Message *</label>
								<textarea maxlength="5000" data-msg-required="Please enter your message." rows="10" class="form-control" name="message" id="message_email" required></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<input type="submit" value="Send Message" id="email_send" name="email_send" class="btn btn-primary btn-lg mb-xlg" data-loading-text="Loading...">
						</div>
					</div>
                   

			</div>
		</div>
	</div>
</div>
<!-- start Modal for all action -->
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="    margin-top: 190px;">
        <div class="modal-header" style="">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Sale</h4>
        </div>
        <div class="modal-body">
          
          <h4>Sales Invoice  Created Succefully</h4>
     
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
      
    </div>
  </div>

  <!-- End Modal for all action -->
<!-- Invoice Report End -->



<div id="packmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="width: 130%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Choose your Package </h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
            <tr>
                <th>Choose your Package   </th>
                <th>Sno</th>
                <th>Novice No</th>
                <th>Sales Packing ID</th>
                <th>Gross Weight</th>
                <th>Container NO</th>
                   <th>Thickness</th>
                 <th>Invoice Date</th>               
            </tr>
            <?php 
            $i=0;
            foreach($packinglist as $pack)
                { ?>

            <tr>
                <td><input type="radio" name="packing" id="packing" onclick="packing('<?php echo $pack['invoice_no']; ?>')" ></td>
                <td><?php echo $j=$i+1; ?></td>
                <td><?php echo $pack['invoice_no']; ?></td>
                <td><?php echo $pack['expense_packing_id']; ?></td>
                <td><?php echo $pack['gross_weight']; ?></td>
                
                <td><?php echo $pack['container_no']; ?></td>
                <td><?php echo $pack['thickness']; ?></td>
                <td><?php echo $pack['invoice_date']; ?></td>

            </tr>
        <?php $i++; } ?>
        </table>
      </div>
      
    </div>

  </div>
</div>
<script type="text/javascript">
    $('#add_purchase').on('click', function() {
    $('#send_email1').show();
    $('#send_email2').show();
    $('#send_email3').show();
    
    });
     $(function() { 
        $('#send_email1').hide();
        $('#send_email2').hide();
        $('#send_email3 ').hide();

       var data = {
    
       };

       data[csrfName] = csrfHash;
   
       $.ajax({
           type:'POST',
           data: data, 
          dataType:"json",
           url:'<?php echo base_url();?>Cinvoice/get_email_data',
           success: function(result, statut) {
            console.log(result);
               if(result.csrfName){
                  csrfName = result.csrfName;
                  csrfHash = result.csrfHash;
               }
               $('#name_email').val(result[0]['greeting']);
               $('#subject_email').val(result[0]['subject']);
               $('#message_email').html(result[0]['message']);
           }
       });
   });


      $('.product_name').on('select', function () {
       console.log('You selected: ' + this.value);
    }).change();
    $('#customer_name').change(function(e){
       
    var data = {
      
        value:$(this).val()
    };
    data[csrfName] = csrfHash;

    $.ajax({
        type:'POST',
        data: data, 
       dataType:"json",
        url:'<?php echo base_url();?>Cinvoice/getcustomer_data',
        success: function(result, statut) {
            if(result.csrfName){
               csrfName = result.csrfName;
               csrfHash = result.csrfHash;
            }
            $('#billing_address').html(result[0]['customer_address']+'\n'+result[0]['customer_email']+'\n'+result[0]['phone']);
    $('#email_info').val(result[0]['customer_email']);
        }
    });
});

</script>

<script type="text/javascript">

    $('#add_purchase').on('click', function() {

    $('#download_pdf').show();   

    });



</script>


<script type="text/javascript">
     $('#number_of_days').change(function(){
      
       var data = {
           sales_invoice_date : $('#date').val(),
           days : $(this).val(),   
           pterms : $('#payment_terms').val()
       
       };
       data[csrfName] = csrfHash;
   
       $.ajax({
           type:'POST',
           data: data, 
          dataType:"json",
           url:'<?php echo base_url();?>Cinvoice/getdate',
           success: function(result, statut) {
               if(result.csrfName){
                  csrfName = result.csrfName;
                  csrfHash = result.csrfHash;
               }
              $('#date1').val(result);
          }
       });
   });
 

   function addInputField(t) {
    //debugger;
    var row = $("#normalinvoice tbody tr").length;
    var count = row + 1;
      var  tab1 = 0;
      var  tab2 = 0;
      var  tab3 = 0;
      var  tab4 = 0;
      var  tab5 = 0;
      var  tab6 = 0;
      var  tab7 = 0;
      var  tab8 = 0;
      var  tab9 = 0;
      var  tab10 = 0;
      var  tab11 = 0;
      var  tab12 = 0;
    var limits = 500;
     var taxnumber = $("#txfieldnum").val();
    var tbfild ='';
    for(var i=0;i<taxnumber;i++){
        var taxincrefield = '<input id="total_tax'+i+'_'+count+'" class="total_tax'+i+'_'+count+'" type="hidden"><input id="all_tax'+i+'_'+count+'" class="total_tax'+i+'" type="hidden" name="tax[]">';
         tbfild +=taxincrefield;
    }
    if (count == limits)
        alert("You have reached the limit of adding " + count + " inputs");
    else {
        var a = "product_name_" + count,
                tabindex = count * 6,
                e = document.createElement("tr");
        tab1 = tabindex + 1;
        tab2 = tabindex + 2;
        tab3 = tabindex + 3;
        tab4 = tabindex + 4;
        tab5 = tabindex + 5;
        tab6 = tabindex + 6;
        tab7 = tabindex + 7;
        tab8 = tabindex + 8;
        tab9 = tabindex + 9;
        tab10 = tabindex + 10;
        tab11 = tabindex + 11;
        tab12 = tabindex + 12;
        e.innerHTML = "<td><select name='prodt[]' id='prodt_" + count + "' class='form-control product_name' onchange='available_quantity("+ count +");'>"+
        "<option value='Select the Product' selected>Select the Product</option><?php  foreach($product as $tx){?>"+
       " <option value='<?php echo $tx['product_name'].'-'.$tx['product_model'];?>'>  <?php echo $tx['product_name'].'-'.$tx['product_model'];  ?></option>"+
        "<?php } ?> </select><input type='hidden' class='common_product autocomplete_hidden_value  product_id_" + count + "' name='product_id[]' id='SchoolHiddenId' /></td><td><input type='text' name='available_quantity[]' id='available_quantity[]' class='form-control text-right common_avail_qnt available_quantity_" + count + "' value='0' readonly='readonly' /></td><td> <input type='text' name='product_quantity[]' id='cartoon_" + count + "'  required='required' onkeyup='total_amt(" + count + ");'  onchange='total_amt(" + count + ");' id='total_qntt_" + count + "' class='common_qnt total_qntt_" + count + " form-control text-right'  placeholder='0.00' min='0' tabindex='" + tab3 + "'/></td><td> <span class='form-control' style='background-color: #eee;'><?php  echo $currency." ";  ?><input type='text' name='product_rate[]' id='product_rate_" + count + "' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='price_item_" + count + "' class='common_rate price_item" + count + "' required placeholder='0.00' min='0' tabindex='" + tab4 + "'/></span></td><td class='text-right'> <span class='form-control' style='background-color: #eee;'><?php  echo $currency." ";  ?><input class='common_total_price total_price' type='text' name='total_price[]' id='total_price_" + count + "' value='0.00' readonly='readonly'/></span></td><td>"+tbfild+"<input type='hidden' id='all_discount_" + count + "' class='total_discount dppr' name='discount_amount[]'/><button tabindex='" + tab5 + "' style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'><i class='fa fa-close'></i></button></td>",
                document.getElementById(t).appendChild(e),
                document.getElementById(a).focus(),
                document.getElementById("add_invoice_item").setAttribute("tabindex", tab6);
                document.getElementById("details").setAttribute("tabindex", tab7);
                document.getElementById("invoice_discount").setAttribute("tabindex", tab8);
                document.getElementById("shipping_cost").setAttribute("tabindex", tab9);    
                document.getElementById("paidAmount").setAttribute("tabindex", tab10);
                document.getElementById("full_paid_tab").setAttribute("tabindex", tab11);
                document.getElementById("add_invoice").setAttribute("tabindex", tab12);
                count++
    }
}
$('#email_send').click(function(){
      
      var data = {
        mailid:$('#email_info').val(),
        name_email:$('#name_email').val(),
        subject_email:$('#subject_email').val(),
        message_email:$('#message_email').val()
      };
      data[csrfName] = csrfHash;
  
      $.ajax({
          type:'POST',
          data: data, 
         dataType:"json",
          url:'<?php echo base_url();?>Cinvoice/sendmail',
          success: function(result, statut) {
              if(result.csrfName){
                 csrfName = result.csrfName;
                 csrfHash = result.csrfHash;
              }
              console.log(result);
            // $('#date1').val(result);
         }
      });
  });


</script>

<script>
function refreshPage(){
    window.location.reload();
} 

// function refresh(){
//     window.location.href = "<?php echo base_url('Cinvoice/manage_invoice'); ?>";

// }
</script>


<script type="text/javascript">
$(document).ready(function () {
    $("#add_purchase").click(function () {
        $("#save_another").toggle();
    });
});

$(document).ready(function () {
    $("#add_purchase").click(function () {
        $("#download").toggle();
    });
});

function packing(id)
{
    $('#packing_id').val(id);
    alert('packing linked with your Invoice Please countinue the Invoice');
     $("#packmodal").modal('hide');
     $("#packbutton").hide();
}

</script>
<script type="text/javascript">
    
</script>








