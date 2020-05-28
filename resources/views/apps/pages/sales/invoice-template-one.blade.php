@extends('apps.layout.master')
@section('title','invoice template')
@section('content')
<section id="form-action-layouts">
<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>

    <div class="row" @if($userguideInit==1) data-step="1" data-intro="In this section you see all information." @endif>
        <div class="col-lg-3">
            <div class="col-md-12" style="border-bottom: 5px #000 solid; font-size: 25px; font-weight: bold; padding-left: 0px;">
                <?=date('d.m.Y',strtotime($invoice->created_at))?>            
            </div>
            <div class="col-md-12" style="padding-top: 20px; padding-bottom: 4px; color: #000; padding-left: 0px;">
                <b>Customer Info</b>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                {{$customer->name}}            
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->address}}              
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->email}}              
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->phone}}              
            </div>

            <div class="col-md-12" style="padding-top: 21px; padding-bottom: 5px; padding-left: 0px; font-size: 15px;">
                <b>Ship To :</b>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                {{$customer->name}}            
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->address}}            
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->email}}            
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->phone}}            
            </div>


            <div class="col-md-12" style="padding-top: 35px; padding-bottom: 5px; padding-left: 0px; font-size: 15px;">
                <b>Payment Method :</b>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                {{$invoice->tender}}            
            </div>

            <div class="col-md-12" style="padding-top: 30px; padding-bottom: 4px; padding-left: 0px;">
                <img width="200" src="{{url('company/'.$invInfo->logo)}}" alt="Logo">
            </div>

        </div>
        <div class="col-lg-9">
            <div class="col-md-12" style="border-bottom: 5px #000 solid; color: #008000; font-size: 25px; font-weight: bold; padding-left: 0px;">
                {{$invInfo->company_name}}
            </div>
            <div class="col-md-12" style="padding-top: 10px; padding-bottom: 5px; padding-left: 0px; font-size: 15px;">
                <b>{{$invInfo->company_thank_you_message}}</b>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                {{$invInfo->company_services}}
            </div>
            <style type="text/css">
                table{ border: 1px #000 solid !important; }
                .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
                    border: 1px solid #000;
                }
            </style>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; padding-left: 0px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-xs-center">Item Number</th>
                            <th class="text-xs-center">Description</th>
                            <th class="text-xs-center">Price</th>
                            <th class="text-xs-center">Quantity</th>
                            <th class="text-xs-center">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($invoice_product))
                            @foreach($invoice_product as $inv)
                                <tr>
                                    <td class="text-xs-center">{{$inv->id}}</td>
                                    <td>{{$inv->product_name}}</td>
                                    <td class="text-xs-center">{{number_format($inv->price,2)}}</td>
                                    <td class="text-xs-center">{{$inv->quantity}}</td>
                                    <td class="text-xs-center">{{number_format($inv->total_price,2)}}</td>
                                </tr>
                            @endforeach
                        @endif

                        <?php 
                        if(count($invoice_product)<15)
                        {
                            $newRowCreate=15-count($invoice_product);
                            for($i=1; $i<=$newRowCreate; $i++):   
                            ?>
                            <tr>
                                    <td class="text-xs-center">&nbsp;</td>
                                    <td></td>
                                    <td class="text-xs-center"></td>
                                    <td class="text-xs-center"></td>
                                    <td class="text-right"></td>
                            </tr>
                            <?php
                            endfor;
                        }
                        ?>
                            
                        <tr style="border-bottom: 5px #000 solid;">
                            <td>Subtotal </td>
                            <td>Total Item : {{count($invoice_product)}}</td>
                            <td></td>
                            <td></td>
                            <td class="text-xs-center"><b> {{number_format((($invoice->total_amount+$invoice->discount_total)-$invoice->total_tax),2)}}</b></td>
                        </tr>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" rowspan="5"> Sales  Tax Rate: {{number_format($invoice->tax_rate,2)}}% 
                            <br>
                            <br>
                            @if($invoice->discount_type==1)
                                Discount Amount is {{number_format($invoice->discount_total, 2)}}
                            @elseif($invoice->discount_type==2)
                                Discount Rate : {{number_format($invoice->sales_discount, 2).'%'}}
                            @endif
                            </td>
                            <td colspan="2" class="text-right">Sales Tax  (+)</td>
                            <td class="text-xs-center">{{number_format($invoice->total_tax,2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right"> Discount (-)</td>
                            <td class="text-xs-center">{{number_format($invoice->discount_total,2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">Invoice Total</td>
                            <td class="text-xs-center" style="border-bottom: 5px #000 solid;"><b>{{number_format($invoice->total_amount,2)}}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">Paid Amount</td>
                            <td class="text-xs-center">{{number_format($invoice_payment,2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">Invoice Due</td>
                            <td class="text-xs-center" style="border-bottom: 5px #000 solid;">
                                @if(($invoice->total_amount-$invoice_payment)>0)
                                {{number_format(($invoice->total_amount-$invoice_payment),2)}}
                                @else
                                    0.00
                                @endif
                            </td>
                        </tr>
                    </tfoot>


                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="padding-left: 5px; padding-top: 15px;">
            <div class="col-md-12 text-xs-center">
                <b>{{$invInfo->mm_one}}</b>
            </div>
            <div class="col-md-12 text-xs-center">
                <b>{{$invInfo->mm_two}}</b>
            </div>
            <div class="col-md-12 text-xs-center">
                <b>{{$invInfo->mm_three}}</b>
            </div>
            <div class="col-md-12 text-xs-center">
                <b>{{$invInfo->mm_four}}</b>
            </div>
            <div class="col-md-11 text-left" style="padding-left: 0px; border-bottom: 3px #000 solid; font-size: 28px; color: #008000;">
                <b>{{$invInfo->fotter_company_name}}</b>
            </div>
            <div class="col-md-1 text-left" style="padding-left: 0px; font-size: 28px; color: #008000;">
                <img width="80" src="{{url('company/'.$invInfo->logo_fotter)}}" style="margin-top: 21px;">
            </div>
            <div class="col-md-12" style="clear: both;">
                <div class="col-md-3 text-xs-center">
                    {{$invInfo->c_one}}
                </div>
                <div class="col-md-5 text-xs-center">
                    {{$invInfo->c_two}}
                </div>
                <div class="col-md-4 text-xs-center">
                    {{$invInfo->c_three}}
                </div>

                <div class="col-md-3 text-xs-center">
                   {{$invInfo->c_four}}
                </div>
                <div class="col-md-5 text-xs-center">
                    {{$invInfo->c_five}}
                </div>
                <div class="col-md-4 text-xs-center">
                    {{$invInfo->c_six}}
                </div>
            </div>
            <div class="col-md-12" style="border-bottom: 5px #000 solid; clear: both; margin-top: 15px;">

            </div>
        </div>
    </div><br>
    
    <!-- Invoice Footer -->
    <div id="invoice-footer" style="padding-bottom:100px;">
        <div class="row">
            <div class="text-xs-center">
                <a class="btn btn-primary" @if($userguideInit==1) data-step="2" data-intro="Please click here if you want to modify your invoice." @endif href="{{url('sales/edit/'.$invoice->id)}}"> <i class="icon-open"></i>  Edit Invoice</a>

                <a class="btn btn-success" @if($userguideInit==1) data-step="3" data-intro="please click here if you want to print your invoice." @endif  href="{{url('sales/invoice/print/pdf/'.$invoice->id)}}"> <i class="icon-printer3"></i>  Print</a>
            </div>
    </div>
    <!--/ Invoice Footer -->


</div>
</div>
</div>
</div>
</div>








</section>
@endsection
