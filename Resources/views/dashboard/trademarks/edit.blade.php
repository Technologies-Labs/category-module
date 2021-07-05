@extends('layouts.simple.master')
@section('title', 'Basic DataTables')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>trademarks</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Trademarks</li>
<li class="breadcrumb-item active">edit</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
            <div class="card">
					<div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                       @endif
                       {!! Form::model($trademark, ['method' => 'PATCH','route' => ['trademarks.update', $trademark->id],'files'=>'true']) !!}
                        <div class="row">
							<div class="col">
								<div class="mb-3">
									<label for="name"><strong>Name</strong></label>
									{!! Form::text('name', null, array('placeholder' => 'Trademark Name','class' => 'form-control','required')) !!}
								</div>
							</div>
						</div>
                        <div class="row">
							<div class="col">
								<div class="mb-3">
									<label for="image"><strong>Image</strong></label><br>
									{!! Form::file('image',array('class' => 'form-control',)) !!}
								</div>
							</div>
						</div>
					<div class="card-footer">
						<button class="btn btn-primary" type="submit">Submit</button>
					</div>
                {!! Form::close() !!}
			</div>
            </div>
		</div>
	</div>
</div>
@endsection
@section('script')
@endsection






