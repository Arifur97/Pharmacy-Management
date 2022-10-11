@extends('layout.main') @section('content')
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Update Shelf Location')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => ['shelf_location.update', $lims_shelf_location_data->id], 'method' => 'put', 'files' => true, 'id' => 'shelf-location-form']) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.customer')}} *</label>
                                    <input type="hidden" name="customer_id_hidden" value="{{ $lims_shelf_location_data->customer_id }}" />
                                    <select required id="customer_id" name="customer_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select customer...">
                                        @foreach($lims_customer_list as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name . ' (' . $customer->phone_number . ')'}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.date')}} <span class="asterisk">*</span></label>
                                    <input type="datetime-local" name="date" value="{{ $lims_shelf_location_data->date }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Warehouse')}} *</strong> </label>
                                    @foreach($lims_warehouse_list as $warehouse)
                                        @if (Auth::user()->warehouse_id == $warehouse->id)
                                            {{-- <input type="text" name="warehouse_id" class="form-control" placeholder="Warehouse Name" value="{{$warehouse->name ?? ''}}" readonly> --}}
                                            <select name="warehouse_id" class="selectpicker form-control">
                                                <option value="{{$warehouse->id}}">{{$warehouse->name ?? ''}}</option>
                                            </select>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Location A')}} <span class="asterisk">*</span></label>
                                    <input type="text" name="location_a" value="{{ $lims_shelf_location_data->location_a }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Location Fridge')}} <span class="asterisk">*</span></label>
                                    <input type="hidden" name="location_fridge_hidden" value="{{$lims_shelf_location_data->location_fridge}}" />
                                    <select name="location_fridge" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Location Fridge...">
                                        <option value="1">{{ trans('file.Present') }}</option>
                                        <option value="0">{{ trans('file.Not Present') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Location cd')}} *</label>
                                    <input type="hidden" name="location_cd_hidden" value="{{$lims_shelf_location_data->location_cd}}" />
                                    <select name="location_cd" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Location cd...">
                                        <option value="1">{{ trans('file.Present') }}</option>
                                        <option value="0">{{ trans('file.Not Present') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Payment Status')}} *</label>
                                    <input type="hidden" name="payment_status_hidden" value="{{$lims_shelf_location_data->payment_status}}" />
                                    <select name="payment_status" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Payment Status...">
                                        <option value="1">{{ trans('file.Paid') }}</option>
                                        <option value="0">{{ trans('file.Exempt') }}</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ trans('file.Attach Document') }}</label>
                                    <i class="dripicons-question" data-toggle="tooltip"
                                        title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i>
                                    <input type="file" name="document" class="form-control" />
                                    <input type="hidden" name="document_id" id="documentId"
                                        class="form-control my-2">
                                    @if ($errors->has('extension'))
                                        <span>
                                            <strong>{{ $errors->first('extension') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.status')}}</label> <br>
                                    <input type="hidden" name="status_hidden" value="{{$lims_shelf_location_data->status}}" />
                                    <select name="status" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Status...">
                                        <option value="0">{{trans('file.Not Delivered')}}</option>
                                        <option value="1">{{trans('file.Delivered')}}</option>
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('file.Note') }}</label>
                                    <textarea rows="5" class="form-control" name="note">{{ $lims_shelf_location_data->note }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="pos" value="0">
                            <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
@push('scripts')
<script type="text/javascript">

    $('select[name="customer_id"]').val($('input[name="customer_id_hidden"]').val());
    $('select[name="warehouse_id"]').val($('input[name="warehouse_id_hidden"]').val());
    $('select[name="location_fridge"]').val($('input[name="location_fridge_hidden"]').val());
    $('select[name="location_cd"]').val($('input[name="location_cd_hidden"]').val());
    $('select[name="payment_status"]').val($('input[name="payment_status_hidden"]').val());
    $('select[name="status"]').val($('input[name="status_hidden"]').val());

	$('.selectpicker').selectpicker({
	    style: 'btn-link',
	});


</script>
@endpush


