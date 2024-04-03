<x-html-scope title='HOME' btnTitle='Create new product' btnRoute='products.create'>
    @if (Session::has('success'))
        <div class="alert alert-success">
          {{Session::get('success')}}
        </div>
    @endif

      @if ($products->isNotEmpty())
      <table class="table border border-dark text-center">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Image</th>
            <th scope="col">Product name</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col">Created at</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ( $products as $item)
          <tr>
            <th scope="row">{{$item->id}}</th>
            <td>
              @if ($item->image != '')
                <img src="{{asset('uploads/products'.$item->image)}}"/>
              @else
                NULL
              @endif
            </td>
            <td>{{$item->name}}</td>
            <td>{{$item->price}}$</td>
            <td>{{$item->description}}</td>
            <td>{{\Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}</td>
            <td>
                <div class="d-flex gap-3 justify-content-center">
                  <a class="btn btn-info" href="{{route('products.edit',$item->id)}}">Edit</a>
                <form action="{{route('products.destroy',$item->id)}}" method="POST">
                  @csrf
                  @method('delete')
                  <button class="btn btn-danger"
                  id="delete-product-{{$item->id}}" 
                  onclick="deleteProduct({{$item->id}})">Delete</button>
                </form>
                </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
        <div class="d-flex align-items-center justify-content-center null" style="height: 50vh">
          <h1 class="text-center">NULL</h1>
        </div>
      @endif
</x-html-scope>

<script>
  let deleteProduct = (id)=>{
    if(confirm('Are you sure you want to delete this product?')){
      document.querySelector('#delete-product-'+id).submit();
    }
  }
</script>