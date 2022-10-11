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
                        <h4>{{trans('file.Add Shelf Location')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => 'shelf_location.store', 'method' => 'post', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.customer')}} *</strong> </label>
                                    <div class="col-md-12">
                                        <div class="float-left">
                                            <select required class="form-control selectpicker" id="customer_id" name="customer_id" data-live-search="true" data-live-search-style="begins"
                                        title="Select Customer..." style="width: 200px">
                                            @foreach($lims_customer_list as $customer)
                                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        <div class="float-left">
                                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#addCustomer"><i class="dripicons-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.date')}} <span class="asterisk">*</span></label>
                                    {{-- <input type="datetime-local" name="date" value="{{ $today }}" class="form-control"> --}}
                                    <input type="datetime-local"  class="form-control" onchange="alert(this.value)" id="inputDate" name="date" required />
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
                                    <input type="text" name="location_a" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Location Fridge')}} <span class="asterisk">*</span></label>

                                    <select name="location_fridge" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Location Fridge...">
                                        <option value="1">{{ trans('file.Present') }}</option>
                                        <option value="0">{{ trans('file.Not Present') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Location cd')}} *</label>
                                    <select name="location_cd" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Location cd...">
                                        <option value="1">{{ trans('file.Present') }}</option>
                                        <option value="0">{{ trans('file.Not Present') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Payment Status')}} *</label>
                                    <select name="payment_status" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Payment Status...">
                                        <option value="1">{{ trans('file.Paid') }}</option>
                                        <option value="0">{{ trans('file.Exempt') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('file.Note') }}</label>
                                    <textarea rows="5" class="form-control" name="note"></textarea>
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

    <!-- add customer modal -->
    <div id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            {!! Form::open(['route' => 'customer.store', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Customer')}}</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                <div class="form-group">
                    <label>{{trans('file.Customer Group')}} *</strong> </label>
                    <select required class="form-control selectpicker" name="customer_group_id">
                        @foreach($lims_customer_group_all as $customer_group)
                            <option value="{{$customer_group->id}}">{{$customer_group->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{trans('file.name')}} *</strong> </label>
                    <input type="text" name="customer_name" required class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.Email')}}</label>
                    <input type="text" name="email" placeholder="example@example.com" class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.Phone Number')}} *</label>
                    <input type="text" name="phone_number" required class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.Address')}} *</label>
                    <input type="text" name="address" required class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.City')}} *</label>
                    <input type="text" name="city" required class="form-control">
                </div>
                <div class="form-group">
                <input type="hidden" name="pos" value="1">
                  <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
          </div>
        </div>
    </div>

</section>

@endsection
@push('scripts')
<script type="text/javascript">

    function adjust(v){
        if(v>9){
            return v.toString();
        }else{
            return '0'+v.toString();
        }
    }
    $(document).ready(function(){
        var today = new Date();
        var date = today.getFullYear()+'-'+adjust(today.getMonth()+1)+'-'+adjust(today.getDate());
        var time = adjust(today.getHours()) + ":" + adjust(today.getMinutes());
        var dateTime = `${date}T${time}`;
        //its working

        $("#inputDate").val(dateTime);
    });

</script>
@endpush

