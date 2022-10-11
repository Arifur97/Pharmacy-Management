@extends('layout.main') @section('content')
@if(session()->has('create_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('create_message') !!}</div>
@endif
@if(session()->has('edit_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('edit_message') }}</div>
@endif

@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif

<section>
    <div class="container-fluid">
        <a href="{{route('shelf_location.create')}}" class="btn btn-info"><i class="dripicons-plus"></i> {{trans('file.Add Shelf Location')}}</a>
    </div>

    <div class="table-responsive mt-4">
        <table id="shelflocation-table" class="table sale-list" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported" style="border-radius: 5px 0px 0px 5px"></th>
                    <th>{{trans('file.customer')}}</th>
                    <th>{{trans('file.date')}}</th>
                    <th>{{trans('file.Warehouse')}}</th>
                    <th>{{trans('file.Location A')}}</th>
                    <th>{{trans('file.Location Fridge')}}</th>
                    <th>{{trans('file.Location cd')}}</th>
                    <th>{{trans('file.Payment Status')}}</th>
                    <th>{{trans('file.Delivery Status')}}</th>
                    <th class="not-exported" style="border-radius: 0px 5px 5px 0px">{{trans('file.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lims_shelf_location_list as $key=>$shelf_location)
                <?php
                    if($shelf_location->status == 1)
                        $status = trans('file.Yes');
                    else
                        $status = trans('file.No');
                ?>
                <tr class="shelf_location-link">
                    <td>{{$key}}</td>
                    <td>{{ $shelf_location->customer->name }}</td>
                    <td>{{ date('d/m/Y h:i a' , strtotime($shelf_location->date)) }}</td>
                    {{-- <td>{{ date('d/m/Y H:i A', strtotime($shelf_location->date)); }}</td> --}}
                    <td>{{ $shelf_location->warehouse->name }}</td>
                    <td>{{ $shelf_location->location_a }}</td>
                    {{-- <td>{{ $shelf_location->location_fridge }}</td> --}}

                    @if($shelf_location->location_fridge == 1)
                        <td><div class="badge badge-success">{{ trans('file.Present') }}</div></td>
                    @else
                        <td><div class="badge badge-danger">{{ trans('file.Not Present') }}</div></td>
                    @endif

                    @if($shelf_location->location_cd == 1)
                        <td><div class="badge badge-success">{{ trans('file.Present') }}</div></td>
                    @else
                        <td><div class="badge badge-danger">{{ trans('file.Not Present') }}</div></td>
                    @endif

                    {{-- <td>{{ $shelf_location->location_cd }}</td> --}}

                    @if($shelf_location->payment_status == 1)
                        <td><div class="badge badge-success">{{ trans('file.Paid') }}</div></td>
                    @else
                        <td><div class="badge badge-danger">{{ trans('file.Exempt') }}</div></td>
                    @endif

                    @if($shelf_location->status == 1)
                        <td><div class="badge badge-success">{{$status}}</div></td>
                    @else
                        <td><div class="badge badge-danger">{{$status}}</div></td>
                    @endif
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <a class="btn btn-link" href="{{ route('shelf_location.edit', $shelf_location->id) }}"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}</a></button>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a class="btn btn-link" href="{{ route('shelf_location.status.change', $shelf_location->id) }}"><i class="dripicons-document-edit"></i> {{trans('file.Change Status')}}</a></button>
                                </li>
                                <li class="divider"></li>
                                {{ Form::open(['route' => ['shelf_location.destroy', $shelf_location->id], 'method' => 'DELETE'] ) }}
                                <li>
                                    <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> {{trans('file.delete')}}</button>
                                </li>
                                {{ Form::close() }}
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>



</section>



@endsection

@push('scripts')
<script type="text/javascript">
    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
    $("ul#people #customer-list-menu").addClass("active");

    function confirmDelete() {
      if (confirm("Are you sure want to delete?")) {
          return true;
      }
      return false;
    }

    $('#shelflocation-table').DataTable( {
        fixedHeader: {
            header: true,
            footer: true
        },
        "order": [],
        'language': {
            'lengthMenu': '_MENU_ {{trans("file.records per page")}}',
             "info":      '<small>{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
            "search":  '{{trans("file.Search")}}',
            'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        'columnDefs': [
            {
                "orderable": false,
                'targets': [0, 9]
            },
            {
                'render': function(data, type, row, meta){
                    if(type === 'display'){
                        data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                    }

                   return data;
                },
                'checkboxes': {
                   'selectRow': true,
                   'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                },
                'targets': [0]
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                text: '<i class="fa fa-file-pdf-o mr-1" aria-hidden="true"></i> {{trans("file.PDF")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'csv',
                text: '<i class="fa fa-file-excel-o mr-1" aria-hidden="true"></i> {{trans("file.CSV")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print mr-1" aria-hidden="true"></i> {{trans("file.Print")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                text: '<i class="fa fa-trash mr-1" aria-hidden="true"></i> {{trans("file.delete")}}',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    if(user_verified == '1') {
                        quotation_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                var quotation = $(this).closest('tr').data('quotation');
                                quotation_id[i-1] = quotation[13];
                            }
                        });
                        if(quotation_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'quotations/deletebyselection',
                                data:{
                                    quotationIdArray: quotation_id
                                },
                                success:function(data){
                                    alert(data);
                                    dt.rows({ page: 'current', selected: true }).remove().draw(false);
                                }
                            });

                        }
                        else if(!quotation_id.length)
                            alert('Nothing is selected!');
                    }
                    else
                        alert('This feature is disable for demo!');
                }
            },
            {
                extend: 'colvis',
                text: '<i class="fa fa-eye mr-1" aria-hidden="true"></i> {{trans("file.Column visibility")}}',
                columns: ':gt(0)'
            },
        ],
        drawCallback: function () {
            var api = this.api();
            datatable_sum(api, false);
        }
    } );

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  if(all_permission.indexOf("customers-delete") == -1)
        $('.buttons-delete').addClass('d-none');
</script>
@endpush
