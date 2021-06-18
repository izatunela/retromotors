<div class="col-12 col-sm-12 col-lg-8">
	<div class="title">
		<h5>{{$Item->title}}</h5>
	</div>
	<div class="slider-wrapper">
		<div class="slider-img-pager">
			<span class="slider-img-pager-current">1 </span><span class="slider-img-pager-total"> / {{$Item->marketAllPhotos->count()}}</span>
		</div>
		<div id="imageGallery">
			@foreach($Item->marketAllPhotos as $photo)
			<?php
				//$title = $Item->manufacture_year.' '.$Item->brand->name.' '.$Item->model;
				$path = 'storage/'.$photo->path.'/'.$photo->filename;
				$tn_path = 'storage/'.$photo->path.'/tn-'.$photo->filename;
			?>
			<figure id="figure-wrap" data-thumb="{{asset($tn_path)}}" data-src="{{asset($tn_path)}}">
				<a data-size="{{getimagesize($path)[0]}}x{{getimagesize($path)[1]}}" itemprop="contentUrl" href="{{asset($path)}}">
					<img itemprop="thumbnail" class="item-img" src="{{asset($path)}}" alt="{{$Item->title}}" />
					<div class="zoom-wrap">
						<i id="zoom-overlay" class="fas fa-search-plus"></i>
					</div>
				</a>
			</figure>
			@endforeach
		</div>
	</div>
</div>
