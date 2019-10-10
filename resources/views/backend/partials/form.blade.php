@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{!! csrf_field() !!}
<div class="form-group">
    <label for="restaurant_name" class="form-label">Restaurant Name</label>
    <input type="text" class="form-control" name="restaurant_name" value=" {{
        old('resturant_name', !empty($address) ? $address->restaurant->name : null )
    }}" />
</div>
<div class="form-group">
    <label for="address1" class="form-label">Address 1</label>
    <input type="text" class="form-control" name="address1" value="{{
        old('address1', !empty($address) ? $address->address1 : null )
    }}" />
</div>
<div class="form-group">
    <label for="address2" class="form-label">Address 2</label>
    <input type="text" class="form-control" name="address2" value="{{
        old('address2', !empty($address) ? $address->address2 : null )
    }}" />
</div>
<div class="form-group">
    <label for="town" class="form-label">Town</label>
    <input type="text" class="form-control" name="town" value="{{
        old('town', !empty($address) ? $address->town : null )
    }}" />
</div>
<div class="form-group">
    <label for="postcode" class="form-label">Post Code</label>
    <input type="text" class="form-control" name="postcode" value="{{
        old('postcode', !empty($address) ? $address->postcode : null )
    }}" pattern="[A-Z]{1,2}[0-9][0-9A-Z]?\s?[0-9][A-Z][A-Z]" />
</div>
