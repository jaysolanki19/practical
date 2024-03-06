@if (session('success'))
<div class="alert alert-success align-right alert-message" id="success" role="alert">
    {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger alert-message" role="alert">
    {{ session('error') }}
</div>
@endif