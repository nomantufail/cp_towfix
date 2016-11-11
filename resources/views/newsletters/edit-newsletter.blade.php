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
    <?php
    //dd($errors);
    ?>
    <section class="add-vehicle">
        @if(\Session::has('success'))
            <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <h4>
                    {{\Session::get('success')}}
                </h4>
            </div>
        @endif
        <h2 class="main-heading">Edit A Newsletter</h2>
        <ul class="add-vehicle-widget">
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
                    <textarea name="detail" placeholder="Detail">{{str_limit($newsletter->detail , 150)}}</textarea>
                    @if ($errors->has('detail'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('detail') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>
                <input type="hidden" id="record_id" value="{{$newsletter->id}}">
                <ul class="attach-list">
                    @foreach($newsletter->images as $img)
                        <li style="background-image: url('{{ url('/').$img->path }}')" data-id="{{$img->id}}">
                            <div class="attach-hover">
                                <a class="fancybox" href="{{ url('/').$img->path }}"><i class="fa fa-search fa-fw"></i></a>
                                {{--<img class="image_path" src="{{ url('/').$img->path }}" data-id="{{$img->id}}"/>--}}
                                <a class="del-img-btn" style="font-size: 25px;"><i class="fa fa-trash fa-fw"></i> </a>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <label style="clear: both">
                    <input type="file" name="images[]" multiple id="file_chooser">
                    @if ($errors->has('images'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('images') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>
                <label class="submit">
                    <input type="submit" class="btn btn btn-primary" name="submit" value="Submit">
                </label>

            </form>
        </div>
    </section>
    <script>

        $(function() {
            hide_show_add_img_btn();
        } );

        function hide_show_add_img_btn()
        {
            if($('.image-packet').length >= 10){
                $('#file_chooser').hide();
            }else{
                $('#file_chooser').show();
            }
        }

        $(document).on('click', '.del-img-btn', function(){
            let btn = $(this);
            let image_id = btn.closest('li').attr('data-id');
            $.ajax({type: 'POST' , data: {'_token':"<?=csrf_token()?>" }, url: base_url + 'newsletter_image/delete/'+image_id ,
                success: function (data){
                    btn.closest('li').remove();
                    hide_show_add_img_btn();
                }
            });
        });
        $(document).ready(function() {
            $(".fancybox").fancybox();
        });
    </script>
@endsection