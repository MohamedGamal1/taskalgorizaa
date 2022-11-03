<div class="card-body">
    <div class="form-group">
        <x-form.label for="ddd">Category Name</x-form.label>
        <x-form.input  type="text" name="name" value="{{$category->name}}" />
    </div>
    <div class="form-group">
        <label>Category Parent</label>
        <select
            @class([
                 'form-control',
                 'select2',
                 'is-invalid' => $errors->has('parent_id'),
             ])
            style="width: 100%;" name="parent_id">
            <option value="">Choose Parent Category</option>

            @if(isset($parents) && count($parents) > 0 )
                @foreach($parents as $parent)
                    <option value="{{$parent->id}}" @selected( old('parent_id') == $category->parent_id)>{{$parent->name}}</option>
                @endforeach
            @endif
        </select>
        @error('parent_id')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <x-form.label for="">Category Image</x-form.label>
        <x-form.input  type="file" name="image" accept="image/*" />
        @if(isset($category->image))
            <div class=""><img src="{{asset('storage/'.$category->image)}}" alt="" height="100" width="100"></div>
        @endif
    </div>
    <div class="form-group">
        <x-form.label for="">Category Description</x-form.label>
        <x-form.textarea name="description" value="{{$category->description}}" rows="3"  placeholder="Enter ..." />
    </div>
    <div class="form-group">
        <x-form.label for="">Status</x-form.label>
        <x-form.checkbox name="status" value="{{$category->status}}" :options="['active'=>'active','archived'=>'archived']"/>
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-lg btn-primary">{{$button_label ?? 'Save'}}</button>
</div>
