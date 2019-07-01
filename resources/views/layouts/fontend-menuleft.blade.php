<div class="left-sidebar">
        <h2>ประเภทสินค้า</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <div class="panel panel-default">
                @foreach ($categorise as $key => $value)
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian" href="#{{  $value['id']  }}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                {{ $value['name'] }}
                            </a>
                        </h4>
                    </div>
                    <div id="{{ $value['id'] }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach ($value['categories'] as $key => $subValue)
                                    <li><a href="{{ asset('/product/'.$subValue['url']) }}">{{ $subValue['name'] }} </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div><!--/category-products-->
    </div>
