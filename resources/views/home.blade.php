@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="alert" role="alert">
                
                <h2>product session</h2>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    register product
                </button>
                
                   <br><br>

                      <div class="table-responsive">
                      <table class="table">
                      <thead>
                          <tr>
                          <th scope="col">#</th>
                          <th scope="col">sku</th>
                          <th scope="col">name</th>
                          <th scope="col">quantity</th>
                          <th scope="col">price</th>
                          <th scope="col">description</th>
                          <th scope="col">img</th>
                          <th scope="col">Opciones</th>
                          </tr>
                      </thead>
                      <tbody>
                      @foreach ($products as $product)
                      <tr>
                          <th scope="row">1</th>
                          <td>{{$product->sku}}</td>
                          <td>{{$product->name}}</td>
                          <td>{{$product->quantity}}</td>
                          <td>{{$product->price}}</td>
                          <td>{{$product->description}}</td>
                          <td>{{$product->img}}</td>
                          <td>
                          <a href="#" class="btn btn-success btn-sm">Editar</a>
                             <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{$product->id}}">Eliminar</button></td>
                          </tr>

                          <div class="modal fade" id="modal{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Eliminar producto</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">    
                                  ¿Está seguro que desea eliminar el producto <strong>{{ $product->name }}</strong>?
                              </div>
                              <div class="modal-footer">
                                  
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, cancelar</button>

                                  <form action="{{ route('products-destroy', [$product->id]) }}" method="POST">
                                      @method('DELETE')
                                      @csrf
                                      <button type="submit" class="btn btn-primary">Sí, eliminar producto</button>
                                  </form>
                                  
                              </div>
                            </div>
                          </div>
                      </div>

                      @endforeach
                      </tbody>
                      </table>

                </div>     
              </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('products-store')}}" method="POST">
      @csrf
      <div class="input-group flex-nowrap">
        <input type="text" class="form-control" placeholder="sku" name="sku">
      </div>

      <div class="input-group flex-nowrap">
        <input type="text" class="form-control" placeholder="name" name="name">
      </div>

      <div class="input-group flex-nowrap">
        <input type="text" class="form-control" placeholder="quantity" name="quantity">
      </div>

      <div class="input-group flex-nowrap">
        <input type="text" class="form-control" placeholder="price" name="price">
      </div>

      <div class="input-group flex-nowrap">
        <input type="text" class="form-control" placeholder="description" name="description">
      </div>

      <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupFile01">Upload</label>
        <input type="file" class="form-control" id="inputGroupFile01" name="img">
    </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>

      </form> 
      </div>
    </div>
  </div>
</div>
@endsection
