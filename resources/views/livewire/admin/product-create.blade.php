<div>
    {{-- <div wire:init="loadBrands"> --}}


        <x-slot name="header">
            <div class="flex items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-600">
                    Crear Producto
                </h2>
            </div

        </x-slot>

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">

            <x-table>


                <div class="items-center px-6 py-4 bg-gray-200 sm:flex">
                    Creando un Producto
                </div>



                <div class="grid grid-cols-1 px-4 mx-auto mt-4 max-w-7xl sm:px-6 lg:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8">
                    <div class="py-2 mb-1">
                        <label>Producto o Servicio</label>
                        <select wire:model="prodservicio" class="py-0.5 rounded " data-placeholder="Selecccione" style="height:50%; width:100%">
                            <option value="" selected disabled >Seleccione</option>

                            <option value="1">Producto</option>
                            <option value="2">Servicio</option>

                        </select>
                        <x-jet-input-error for="prodservicio" />
                    </div>

                    <div class="py-2 mb-1" wire:ignore>
                        <label>Categorias </label>
                        <select wire:model="category_id" class="select2"  data-placeholder="Selecccione una categoria" style="height:50%; width:100%">
                            <option value="" selected disabled>Seleccione</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach

                        </select>
                        <x-jet-input-error for="category_id" />
                    </div>

                    <div class="py-2 mb-1" wire:ignore>
                            <label>Marcas</label>
                            <select wire:model="brand_id" class="py-2 select2ma" data-placeholder="Selecccione una marca" style="height:50%; width:100%">
                                 <option value="" selected disabled>Seleccione</option>
                                @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach

                            </select>
                            <x-jet-input-error for="brand_id" />
                    </div>

                    <div class="py-2 mb-1"  wire:ignore>
                            <label>Modelos</label>
                            <select wire:model="modelo_id" class="py-2 select2m" data-placeholder="Selecccione un modelo" style="height:50%; width:100%">
                                 <option value="" selected disabled>Seleccione</option>
                                @foreach($modelos as $modelo)
                                <option value="{{$modelo->id}}">{{$modelo->name}}</option>
                                @endforeach

                            </select>
                            <x-jet-input-error for="modelo_id" />
                    </div>

                    <div class="py-2 mb-1" wire:ignore>
                        <label>Unidad de medida</label>
                        <select wire:model="um_id" class="py-2 select2um"  data-placeholder="Selecccione una Unidad de medida" style="height:50%; width:100%">
                             <option value="" selected disabled>Seleccione</option>
                            @foreach($ums as $um)
                            <option value="{{$um->id}}">{{$um->abbreviation}}</option>
                            @endforeach

                        </select>
                        <x-jet-input-error for="um_id" />
                    </div>


                    <div class="py-2 mb-1">
                        <label>Moneda</label>
                        <select wire:model="currency_id" class="py-0.5 rounded " data-placeholder="Selecccione" style="height:50%; width:100%">
                            <option value="" selected disabled >Seleccione</option>

                            <option value="1">Soles</option>
                            <option value="2">Dolares</option>
                           {{--  <option value="3">Servicio</option> --}}

                        </select>
                        <x-jet-input-error for="currency_id" />
                    </div>


                    <div class="py-2 mb-1">
                        <label>Tipo de producto</label>
                        <select wire:model="typeproduct" class="py-0.5 rounded " data-placeholder="Selecccione" style="height:50%; width:100%">
                            <option value="" selected disabled >Seleccione</option>

                            <option value="1">Nuevo</option>
                            <option value="2">Usado</option>
                           {{--  <option value="3">Servicio</option> --}}

                        </select>
                        <x-jet-input-error for="typeproduct" />
                    </div>





                    <div class="w-full py-2 mb-1">
                        <label>Precio Compra</label>
                        <x-jet-input type="text"
                            wire:model="purchaseprice"
                            class="w-full py-1 rounded-lg"
                            placeholder="Precio Compra" />
                        <x-jet-input-error for="purchaseprice" />
                    </div>

                    <div class="w-full py-2 mb-1">
                        <label>Precio Venta</label>
                        <x-jet-input type="number"
                            wire:model="saleprice"
                            class="w-full py-1 rounded-lg"
                            placeholder="Precio Venta" />
                        <x-jet-input-error for="saleprice" />
                    </div>

                    <div class="w-full mb-2 mr-4">
                        <label>Precio Venta Minimo</label>
                        <x-jet-input type="text"
                            wire:model="salepricemin"
                            class="w-full py-1 rounded-lg"
                            placeholder="Precio Venta Min" />
                        <x-jet-input-error for="salepricemin" />
                    </div>

                    <div class="w-full mb-2 mr-4">
                        <label>Stock</label>
                        <x-jet-input type="text"
                            wire:model="stock"
                            class="w-full py-1 rounded-lg"
                            placeholder="stock" />
                        <x-jet-input-error for="stock" />
                    </div>

                    <div class="w-full mb-2 mr-4">
                        <label>Stock minimo</label>
                        <x-jet-input type="text"
                            wire:model="stockmin"
                            class="w-full py-1 rounded-lg"
                            placeholder="stock min" />
                        <x-jet-input-error for="stockmin" />
                    </div>

                    {{-- <div class="w-full mb-2 mr-4 lg:col-span-4"> --}}
                    <div class="w-full mb-2 mr-4 lg:col-span-2">
                        <label>Nombre</label>
                        <x-jet-input type="text"
                            wire:model="name"
                            class="w-full py-1 rounded-lg"
                            placeholder="Nombre del producto" />
                        <x-jet-input-error for="name" />

                    </div>


                    <div class="w-full mb-2 mr-4">
                        <label>Código de barras</label>
                        <x-jet-input type="text"
                            wire:model="codigo"
                            class="w-full py-1 rounded-lg"
                            placeholder="Código de barras" />
                        <x-jet-input-error for="codigo" />
                    </div>

                    <div class="mb-2 mr-4 ">
                        <label>Estado</label>
                        <x-jet-label class="flex">
                            <x-jet-input
                                type="radio"
                                wire:model="state"
                                class="flex py-1 "

                                name="state"
                                value="1" />
                            Activado

                            <x-jet-input
                            wire:model="state"
                            type="radio"
                            class="flex py-1 "

                            name="state"
                            value="0" />
                            Descativado
                        </x-jet-label>
                        <x-jet-input-error for="state" />
                    </div>




                    <div class="w-full mb-2 mr-4 lg:col-span-4">
                        <label>Descripción</label>
                        <textarea
                            wire:model="description"
                            class="w-full py-1 rounded-lg"
                            name="textarea" rows="5">

                            xyz
                        </textarea>
                        <x-jet-input-error for="description" />
                    </div>


                    <div class="mb-4">
                        <input type="file" wire:model="image" id="">
                        <p class="py-3 text-blue-400">tamaño 300px ancho por 200px alto</p>

                        <x-jet-input-error for="image"/>
                    </div>



                </div>

                <div class="flex justify-center mb-2">

                    <a href="{{ route('product.list') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25"> <i class="mx-2 fa-sharp fa-solid fa-xmark"></i> Cancelar</a>
                    <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="ml-2 disabled:opacity-25">
                        <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
                    </x-jet-danger-button>

                </div>
            </x-table>

        </div>



        <x-slot name="footer">

            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Pie
            </h2>


        </x-slot>



</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.slim.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

      document.addEventListener('livewire:load',function(){
        $('.select2').select2({
           tags:true
       });
        $('.select2').on('change', function(){
            @this.set('category_id', this.value);
        });
    })

</script>

<script>

    document.addEventListener('livewire:load',function(){
        $('.select2m').select2({
           tags:true
       });
        $('.select2m').on('change', function(){
            @this.set('modelo_id', this.value);
        });
    })
</script>


<script>

    document.addEventListener('livewire:load',function(){
        $('.select2ma').select2({
           tags:true
       });
        $('.select2ma').on('change', function(){
            @this.set('brand_id', this.value);
        });
    })
</script>


<script>
     document.addEventListener('livewire:load',function(){
        $('.select21').select2();
        $('.select21').on('change', function(){
            @this.set('subcategory_id', this.value);
        });
    })
</script>


<script>

    document.addEventListener('livewire:load',function(){
        $('.select2um').select2({
           tags:true
       });
        $('.select2um').on('change', function(){
            @this.set('um_id', this.value);
        });
    })
</script>

@endpush
