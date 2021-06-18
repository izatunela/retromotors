<div class="market-content">
    @if($market_collection->isEmpty())
        <div class="items-empty">Nemate aktivnih oglasa</div>
    @endif
    @foreach($market_collection as $item)
    @php
    if (is_null($item->marketPhotoThumbnail)) {
        $img_path = asset('img/noimg.png');
    }
    else{
        $img_path = asset('storage/'.$item->marketPhotoThumbnail->path.'/tn-'.$item->marketPhotoThumbnail->filename);
    }
    @endphp
    <div class="market-item">
        <div class="img-sec ">
            <a href="{{route('market-'.$market_category.'-item',['title'=>$item->title_slug,'item'=>$item->id])}}">
                <img src="{{$img_path}}">
            </a>
        </div>
        <div class="title-sec">
            <a href="{{route('market-'.$market_category.'-item',['title'=>$item->title_slug,'item'=>$item->id])}}"><span class="title">{{$item->title}}</span></a>
            <p class="description">{{$item->description}}</p>
        </div>
        <div class="date-sec">
            <p class="datetime" title="{{$item->created_at->format('j.n.Y G:i:s')}}">{{$item->created_at->diffForHumans()}}</p>
        </div>
        <div class="views-sec">
            <p title="Broj pregleda"><i class="fas fa-eye"> </i> <span>{{$item->views}}</span></p>
        </div>
        <div class="actions">
            {{Form::open(['method'=>'post','url'=>route('market-'.$market_category.'-edit',['title'=>$item->title_slug]),'id'=>'','class'=>''])}}
                {{Form::hidden('id',$item->id)}}
                <div class="actions-btn">
                    <span><i class="fas fa-pencil-alt"></i></span>
                    {{Form::submit('Izmeni', ['id'=>'','class' => 'edit-button'])}}
                </div>
            {{Form::close()}}
            {{Form::open(['method'=>'delete','url'=>route('market-'.$market_category.'-delete',['item'=>$item->id]),'id'=>'','class'=>'del-form'])}}
                <div class="actions-btn">
                    <span><i class="fas fa-trash"></i></span>
                    {{Form::submit('Izbriši', ['id'=>'','class' => 'edit-button'])}}
                </div>
            {{Form::close()}}
        </div>
        <div class="mobile-item-settings-container d-md-none">
            <div class="settings-button-wrap" data-dropd-link = "{{$item->id}}">
                <i class="mobile-item-settings-btn fas fa-cog"></i>
            </div>
        </div>
    </div>
    <div class="mobile-dropdown-wrap d-md-none" data-dropd-link = "{{$item->id}}">
        <ul class="mobile-item-options">
            <li class="item-option">
                <div class="mobile-date-sec">
                    <span class="datetime" title="{{$item->created_at->format('j.n.Y G:i:s')}}">{{$item->created_at->diffForHumans()}}</span>
                </div>
                <div class="mobile-views-sec">
                    <span title="Broj pregleda">pregleda: <span>{{$item->views}}</span></span>
                </div>
            </li>
            <div class="dropdown-divider"></div>
        
            <li class="item-option">
                {{Form::open(['method'=>'post','url'=>route('market-'.$market_category.'-edit',['title'=>$item->title_slug]),'id'=>'','class'=>''])}}
                    {{Form::hidden('id',$item->id)}}
                    <div class="option-btn">
                        <span><i class="fas fa-pencil-alt"></i></span>
                        {{Form::submit('Izmeni', ['id'=>'','class' => 'edit-button'])}}
                    </div>
                {{Form::close()}}
            </li>
            <div class="dropdown-divider"></div>
            <li class="item-option">
                {{Form::open(['method'=>'delete','url'=>route('market-'.$market_category.'-delete',['item'=>$item->id]),'id'=>'','class'=>'del-form'])}}
                    <div class="option-btn">
                        <span><i class="fas fa-trash"></i></span>
                        {{Form::submit('Izbriši', ['id'=>'','class' => 'edit-button'])}}
                    </div>
                {{Form::close()}}
            </li>
            <div class="dropdown-divider"></div>
        </ul>
    </div>
    @endforeach
    <div class="pagination-wrap">	
        {{ $market_collection->links() }}
    </div>
</div>
