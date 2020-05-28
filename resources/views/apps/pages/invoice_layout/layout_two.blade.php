@extends('apps.layout.master')
@section('title','Invoice Template')
@section('content')
<section id="form-action-layouts">
	<style type="text/css">
    
    .box-overflow
    {
        height:  100%;
        width:  100%;
        position: absolute;
        top: 0px;
        color: #000;
        text-align: center;
        font-weight: 900;
    }

    .box-overflow > a
    {
        display: block;
        height: 100%;
        padding-top: 5px;
    }    
    
    .uploadNewImage
    {
        opacity: 0;
    }

    .make-def-photo > img
    {
        width: 80%;
        height: 80%;

    }

    </style>

    <form  enctype="multipart/form-data" action="{{url('pos/settings/invoice/save/'.$id)}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$id}}">
	<div class="content-body"><section class="card">
		<div id="invoice-template" class="card-block">
			<!-- Invoice Company Details -->
			<div id="invoice-company-details" class="row">
				<div class="col-md-6 col-sm-12 text-xs-center text-md-left">
					<div class="make-def-photo" style="width: 150px; padding: 0px; margin:0px;">
						<img id="logo" src="{{url('company/'.$edit->logo)}}" alt="company logo" class="">
						<input type="file" data-id="logo" name="logo" class="uploadNewImage"  accept="image/*" onchange="loadFile(event,this)">
						<input type="hidden" name="ex_logo" value="{{$edit->logo}}">
               			 <div class="box-overflow" style="width: 100px; height: 100px;"><a href="javascript:void(0);" class="upload_image"><i class="icon-edit2"></i> Upload</a></div>
					</div>
					<ul class="px-0 list-unstyled">
						<li class="text-bold-800">
							<span>{{$edit->company_name}}</span>
							<input size="40" type="text" class="text_changer" value="{{$edit->company_name}}" name="company_name" style="display: none;">
                			<a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
						</li>
						<li>
							<span>{{$edit->address}}</span>
							<input size="40" type="text" class="text_changer" value="{{$edit->address}}" name="address" style="display: none;">
                			<a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
						</li>
						<li>
							<span>{{$edit->city}}</span>
							<input size="40" type="text" class="text_changer" value="{{$edit->city}}" name="city" style="display: none;">
                			<a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
						</li>
						<li>
							<span>{{$edit->state}}</span>
							<input size="40" type="text" class="text_changer" value="{{$edit->state}}" name="state" style="display: none;">
                			<a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
						</li>
						<li>
							<span>{{$edit->country}}</span>
							<input size="40" type="text" class="text_changer" value="{{$edit->country}}" name="country" style="display: none;">
                			<a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
						</li>
					</ul>
				</div>
				<div class="col-md-6 col-sm-12 text-xs-center text-md-right">
					<h2>INVOICE</h2>
					<p class="pb-3"># INV-001001</p>
					<ul class="px-0 list-unstyled">
						<li>Balance Due</li>
						<li class="lead text-bold-800">$ 12,000.00</li>
					</ul>
				</div>
			</div>
			<!--/ Invoice Company Details -->

			<!-- Invoice Customer Details -->
			<div id="invoice-customer-details" class="row pt-2">
				<div class="col-sm-12 text-xs-center text-md-left">
					<p class="text-muted">Bill To <code>Not Editable</code></p>
				</div>
				<div class="col-md-6 col-sm-12 text-xs-center text-md-left">
					<ul class="px-0 list-unstyled">
						<li class="text-bold-800">Mr. Bret Lezama</li>
						<li>4879 Westfall Avenue,</li>
						<li>Albuquerque,</li>
						<li>New Mexico-87102.</li>
					</ul>
				</div>
				<div class="col-md-6 col-sm-12 text-xs-center text-md-right">
					<code>Not Editable</code>
					<p><span class="text-muted">Invoice Date :</span> 06/05/2016</p>
					<p><span class="text-muted">Terms :</span> Due on Receipt</p>
					<p><span class="text-muted">Due Date :</span> 10/05/2016</p>
				</div>
			</div>
			<!--/ Invoice Customer Details -->
			<div class="col-md-12 text-md-center">
				<span style="font-weight: bold;">{{$edit->company_thank_you_message}}</span>
                <input size="40" type="text" class="text_changer" value="{{$edit->company_thank_you_message}}" name="company_thank_you_message" style="display: none;">
                <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
			</div>
			<!-- Invoice Items Details -->
			<div id="invoice-items-details" class="pt-2">
				<div class="row">
					<div class="table-responsive col-sm-12">
						<table class="table">
						  <thead>
						    <tr>
						      <th>#</th>
						      <th>Item &amp; Description</th>
						      <th class="text-xs-right">Rate</th>
						      <th class="text-xs-right">Hours</th>
						      <th class="text-xs-right">Amount</th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th scope="row">1</th>
						      <td>
						      	<p>Create PSD for mobile APP</p>
						      	<p class="text-muted">Simply dummy text of the printing and typesetting industry.</p>
						      </td>
						      <td class="text-xs-right">$ 20.00/hr</td>
						      <td class="text-xs-right">120</td>
						      <td class="text-xs-right">$ 2400.00</td>
						    </tr>
						    <tr>
						      <th scope="row">2</th>
						      <td>
						      	<p>iOS Application Development</p>
						      	<p class="text-muted">Pellentesque maximus feugiat lorem at cursus.</p>
						      </td>
						      <td class="text-xs-right">$ 25.00/hr</td>
						      <td class="text-xs-right">260</td>
						      <td class="text-xs-right">$ 6500.00</td>
						    </tr>
						    <tr>
						      <th scope="row">3</th>
						      <td>
						      	<p>WordPress Template Development</p>
						      	<p class="text-muted">Vestibulum euismod est eu elit convallis.</p>
						      </td>
						      <td class="text-xs-right">$ 20.00/hr</td>
						      <td class="text-xs-right">300</td>
						      <td class="text-xs-right">$ 6000.00</td>
						    </tr>
						  </tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-7 col-sm-12 text-xs-center text-md-left">
						<p>&nbsp;</p>
			            <div class="col-md-12 text-xs-center">
			                <span style="font-weight: bolder;">{{$edit->mm_one}}</span>
			                <input size="80" type="text" class="text_changer" value="{{$edit->mm_one}}" name="mm_one" style="display: none;">
			                <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
			            </div>
			            <div class="col-md-12 text-xs-center">
			                <span style="font-weight: bolder;">{{$edit->mm_two}}</span>
			                <input size="80" type="text" class="text_changer" value="{{$edit->mm_two}}" name="mm_two" style="display: none;">
			                <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
			            </div>
			            <div class="col-md-12 text-xs-center">
			                <span style="font-weight: bolder;">{{$edit->mm_three}}</span>
			                <input size="80" type="text" class="text_changer" value="{{$edit->mm_three}}" name="mm_three" style="display: none;">
			                <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
			            </div>
			            <div class="col-md-12 text-xs-center">
			                <span style="font-weight: bolder;">{{$edit->mm_four}}</span>
			                <input size="80" type="text" class="text_changer" value="{{$edit->mm_four}}" name="mm_four" style="display: none;">
			                <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
			            </div>

						
					</div>
					<div class="col-md-5 col-sm-12">
						<p class="lead">Total due</p>
						<div class="table-responsive">
							<table class="table">
							  <tbody>
							  	<tr>
							  		<td>Sub Total</td>
							  		<td class="text-xs-right">$ 14,900.00</td>
							  	</tr>
							  	<tr>
							  		<td>TAX (12%)</td>
							  		<td class="text-xs-right">$ 1,788.00</td>
							  	</tr>
							  	<tr>
							  		<td class="text-bold-800">Total</td>
							  		<td class="text-bold-800 text-xs-right"> $ 16,688.00</td>
							  	</tr>
							  	<tr>
							  		<td>Payment Made</td>
							  		<td class="pink text-xs-right">(-) $ 4,688.00</td>
							  	</tr>
							  	<tr class="bg-grey bg-lighten-4">
							  		<td class="text-bold-800">Balance Due</td>
							  		<td class="text-bold-800 text-xs-right">$ 12,000.00</td>
							  	</tr>
							  </tbody>
							</table>
						</div>
						
					</div>
				</div>
			</div>

			<div class="col-md-12" style=" clear: both; margin-bottom: 15px;">
		        <div class="col-md-12 text-xs-center">Terms &amp; Condition </div>
		        <div class="col-md-12 text-xs-center">
		            <span>{{$edit->terms}}</span>
		            <textarea cols="100" type="text" class="text_changer" name="terms" style="display: none; line-height: 1em; height: 100px;">{{$edit->terms}}</textarea>
		            <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
		        </div>
		    </div>

			<!-- Invoice Footer -->
			<div id="invoice-footer">
				<div class="row">
					<div class="col-md-7 col-sm-12">
					</div>
					<div class="col-md-5 col-sm-12 text-xs-center">
						<button type="submit" class="btn btn-info btn-lg my-1"><i class="icon-file-o"></i> Save Invoice Changes</button>
					</div>
				</div>
			</div>
			<!--/ Invoice Footer -->

		</div>
	</section>
	        </div>


	    </form>
</section>
@endsection
@section('js')
    @include('apps.include.invoice_two_js')
@endsection