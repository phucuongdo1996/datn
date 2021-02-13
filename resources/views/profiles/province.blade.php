<select name="address_city" class="form-control col-11 col-md-6 fs13 profile-setting progress-calculate">
    <option value="">---</option>
    @foreach(PROVINCES as $province)
        <option value="{{ $province }}" @if(isset($profile) && $province == $profile['address_city']) selected @endif>{{ $province }}</option>
    @endforeach
</select>
