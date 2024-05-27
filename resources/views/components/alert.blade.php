@if (session('success'))
    <div id="alert-success" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div id="alert-error" class="alert alert-error">
        {{ session('error') }}
    </div>
@endif

@if (session('warning'))
    <div id="alert-warning" class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif

@if (session('info'))
    <div id="alert-info" class="alert alert-info">
        {{ session('info') }}
    </div>
@endif