@if ($status = statusLaundry()->value == false)
    <div class="alert alert-success alert-dismissible bg-warning text-white border-0 fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Warning - </strong> {{ statusLaundry()->message }}
    </div>
@endif