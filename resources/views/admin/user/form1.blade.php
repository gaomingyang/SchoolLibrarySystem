{!! csrf_field() !!}
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">{{trans('user.name')}}</label>

    <div class="col-md-6">
        <input type="text" class="form-control" name="name" value="{{ isset($user->name) ? $user->name : '' }}">

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>
 <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">@lang('user.email')</label>

    <div class="col-md-6">
        <input type="email" class="form-control" name="email" value="{{ isset($user->email) ? $user->email : '' }}">

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>
