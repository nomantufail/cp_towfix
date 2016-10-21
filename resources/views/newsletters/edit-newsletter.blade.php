<?php
/**
 * Created by PhpStorm.
 * User: nomantufail
 * Date: 10/6/2016
 * Time: 3:25 PM
 */
?>
@extends('app')

@section('page')
    <?php
    //dd($errors);
    ?>
    <section class="add-vehicle">
        @if(\Session::has('success'))
            <h4>
                {{\Session::get('success')}}
            </h4>
        @endif
        <h2 class="main-heading">Edit A Newsletter</h2>
        <div class="add-vehicle-widget">
            <form class="add-vehicle-form" method="post" action="{{url('/')}}/newsletter/edit/{{$newsletter->id}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <label>
                    <span>Newsletter Title</span>
                    <input type="text" name="name" value="{{$newsletter->name}}" placeholder="Newsletter title">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('name') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>


                <label style="clear: both">
                    <span>Detail</span>
                    <textarea name="detail" placeholder="Detail">{{$newsletter->detail}}</textarea>
                    @if ($errors->has('detail'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('detail') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>
                <input type="hidden" id="record_id" value="{{$newsletter->id}}">
                @if($newsletter->image != "")
                    <img id="image_path" src="{{ url('/').$newsletter->image }}" />
                    <input type="button" class="btn btn btn-primary" id="delete_image" value="Delete">
                @endif
                <label  style="clear: both" id="file_chooser">
                    <input id="image" type="file" name="image">
                </label>
                <label class="submit">
                    <input type="submit" class="btn btn btn-primary" name="submit" value="Submit">
                </label>

            </form>
        </div>
    </section>
    <script>


        $(function() {
            if($('#image_path').length){
                $('#file_chooser').hide();
            }
        } );

        $(document).on("click", "#delete_image", function () {

            var path = $('#image_path').attr('src');
            var id = $("#record_id").val();
            deleteImage(path , id);
        });

        function deleteImage(path , id)
        {
            $.ajax({

                type: 'POST' ,
                data: {path: path , id: id, _token:"<?= csrf_token() ?>" },
                url: base_url + 'deleteImage' ,
                success: function (data)
                {
                    $('#file_chooser').show();
                    $("#delete_image").hide();
                    $("#image_path").hide();
                }
            });

        }
    </script>
@endsection