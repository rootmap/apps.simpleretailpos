@extends('apps.layout.master')
@section('title','All Invoice')
@section('content')
<section id="form-action-layouts">


		<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> All Invoice</h4>
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
					<style type="text/css" media="screen">
					.picker__holder{width: 280px !important;}	
					</style>
						<div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                	<h4>Start Date</h4>
									<div class="input-group">
										<span class="input-group-addon">
											<span class="icon-calendar5"></span>
										</span>
										<input id="picker_from" class="form-control datepicker" type="date">
									</div>
								</div>
                                <div class="col-md-2">
                                	<h4>End Date</h4>
									<div class="input-group">
										<span class="input-group-addon">
											<span class="icon-calendar5"></span>
										</span>
										<input id="picker_to" class="form-control datepicker" type="date">
									</div>
								</div>
                                <div class="col-md-2">
                                    <h4>Invoice ID</h4>
                                    <div class="input-group">
									<input type="text" id="eventRegInput1" class="form-control border-primary" placeholder="Invoice ID" name="name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h4>Customer List</h4>
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
                        </div>

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
				<h4 class="card-title"><i class="icon-clear_all"></i> All Invoice List</h4>
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
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
				                <td>1518544990</td>
				                <td>2018-02-13 11:03:10 AM</td>
				                <td>iGeek Eastpointe</td>
				                <td>19.00</td>
				                <td>
				                    <button class="btn btn-warning btn-xs"><i class="icon-checkmark2"></i> Edit </button>
				                    <button class="btn btn-info btn-xs"><i class="icon-list2"></i>  Details</button>
				                    <button class="btn btn-danger btn-xs"><i class="icon-warning"></i> Delete</button>
				                </td>
				            </tr>
							<tr>
				                <td>1518544990</td>
				                <td>2018-02-13 11:03:10 AM</td>
				                <td>iGeek Eastpointe</td>
				                <td>19.00</td>
				                <td>
				                    <button class="btn btn-warning btn-xs"><i class="icon-checkmark2"></i> Edit </button>
				                    <button class="btn btn-info btn-xs"><i class="icon-list2"></i>  Details</button>
				                    <button class="btn btn-danger btn-xs"><i class="icon-warning"></i> Delete</button>
				                </td>
				            </tr>
				            <tr>
				                <td>1518544990</td>
				                <td>2018-02-13 11:03:10 AM</td>
				                <td>iGeek Eastpointe</td>
				                <td>19.00</td>
				                <td>
				                    <button class="btn btn-warning btn-xs"><i class="icon-checkmark2"></i> Edit </button>
				                    <button class="btn btn-info btn-xs"><i class="icon-list2"></i>  Details</button>
				                    <button class="btn btn-danger btn-xs"><i class="icon-warning"></i> Delete</button>
				                </td>
				            </tr>
				            <tr>
				                <td>1518544990</td>
				                <td>2018-02-13 11:03:10 AM</td>
				                <td>iGeek Eastpointe</td>
				                <td>19.00</td>
				                <td>
				                    <button class="btn btn-warning btn-xs"><i class="icon-checkmark2"></i> Edit </button>
				                    <button class="btn btn-info btn-xs"><i class="icon-list2"></i>  Details</button>
				                    <button class="btn btn-danger btn-xs"><i class="icon-warning"></i> Delete</button>
				                </td>
				            </tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Both borders end -->


</section>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/selects/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/pickers/datetime/bootstrap-datetimepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/pickers/daterange/daterangepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/plugins/pickers/daterange/daterange.min.css')}}">
@endsection

@section('js')
<script src="{{url('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{url('theme/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.39b.delay')}}" type="text/javascript"></script>
<script src="{url('theme/app-assets/vendors/js/pickers/pickadate/picker.time.js')}}" type="text/javascript"></script>
<script src="{url('theme/app-assets/vendors/js/pickers/pickadate/legacy.js')}}" type="text/javascript"></script>
<script src="{url('theme/app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/pickers/pickadate/picker.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{url('theme/app-assets/js/scripts/pickers/dateTime/picker-date-time.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->picker_to picker_from
<script>
$(function() {
$("#picker_to").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>
@endsection
