<x-html-scope title='Edit' btnTitle='Product list' btnRoute='index'>
    <form action="{{route('products.update',$product->id)}}" method="POST" class="shadow-lg p-5 rounded">
        @csrf
        @method('put')
        <div class="mb-3">
          <label for="product_name" class="form-label req">Product name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name',$product->name)}}" id="product_name" placeholder="product name">
          @error('name')
              <p class="invalid-feedback">{{$message}}</p>
          @enderror
        </div>
        <div class="mb-3">
            <label for="product_price" class="form-label req">Product price</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{old('price',$product->price)}}" id="product_price" placeholder="product price">
            @error('price')
              <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="product_desc" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="product_desc" placeholder="description..." cols="30" rows="5">{{old('description',$product->description)}}</textarea>
        </div>
        <div class="mb-3">
            <label for="product_image" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" value="{{old('image')}}" id="product_image" disabled>
        </div>
        <div class="d-grid">
            <button type="submit" id="create" class="btn py-2">Edit</button>
        </div>
      </form>
</x-html-scope>