@extends('apps.layout.master')
@section('title','Sales Invoice')
@section('content')
		<section class="card">
		<div id="invoice-template" class="card-block">
			<!-- Invoice Company Details -->
			<div id="invoice-company-details" class="row">
				<div class="col-md-6 col-sm-12 text-xs-center text-md-left">
					<img height="70" src="{{url('company/'.$invInfo->logo)}}" alt="company logo" class="">
					<ul class="px-0 list-unstyled">
						<li class="text-bold-800">{{$invInfo->company_name}}</li>
						<li>{{$invInfo->address}}</li>
						<li>{{$invInfo->city}}</li>
						<li>{{$invInfo->state}}</li>
						<li>{{$invInfo->country}}</li>
					</ul>
				</div>
				<div class="col-md-6 col-sm-12 text-xs-center text-md-right">
					<h2>INVOICE</h2>
					<p class="pb-3"># INV-{{$invoice->id}}</p>
					<ul class="px-0 list-unstyled">
						<li>Invoice Total</li>
						<li class="lead text-bold-800">$ {{$invoice->total_amount}}</li>
					</ul>
				</div>
			</div>
			<!--/ Invoice Company Details -->

			<!-- Invoice Customer Details -->
			<div id="invoice-customer-details" class="row pt-2">
				<div class="col-sm-12 text-xs-center text-md-left">
					<p class="text-muted">Bill To</p>
				</div>
				<div class="col-md-6 col-sm-12 text-xs-center text-md-left">
					<ul class="px-0 list-unstyled">
						<li class="text-bold-800"><i class="icon-user"></i> {{$customer->name}}</li>
						<li>{{$customer->address}},</li>
						<li><i class="icon-phone-square"></i> {{$customer->phone}},</li>
						<li><i class="icon-envelope"></i> {{$customer->email}}</li>
					</ul>
				</div>
				<div class="col-md-6 col-sm-12 text-xs-center text-md-right">
					<p><span class="text-muted">Invoice Date </span> <br> 
						<span class="text-bold-800">{{$invoice->created_at}}</span></p>
					<p><span class="text-muted">Tender </span> <br> 
						<span class="text-bold-800">{{$invoice->tender}}</span></p>
				</div>
			</div>
			<!--/ Invoice Customer Details -->

			<!-- Invoice Items Details -->
			<div id="invoice-items-details" class="pt-2">
				<div class="row">
					<div class="table-responsive col-sm-12">
						<table class="table">
						  <thead>
						    <tr>
						      <th>Item ID</th>
						      <th>Description</th>
						      <th class="text-xs-right">Price</th>
						      <th class="text-xs-right">Quantity</th>
						      <th class="text-xs-right">Amount</th>
						    </tr>
						  </thead>
						  <tbody>
						    @if(isset($invoice_product))
							    @foreach($invoice_product as $inv)
								    <tr>
								      <th scope="row">{{$inv->product_id}}</th>
								      <td>
								      	<p>{{$inv->product_name}}</p>
								      </td>
								      <td class="text-xs-right">{{number_format($inv->price,2)}}</td>
								      <td class="text-xs-right">{{$inv->quantity}}</td>
								      <td class="text-xs-right">{{number_format($inv->total_price,2)}}</td>
								    </tr>
							    @endforeach
						    @endif
						  </tbody>
						  <tfoot>
						  	<tr>
						      <th>Subtotal</th>
						      <th> </th>
						      <th class="text-xs-right">Total Item</th>
						      <th class="text-xs-right">={{count($invoice_product)}}</th>
						      <th class="text-xs-right"></th>
						    </tr>
						  </tfoot>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-7 col-sm-12 text-xs-center text-md-left">
						<p>&nbsp;</p>
			            <div class="col-md-12 text-xs-center">
			                <span style="font-weight: bolder;">{{$invInfo->mm_one}}</span>
			            </div>
			            <div class="col-md-12 text-xs-center">
			                <span style="font-weight: bolder;">{{$invInfo->mm_two}}</span>
			            </div>
			            <div class="col-md-12 text-xs-center">
			                <span style="font-weight: bolder;">{{$invInfo->mm_three}}</span>
			            </div>
			            <div class="col-md-12 text-xs-center">
			                <span style="font-weight: bolder;">{{$invInfo->mm_four}}</span>
			            </div>


					</div>
					<div class="col-md-5 col-sm-12">
						<div class="table-responsive">
							<table class="table">
							  <tbody>
							  	<tr>
							  		<td>Sub Total</td>
							  		<td class="text-xs-right">{{number_format($invoice->total_amount,2)}}</td>
							  	</tr>
							  	<tr>
							  		<td><span class="green">(+)</span> Sales TAX (0%)</td>
							  		<td class="text-xs-right">0.00</td>
							  	</tr>
							  	<tr>
							  		<td class="text-bold-800">Total</td>
							  		<td class="text-bold-800 text-xs-right"> {{number_format($invoice->total_amount,2)}}</td>
							  	</tr>
							  	<tr>
							  		<td><span class="pink">(-)</span> Less Deposit Received</td>
							  		<td class="green text-xs-right"> 0.00</td>
							  	</tr>
							  	<tr class="bg-grey bg-lighten-4">
							  		<td class="text-bold-800">Invoice Total</td>
							  		<td class="text-bold-800 text-xs-right">{{number_format($invoice->total_amount,2)}}</td>
							  	</tr>
							  </tbody>
							</table>
						</div>
						
					</div>
				</div>
			</div>

			

		</div>
	</section>

	<div class="row" style="padding-bottom: 30px;">
		<div class="col-md-12 text-xs-center text-md-center">

										<a class="btn btn-success" href="{{url('sales/invoice/print/pdf/'.$invoice->id)}}">
											<i class="icon-printer3"></i> Print
										</a>

										<a class="btn btn-primary" href="{{url('sales/edit/'.$invoice->id)}}" style="color: #fff;">
											<i class="icon-edit2"></i> Edit Invoice
										</a>
									
					
		</div>
	</div>

@endsection