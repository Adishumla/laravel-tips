@if ($errors->has('email'))
<p>
    <u>{{ $errors->first('email') }}</u>
</p>
@endif
@if ($errors->has('password'))
<p>
    <u>{{ $errors->first('password') }}</u>
</p>
@endif
