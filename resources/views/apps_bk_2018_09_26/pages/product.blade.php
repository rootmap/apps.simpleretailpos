@extends('apps.layout.master')
@section('title','Product')
@section('content')
<section id="form-action-layouts">


		<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center"><i class="icon-clipboard2"></i> Add Product</h4>
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
						<form class="form">
							<div class="form-body">

								<div class="form-group">
									<label for="eventRegInput1">Product Name <span class="text-danger">*</span></label>
									<input type="text" id="eventRegInput1" class="form-control border-primary" placeholder="Product Name" name="name">
								</div>

								<div class="row">
									<div class="form-group col-md-4 mb-2">
										<label for="eventRegInput2">Quantity In Stock <span class="text-danger">*</span></label>
										<input type="number" id="number" class="form-control border-primary" placeholder="Quantity In Stock" value="0" name="quantity">
									</div>	

									<div class="form-group col-md-4 mb-2">
										<label for="eventRegInput3">Price Per Item <span class="text-danger">*</span></label>
										<input type="number" id="number" class="form-control border-primary" placeholder="Price Per Item" value="0" name="price">
									</div>
								
									<div class="form-group col-md-4 mb-2">
										<label for="eventRegInput3">Cost Per Item <span class="text-danger">*</span></label>
										<input type="number" id="number" class="form-control border-primary" placeholder="Cost Per Item" value="0" name="cost">
									</div>
								</div>

							
							</div>

							<div class="form-actions center">
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
	<!-- Both borders end-->
<!-- Both borders end -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="icon-database"></i> Product List</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <!-- <p class="card-text">Exporting data from a table can often be a key part of a complex application. The Buttons extension for DataTables provides three plug-ins that provide overlapping functionality for data export.</p> -->
                        <div id="DataTables_Table_10_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4">
                            <div class="dt-buttons">
                            	<a class="dt-button buttons-copy buttons-html5 btn btn-primary mr-1" tabindex="0" aria-controls="DataTables_Table_10" href="#"><span>Copy</span></a>
                            	<a class="dt-button buttons-csv buttons-html5 btn btn-primary mr-1" tabindex="0"
                                    aria-controls="DataTables_Table_10" href="#"><span>CSV</span></a>
                                <a class="dt-button buttons-excel buttons-html5 btn btn-primary mr-1" tabindex="0" aria-controls="DataTables_Table_10" href="#"><span>Excel</span></a>
                                <a class="dt-button buttons-pdf buttons-html5 btn btn-primary mr-1"
                                    tabindex="0" aria-controls="DataTables_Table_10" href="#"><span>PDF</span></a>
                                <a class="dt-button buttons-print btn btn-primary mr-1" tabindex="0" aria-controls="DataTables_Table_10" href="#"><span>Print</span></a>
                            </div>
                            <div id="DataTables_Table_10_filter" class="dataTables_filter">
                            	<label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="DataTables_Table_10"></label>
                            </div>
                        <table class="table table-striped table-bordered file-export dataTable" id="DataTables_Table_10"
                            role="grid" aria-describedby="DataTables_Table_10_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_10" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 136px;">Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_10" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 217px;">Position</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_10" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 100px;">Office</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_10" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 38px;">Age</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_10" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 86px;">Start date</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_10" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 82px;">Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<tr role="row" class="odd">
                                    <td class="sorting_1">Airi Satou</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>33</td>
                                    <td>2008/11/28</td>
                                    <td>$162,700</td>
                                </tr>
                                <tr role="row" class="even">
                                    <td class="sorting_1">Angelica Ramos</td>
                                    <td>Chief Executive Officer (CEO)</td>
                                    <td>London</td>
                                    <td>47</td>
                                    <td>2009/10/09</td>
                                    <td>$1,200,000</td>
                                </tr>
                                <tr role="row" class="odd">
                                    <td class="sorting_1">Ashton Cox</td>
                                    <td>Junior Technical Author</td>
                                    <td>San Francisco</td>
                                    <td>66</td>
                                    <td>2009/01/12</td>
                                    <td>$86,000</td>
                                </tr>
                                <tr role="row" class="even">
                                    <td class="sorting_1">Bradley Greer</td>
                                    <td>Software Engineer</td>
                                    <td>London</td>
                                    <td>41</td>
                                    <td>2012/10/13</td>
                                    <td>$132,000</td>
                                </tr>
                                <tr role="row" class="odd">
                                    <td class="sorting_1">Brenden Wagner</td>
                                    <td>Software Engineer</td>
                                    <td>San Francisco</td>
                                    <td>28</td>
                                    <td>2011/06/07</td>
                                    <td>$206,850</td>
                                </tr>
                                <tr role="row" class="even">
                                    <td class="sorting_1">Brielle Williamson</td>
                                    <td>Integration Specialist</td>
                                    <td>New York</td>
                                    <td>61</td>
                                    <td>2012/12/02</td>
                                    <td>$372,000</td>
                                </tr>
                                <tr role="row" class="odd">
                                    <td class="sorting_1">Bruno Nash</td>
                                    <td>Software Engineer</td>
                                    <td>London</td>
                                    <td>38</td>
                                    <td>2011/05/03</td>
                                    <td>$163,500</td>
                                </tr>
                                <tr role="row" class="even">
                                    <td class="sorting_1">Caesar Vance</td>
                                    <td>Pre-Sales Support</td>
                                    <td>New York</td>
                                    <td>21</td>
                                    <td>2011/12/12</td>
                                    <td>$106,450</td>
                                </tr>
                                <tr role="row" class="odd">
                                    <td class="sorting_1">Cara Stevens</td>
                                    <td>Sales Assistant</td>
                                    <td>New York</td>
                                    <td>46</td>
                                    <td>2011/12/06</td>
                                    <td>$145,600</td>
                                </tr>
                                <tr role="row" class="even">
                                    <td class="sorting_1">Cedric Kelly</td>
                                    <td>Senior Javascript Developer</td>
                                    <td>Edinburgh</td>
                                    <td>22</td>
                                    <td>2012/03/29</td>
                                    <td>$433,060</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">Name</th>
                                    <th rowspan="1" colspan="1">Position</th>
                                    <th rowspan="1" colspan="1">Office</th>
                                    <th rowspan="1" colspan="1">Age</th>
                                    <th rowspan="1" colspan="1">Start date</th>
                                    <th rowspan="1" colspan="1">Salary</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="dataTables_info" id="DataTables_Table_10_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_10_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="DataTables_Table_10_previous"><a href="#" aria-controls="DataTables_Table_10" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_10" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_10" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_10" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_10" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_10" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_10" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                <li class="paginate_button page-item next" id="DataTables_Table_10_next"><a href="#" aria-controls="DataTables_Table_10" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
@endsection

@section('js')
<script src="{{url('theme/app-assets/vendors/js/tables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/tables/buttons.flash.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/tables/jszip.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/tables/pdfmake.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/tables/vfs_fonts.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/tables/buttons.html5.min.js')}}" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<script src="{{url('theme/app-assets/js/scripts/tables/datatables/datatable-advanced.min.js')}}" type="text/javascript"></script>
@endsection