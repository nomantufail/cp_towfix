<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/6/2016
 * Time: 3:25 PM
 */
?>
@extends('app')
@section('page')
    <section class="vehicles-list">
        <div class="vehicles-head">
            <h2>My Shopping Cart</h2>
        </div>
        <div class="vehicles-list-content">
            <div class="vehicles-table">
                @if(\Session::has('success'))
                    <h4>
                        {{\Session::get('success')}}
                    </h4>
                @endif

                <form action="{{url('/cart/confirm')}}" method="post">
                    {{csrf_field()}}
                    <table id="tableStyle" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>quantity</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                        <tr>
                            <input type="hidden" name="item[{{$item->id}}][id]" value="{{$item->id}}" class="item_id">
                            <input type="hidden" name="item[{{$item->id}}][product_id]" value="{{$item->product->id}}" class="product_id">
                            <input type="hidden" name="item[{{$item->id}}][price]" value="{{$item->product->price}}" class="product_price">
                            <td>{{$item->product->name}}</td>
                            <td><input type="number" name="item[{{$item->id}}][quantity]" value="{{$item->quantity}}" class="item_quantity"></td>
                            <td class="computed_price"></td>
                            <td>
                                <a class="remove_item">delete</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr style="font-weight: bold">
                            <td colspan="2">Total Price</td>
                            <td id="computed_total_price"></td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                    <input type="submit" value="Save & Continue -->">
                </form>
            </div>
        </div>
    </section>
    <script>
        function quantityChanged(){
            var total_price = 0;
            $('.item_quantity').each(function () {
                var quantity = $(this).val();
                var price = $(this).closest('tr').find('.product_price').val();
                var computed_price = parseFloat(quantity) * parseFloat(price);
                $(this).closest('tr').find('.computed_price').html(computed_price);
                total_price+=computed_price;
            });
            $("#computed_total_price").html(total_price);
        }
        $(document).on('change keyup', '.item_quantity', function () {
            quantityChanged();
        });

        $(document).on('click','.remove_item', function () {
            var tr = $(this).closest('tr');
            var product_id = $(this).closest('tr').find('.product_id').val();
            $.ajax({type: 'POST' , data: {'_token':"<?=csrf_token()?>" }, url: base_url + 'cart/remove/'+product_id ,
                success: function (data){
                    tr.remove();
                    quantityChanged();
                },
                error: function () {
                    alert('something went wrong with the server!');
                }
            });
        });

        $(document).ready(function () {
            quantityChanged();
        });
    </script>
@endsection