@if (Auth::guard('web')->check())
  <p class="text-success"> you are logged in as USER </p>
@else
  <p class="text-danger"> you are logged OUT as USER </p>
@endif

@if (Auth::guard('admin')->check())
  <p class="text-success"> you are logged in as ADMIN </p>
@else
  <p class="text-danger"> you are logged OUT as ADMIN </p>
@endif
