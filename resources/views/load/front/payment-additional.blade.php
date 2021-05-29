@foreach ($paymentGateway->additionals as $additional)
    <div class="col-sm-6 col-12">
        <div class="form-group">
            <label for="card-number">{{ $additional->title }}</label>
            <input type="text" name="additional[{{ $additional->id }}]" class="form-control require-field">
            <div class="has-error-text">{{ $additional->title }} is required</div>
        </div>
    </div>
@endforeach
