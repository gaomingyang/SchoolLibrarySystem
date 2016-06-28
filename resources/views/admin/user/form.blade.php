{!! csrf_field() !!}
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">{{trans('user.name')}}</label>

    <div class="col-md-6">
        <input type="text" class="form-control" name="name" value="{{ isset($user->name) ? $user->name : '' }}" placeholder="姓名">

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
        <input type="email" class="form-control" name="email" value="{{ isset($user->email) ? $user->email : '' }}" placeholder="邮箱">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">{{trans('user.password')}}</label>

    <div class="col-md-6">
        <input type="password" class="form-control" value="" name="password" placeholder="登陆密码">
        @if(isset($user->name))
            <span style="color:#C8C4C2;">为空则不修改</span>
        @endif
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>
