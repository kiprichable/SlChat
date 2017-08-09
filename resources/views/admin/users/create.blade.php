@extends('layouts.app')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@section('content')
    <h3 class="page-title">@lang('quickadmin.users.title')</h3>
    {!! Form::open(['method' => 'POST', 'url' =>'admin/users']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('first_name', 'First name', ['class' => 'control-label']) !!}
                    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('first_name'))
                        <p class="help-block">
                            {{ $errors->first('first_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('last_name', 'Last name', ['class' => 'control-label']) !!}
                    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('last_name'))
                        <p class="help-block">
                            {{ $errors->first('last_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', 'Email*', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('password', 'Password*', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('role_id', 'Role*', ['class' => 'control-label']) !!}
                    {!! Form::select('role_id', $roles, old('role_id'), ['class' => 'form-control select2',
                    'required' => '','id' => 'select']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('role_id'))
                        <p class="help-block">
                            {{ $errors->first('role_id') }}
                        </p>
                    @endif
                </div>
            </div>

            <div style="display:none" id="ifclient">
                <div class="form-group col-lg-6">
                    <label>City</label>
                    <input id="city" type="text" class="form-control" name="city">
                </div>

                <div class="form-group col-lg-6">
                    <label>State</label>
                    <input id="state" type="text" class="form-control" name="state">
                </div>

                <div class="form-group col-lg-6">
                    <p>Are there additional family members with you that are also in need of shelter?</p>
                    <div class="radio">
                        <label><input type="radio" name="members" value="Yes"/>Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="members" value="No"/>No</label>
                    </div>
                </div>
                <div class="form-group col-lg-6">
                    <label>If yes above, list their names</label>
                    <input type="text" class="form-control" name="names">
                </div>

                <div class="form-group col-lg-6">
                    <p>Are you under 25 years of age?</p>
                    <div class="radio">
                        <label><input type="radio" name="age" value="Yes"
							<?php echo (old('age') == "Yes")?'checked':'' ?>/>Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="age" value="No"/>No</label>
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <p>Are you a veteran?</p>
                    <div class="radio">
                        <label><input type="radio" name="veteran" value="Yes"/>Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="veteran" value="No"/>No</label>
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label>If yes above, provide your dd214 number?</label>
                    <input type="text" class="form-control" name="dd214">
                </div>

                <div class="form-group col-lg-6">
                    <p>Where did you stay last night?</p>
                    <div class="radio">
                        <label>
                            <input type="radio" name="lastnight" value="Outside/Park/Campground"/>
                            Outside/Park/Campground
                        </label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="lastnight" value="Shed/Garage or building"/>Shed/Garage or building
                        </label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="lastnight" value="Vehicle"/>Vehicle
                        </label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="lastnight" value="Jail, Prison or Detention"/>Jail,
                            Prison or Detention
                        </label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="lastnight" value="Emergency or DV Shelter"/>Emergency or DV Shelter
                        </label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="lastnight" value="Motel paid by agency"/>Motel paid by agency
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="lastnight" value="Own apartment/house/trailer"/>Own apartment/house/trailer
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="lastnight" value="With a family member or friend"/>With a family member or friend
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="lastnight" value="Motel paid by self, family, friend"/>Motel paid by self, family, friend
                        </label>
                    </div>
                </div>


            </div>

        </div>
    </div>
    <button class="btn btn-success">Save</button>
    <script type="text/javascript">
        $(document).ready(function() {
            $("select").change(function(){
                if($(this).val() == "3")
                {
                    $("#ifclient").show();
                }
                else {
                    $("#ifclient").hide();
                }
            });
        });


    </script>


    {!! Form::close() !!}
@stop

