<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">{{trans('user.password')}}</label>

    <div class="col-md-6">
        <input type="password" class="form-control" name="password">

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">{{trans('user.confirm_password')}}</label>

    <div class="col-md-6">
        <input type="password" class="form-control" name="password_confirmation">

        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>
</div>
