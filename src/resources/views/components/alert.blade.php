@if(session()->has('message') && session()->has('status'))
    <div class="alert alert-{{ session()->get('status') }}" role="alert">
        {{ session()->get('message') }}
    </div>
@endif
