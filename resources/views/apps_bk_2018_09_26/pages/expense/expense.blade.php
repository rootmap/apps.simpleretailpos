@extends('apps.layout.master')
@section('title','Create Expense Voucher')
@section('content')
<section id="file-exporaat">


		<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						@if(isset($edit))
						<i class="icon-money"></i> Edit Expense Voucher
						@else
						<i class="icon-money"></i> Create Expense Voucher
						@endif
					</h4>
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
						<form class="form" method="post" 
						@if(isset($edit))
							action="{{url('expense/voucher/modify/'.$dataRow->id)}}"
						@else
							action="{{url('expense/voucher/save')}}"
						@endif
						>
							<div class="form-body">
								{{ csrf_field() }}
								<div class="form-group">
									<label for="eventRegInput1">
										<span>Select Expense Head</span> 
										<span class="text-danger">*</span>
									</label>
									<select name="expense_id" class="form-control border-primary expense_id">
										<option value="0">Select Expense Head</option>
										<option value="00">Create New Expense Head</option>
										@if(isset($expenseHead))
											@foreach($expenseHead as $head)
												<option 
												@if(isset($edit))
													@if($edit->expense_id==$head->id)
														selected="selected" 
													@endif
												@endif 
												 value="{{$head->id}}">{{$head->name}}</option>
											@endforeach
										@endif
									</select>
									<input type="text" style="display: none;" id="text" class="form-control border-primary expense_head_name" 
										@if(isset($edit))
										value="{{$dataRow->expense_head_name}}" 
										@endif 
										placeholder="Expense Head Name" name="expense_head_name">
								</div>


									<div class="form-group">
										<label for="eventRegInput2">Expense Description <span class="text-danger">*</span></label>
										<input type="text" id="text" class="form-control border-primary" 
										@if(isset($edit))
										value="{{$dataRow->expense_description}}" 
										@endif 
										placeholder="Expense Description" name="expense_description">
									</div>	

									<div class="form-group">
										<label for="eventRegInput3">Expense Date <span class="text-danger">*</span></label>
										<input type="text" 
										@if(isset($edit))
										value="{{$dataRow->expense_date}}" 
										@else 
										value="{{date('Y-m-d')}}" 
										@endif 
										 class="form-control border-primary DropDateWithformat" placeholder="Expense Date" name="expense_date">
									</div>
								
									<div class="form-group">
										<label for="eventRegInput3">Expense Amount <span class="text-danger">*</span></label>
										<input type="text" 
											@if(isset($edit))
												value="{{$dataRow->expense_amount}}" 
											@endif 										
										id="eventRegInput4" value="0" class="form-control border-primary" placeholder="Expense Amount" name="expense_amount">
									</div>

							
							</div>

							<div class="form-actions center">
								<a href="{{url('expense/voucher/report')}}" class="btn btn-info mr-1">
									<i class="icon-android-share"></i> Back to Expense Report
								</a>
								<button type="reset" class="btn btn-warning mr-1">
									<i class="icon-cross2"></i> Cancel
								</button>
								@if(isset($edit))
								<button type="submit" class="btn btn-primary">
									<i class="icon-check2"></i> Update
								</button>
								@else
								<button type="submit" class="btn btn-primary">
									<i class="icon-check2"></i> Save
								</button>
								@endif
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Both borders end-->
</section>
@endsection

@include('apps.include.datatable',['JDataTable'=>1,'dateDrop'=>1,'expenseHeadCreate'=>1])