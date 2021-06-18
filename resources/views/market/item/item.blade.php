@extends('master')
@section('title',$Item->title)
@section('og-type','article')
@section('og-image',asset('storage/'.$Item->marketPhotoThumbnail->path.$Item->marketPhotoThumbnail->filename))
@section('og-image-width','640')
@section('og-image-height','480')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/plugin/lightslider.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/plugin/photoswipe.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/plugin/default-skin/default-skin.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/market/market-item.css')}}"/>
@endsection

@section('content')
    @yield('item-category')
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('js/plugin/lightslider.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugin/photoswipe.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugin/photoswipe-ui-default.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugin/photoswipe-tn.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            let pager = $('.slider-img-pager-current');
            $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem: 8,
                pager:true,
                currentPagerPosition:'left',
                mode: 'fade',
                responsive:[
                    {
                        breakpoint:768,
                        settings:{
                            thumbItem: 5,
                            mode:'slide'
                        }
                    },
                ],
                onBeforeSlide: function (el) {
                    pager.html(el.getCurrentSlideCount());
                },
            });  
        });
    </script>
@endsection