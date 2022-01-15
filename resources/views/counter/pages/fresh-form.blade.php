@extends('apps.layout.master')
@section('title','Simple Fresh Form')
@section('content')
<section id="form-action-layouts">
	<div class="row match-height">


		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="from-actions-bottom-right">User Profile</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">

						<div class="card-text">
							<div class="alert bg-info alert-icon-right alert-arrow-right alert-dismissible fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
								<strong>Form Actions On Bottom Right.</strong>
							</div>
						</div>

						<form class="form">
							<div class="form-body">
								<h4 class="form-section"><i class="icon-eye6"></i> About User</h4>
								<div class="row">
									<div class="form-group col-md-6 mb-2">
										<label for="userinput1">Fist Name</label>
										<input type="text" id="userinput1" class="form-control border-primary" placeholder="Name" name="name">
									</div>
									<div class="form-group col-md-6 mb-2">
										<label for="userinput2">Last Name</label>
										<input type="text" id="userinput2" class="form-control border-primary" placeholder="Company" name="company">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6 mb-2">
										<label for="userinput3">Username</label>
										<input type="text" id="userinput3" class="form-control border-primary" placeholder="Username" name="username">
									</div>
									<div class="form-group col-md-6 mb-2">
										<label for="userinput4">Nick Name</label>
										<input type="text" id="userinput4" class="form-control border-primary" placeholder="Nick Name" name="nickname">
									</div>
								</div>

								<h4 class="form-section"><i class="icon-mail6"></i> Contact Info & Bio</h4>
								<div class="row">
									<div class="form-group col-xs-12 mb-2">
										<label for="userinput5">Email</label>
										<input class="form-control border-primary" type="email" placeholder="email" id="userinput5">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-xs-12 mb-2">
										<label for="userinput6">Website</label>
										<input class="form-control border-primary" type="url" placeholder="http://" id="userinput6">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-xs-12 mb-2">
										<label>Contact Number</label>
										<input class="form-control border-primary" type="tel" placeholder="Contact Number" id="userinput7">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-xs-12 mb-2">
										<label for="userinput8">Bio</label>
										<textarea id="userinput8" rows="5" class="form-control border-primary" name="bio" placeholder="Bio"></textarea>
									</div>
								</div>
							</div>

							<div class="form-actions right">
								<button type="button" class="btn btn-warning mr-1">
									<i class="icon-cross2"></i> Cancel
								</button>
								<button type="submit" class="btn btn-primary">
									<i class="icon-check2"></i> Save
								</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection