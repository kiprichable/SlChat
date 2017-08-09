{{--@extends('layouts.appNOsidebar')--}}

@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.appointments.title')</h3>
    @can('appointment_create')
        <p>
            <a href="{{ route('admin.appointments.create') }}"
               class="btn btn-success">@lang('quickadmin.qa_add_new')</a>

        </p>
    @endcan

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

    <div id='calendar'></div>

    <br />

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($appointments) > 0 ? 'datatable' : '' }} @can('appointment_delete') dt-select @endcan">
                <thead>
                <tr>
                    @can('appointment_delete')
                        <th style="text-align:center;"><input type="checkbox" id="select-all"/></th>
                    @endcan

                    <th>@lang('quickadmin.appointments.fields.client')</th>
                    <th>@lang('quickadmin.clients.fields.last-name')</th>
                    <th>@lang('quickadmin.clients.fields.phone')</th>
                    <th>@lang('quickadmin.clients.fields.email')</th>
                    <th>@lang('quickadmin.appointments.fields.employee')</th>
                    <th>@lang('quickadmin.employees.fields.last-name')</th>
                    <th>@lang('quickadmin.appointments.fields.start-time')</th>
                    <th>@lang('quickadmin.appointments.fields.finish-time')</th>
                    <th>@lang('quickadmin.appointments.fields.comments')</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                @if (count($appointments) > 0)
                    @foreach ($appointments as $appointment)
                        <tr data-entry-id="{{ $appointment->id }}">
                            @can('appointment_delete')
                                <td></td>
                            @endcan

                            <td>{{ $appointment->client->first_name or '' }}</td>
                            <td>{{ isset($appointment->client) ? $appointment->client->last_name : '' }}</td>
                            <td>{{ isset($appointment->client) ? $appointment->client->phone : '' }}</td>
                            <td>{{ isset($appointment->client) ? $appointment->client->email : '' }}</td>
                            <td>{{ $appointment->employee->first_name or '' }}</td>
                            <td>{{ isset($appointment->employee) ? $appointment->employee->last_name : '' }}</td>
                            <td>{{ $appointment->start_time }}</td>
                            <td>{{ $appointment->finish_time }}</td>
                            <td>{!! $appointment->comments !!}</td>
                            <td>
                                @can('appointment_view')
                                    <a href="{{ route('admin.appointments.show',[$appointment->id]) }}"
                                       class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                @endcan
                                @can('appointment_edit')
                                    <a href="{{ route('admin.appointments.edit',[$appointment->id]) }}"
                                       class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                @endcan
                                @can('appointment_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.appointments.destroy', $appointment->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('appointment_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.appointments.mass_destroy') }}';
        @endcan

    </script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function () {

            function dateFormat(time)
            {
                date = new Date(time);
                year = date.getFullYear();
                month = date.getMonth()+1;
                dt = date.getDate();
                hh = date.getHours();
                mm = date.getMinutes();
                sec = date.getSeconds();

                if (dt < 10) {
                    dt = '0' + dt;
                }
                if (month < 10) {
                    month = '0' + month;
                }

                return (year+'-' + month + '-'+dt)
            }
            function timeFormat(time)
            {
                date = new Date(time);
                hh = date.getHours();
                mm = date.getMinutes();
                sec = date.getSeconds();

                if (hh < 10) {
                    hh = '0' + hh;
                }
                if (mm < 10) {
                    mm = '0' + mm;
                }
                if (sec < 10) {
                    sec= '0' + sec;
                }

                return (hh + ':' + mm + ':' + sec)
            }
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                defaultView: 'agendaWeek',
                timeFormat: 'h(:mm)',
                minTime: '09:00:00',
                maxTime: '17:00:00',
                height: 500,
                header:
                    {
                        left: 'prev,next,today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                businessHours: {
                    // days of week. an array of zero-based day of week integers (0=Sunday)
                    dow: [2,4], // Monday - Thursday

                    start: '09:00', // a start time (9am in this example)
                    end: '17:00', // an end time (6pm in this example)

                },
                hiddenDays: [ 1, 3, 5 ],

                weekends: false,
                editable: true,
                selectable: true,

                //When u select some space in the calendar do the following:
                select: function (start, end, allDay) {
                    //do something when space selected
                    //Show 'add event' modal
                    $('#createEventModal').modal('show');;

                    $( "#start_time" ).val(moment(start).format('HH:mm'));
                    $( "#finish_time" ).val(moment(end).format('HH:mm'));
                    $( "#date" ).val(dateFormat(start));

                },

                //When u drop an event in the calendar do the following:
                eventDrop: function (event, delta, revertFunc) {
                    //do something when event is dropped at a new location
                },

                //When u resize an event in the calendar do the following:
                eventResize: function (event, delta, revertFunc) {
                    //do something when event is resized
                },

                eventRender: function(event, element) {
                    $(element).tooltip({title: event.title});
                },

                //Activating modal for 'when an event is clicked'
                eventClick: function (event) {
                    $('#modalTitle').html(event.title);
                    $('#modalBody').html(event.description);
                    $('#fullCalModal').modal();
                    // change the border color just for fun
                    $(this).css('border-color', 'red');
                },



                events: [
                        @foreach($appointments as $appointment)
                        {
                            @if($user['role_id'] == '1')
                                title: '{{ $appointment->client->first_name . ' ' . $appointment->client->last_name .' with '.  $appointment->employee->first_name}}',
                            @else
                                title: 'Booked',
                            @endif
                                start: '{{ $appointment->start_time }}',

                            @if ($appointment->finish_time)
                                end: '{{ $appointment->finish_time }}',
                            @endif

                            @if($user['role_id'] == '1')
                                url: '{{ route('admin.appointments.edit', $appointment->id) }}',
                            @elseif($appointment->comments == 'NoBookable')

                            @else
                            @endif

                        },

            @endforeach
                ],

               // eventColor: '#378006'

            })

        $('#submitButton').on('click', function(e){
                // We don't want this to act as a link so cancel the link action
                e.preventDefault();

                doSubmit();
            });

            function doSubmit(){
                $("#createEventModal").modal('hide');
                $("#calendar").fullCalendar('renderEvent',
                    {
                        title: $('#eventName').val(),
                        start: new Date($('#eventDueDate').val()),

                    },
                    true);
            }
        });
    </script>

@section('javascript')
    @parent
    <script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>    <script>
        $('.datetime').datetimepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}",
            timeFormat: "HH:mm:ss"
        });
    </script>

@stop
@endsection