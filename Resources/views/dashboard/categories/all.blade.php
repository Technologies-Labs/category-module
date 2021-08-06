{{-- @extends('layouts.simple.master')
@section('title', 'Basic DataTables')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Categories</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Categories</li>
<li class="breadcrumb-item active">All</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
                     <table class="display" id="basic-1">
                        <thead>
                            @if($message = Session::get('success'))
                            <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                                <i data-feather="thumbs-up"></i>
                                <p>{{ $message }}</p>
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>
                            @endif
                            @can('category-create')
                                <div style="margin-bottom:5px ">
                                    <a class="btn btn-success" href="{{ route('categories.create') }}"> Create category</a>
                                </div>
                            @endcan
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Order</th>
                                <th>Created by</th>
                                @can('category-activate')
                                <th>Activation</th>
                                @endcan
                                <th>Action</th>
                            </tr>
                         </thead>
                            <tbody>
                            @foreach ($categories as $key => $category)
                                <tr id="delete_categories_{{ $category->id }}">
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <img src="{{asset($category->image)}}" width="50px" height="50px" alt="">
                                    </td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->order }}</td>
                                    <td>{{ $category->user->name }}</td>
                                    @can('category-activate')
                                    <td>
                                        <div class="media-body text-center icon-state switch-outline">
                                            <label class="switch"  for="category-activation-{{$category->id}}">
                                            <input type="checkbox"  @if ($category->is_active) checked @endif class="custom-control-input" id="category-activation-{{$category->id}}" onclick="activate_item('categories',{{$category->id}})"><span class="switch-state bg-success"></span>
                                            </label>
                                        </div>
                                    </td>
                                    @endcan
                                    <td class="text-center">
                                        @can('category-edit')
                                        <a class="btn btn-primary m-b-5"  href="{{ route('categories.edit',$category->id) }}"><i class="fa fa-edit"></i></a>
                                        @endcan

                                        @can('category-delete')
                                           <a href="javascript:void(0);" onclick="delete_item({{ $category->id }},'categories')" class="btn btn-danger m-b-5"><i class="fa fa-trash"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection --}}
@extends('layouts.simple.table')
@section('table-content')
@widget('datatable', [
        'data'      => $data,
        'table'     => $table,
        'columns'   => $columns,
        'actions'   => $actions,
    ])
@endsection
