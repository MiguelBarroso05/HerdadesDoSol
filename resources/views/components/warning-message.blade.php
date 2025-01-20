@if(session($session))
    <div id="warning-alert" class="alert alert-warning alert-dismissible fade show " role="alert">
        <strong>Warning!</strong> {{ session($session) }}
    </div>
@endif
