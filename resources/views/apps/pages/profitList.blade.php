@extends('apps.layout.master')
@section('title','Profit List')
@section('content')
<section id="form-action-layouts">


		<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Profit List</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
						<fieldset class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <h4>Start Date</h4>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar3"></i></span>
                                        <input type="text" class="form-control dp-date-range-from" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <h4>Start End</h4>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar3"></i></span>
                                        <input type="text" class="form-control dp-date-range-to" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <h4>Invoice ID</h4>
                                    <div class="input-group">
									<input type="text" id="eventRegInput1" class="form-control border-primary" placeholder="Invoice ID" name="name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h4>Product List</h4>
                                    <div class="input-group">
									<select class="select2 form-control">
											<optgroup label="Alaskan/Hawaiian Time Zone">
												<option value="AK">Alaska</option>
												<option value="HI">Hawaii</option>
											</optgroup>
											<optgroup label="Pacific Time Zone">
												<option value="CA">California</option>
												<option value="NV">Nevada</option>
												<option value="OR">Oregon</option>
												<option value="WA">Washington</option>
											</optgroup>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="MT">Montana</option>
												<option value="NE">Nebraska</option>
												<option value="NM">New Mexico</option>
												<option value="ND">North Dakota</option>
												<option value="UT">Utah</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="AR">Arkansas</option>
												<option value="IL">Illinois</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
												<option value="LA">Louisiana</option>
												<option value="MN">Minnesota</option>
												<option value="MS">Mississippi</option>
												<option value="MO">Missouri</option>
												<option value="OK">Oklahoma</option>
												<option value="SD">South Dakota</option>
												<option value="TX">Texas</option>
												<option value="TN">Tennessee</option>
												<option value="WI">Wisconsin</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="DE">Delaware</option>
												<option value="FL">Florida</option>
												<option value="GA">Georgia</option>
												<option value="IN">Indiana</option>
												<option value="ME">Maine</option>
												<option value="MD">Maryland</option>
												<option value="MA">Massachusetts</option>
												<option value="MI">Michigan</option>
												<option value="NH">New Hampshire</option>
												<option value="NJ">New Jersey</option>
												<option value="NY">New York</option>
												<option value="NC">North Carolina</option>
												<option value="OH">Ohio</option>
												<option value="PA">Pennsylvania</option>
												<option value="RI">Rhode Island</option>
												<option value="SC">South Carolina</option>
												<option value="VT">Vermont</option>
												<option value="VA">Virginia</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    
                                    <div class="input-group" style="margin-top: 27px;">
                                        <button type="submit" class="btn btn-primary">
									<i class="icon-check2"></i> Generate Report
								</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Both borders end-->
<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-clear_all"></i> Profit List</h4>
				<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        		<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
						<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-body collapse in">
				<div class="table-responsive">
					<table class="table table-bordered mb-0">
						<thead>
							<tr>
								<th>INVOICE ID</th>
								<th>INVOICE DATE</th>
								<th>SOLD TO</th>
								<th>INVOICE TOTAL AMOUNT</th>
								<th>TOTAL COST AMOUNT</th>
								<th>PROFIT</th>
							</tr>
						</thead>
						<tbody>
							<tr>
                                <td>1518120286</td>
                                <td>2018-02-08 01:04:46 PM</td>
                                <td>iGeek Eastpointe</td>
                                <td>461.00</td>
                                <td>386.00</td>
                                <td>75.00</td>
                            </tr>
							<tr>
                                <td>1518120286</td>
                                <td>2018-02-08 01:04:46 PM</td>
                                <td>iGeek Eastpointe</td>
                                <td>461.00</td>
                                <td>386.00</td>
                                <td>75.00</td>
                            </tr>
                            <tr>
                                <td>1518120286</td>
                                <td>2018-02-08 01:04:46 PM</td>
                                <td>iGeek Eastpointe</td>
                                <td>461.00</td>
                                <td>386.00</td>
                                <td>75.00</td>
                            </tr>
                            <tr>
                                <td>1518120286</td>
                                <td>2018-02-08 01:04:46 PM</td>
                                <td>iGeek Eastpointe</td>
                                <td>461.00</td>
                                <td>386.00</td>
                                <td>75.00</td>
                            </tr>
                            <tr>
                                <td>1518120286</td>
                                <td>2018-02-08 01:04:46 PM</td>
                                <td>iGeek Eastpointe</td>
                                <td>461.00</td>
                                <td>386.00</td>
                                <td>75.00</td>
                            </tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Both borders end -->
<div class="row">
	<div class="col-xs-6">
		<div class="card-block">
		    <ul class="list-group">
		    	<a href="#" class="list-group-item active">Invoice Total</a>
		        <li class="list-group-item">
		            <span class="tag tag-primary tag-pill float-xs-right">849870.24</span> <a href="#">Total Invoice </a>
		        </li>
		        <li class="list-group-item">
		            <span class="tag tag-info tag-pill float-xs-right">833886.94</span> <a href="#"> Total Cost</a>
		        </li>
		        <li class="list-group-item">
		            <span class="tag tag-warning tag-pill float-xs-right">15983.3</span> <a href="#"> Profit</a>
		        </li>
		    </ul>
		</div>
	</div>
</div>		


</section>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/ui/jquery-ui.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/plugins/ui/jqueryui.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/selects/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/pages/invoice.min.css')}}">
@endsection

@section('js')
<script src="{{url('theme/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js')}}" type="text/javascript">
	
</script>
<script src="{{url('theme/app-assets/js/scripts/ui/jquery-ui/date-pickers.min.js')}}" type="text/javascript">
	
</script>
<script src="{{url('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>
@endsection