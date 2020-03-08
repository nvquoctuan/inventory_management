@if ($errors->any())
  <div class="alert alert-danger col-3 alert">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif