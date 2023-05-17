@extends('layouts.DirectDistributor')

@section('content')
    <section class="page">
        <h1 class="title">{{ __('messages.Quotations') }}</h1>

        <div class="card">
            <div class="tab-content"> 
                <div class="tab-header">
                    <form method="POST" action="{{ url('/distribuidor') }}/" class="form-search" >
                        @csrf @method('POST')
                        <input type="text" name="name" placeholder="{{ __('messages.Search') }}" class="form-control" >
    
                        <button type="submit"></button>
                    </form>
                    
                    <!-- add row -->
                    <a href="{{route('direct.distributor.quotation.create')}}" class="button-yellow-1" >
                        {{ __('messages.Add quotation') }}
                    </a>
                </div>

                <!-- table -->
                <div class="table">
                    <!-- thead -->
                    <div class="thead">
                        <div class="th" style="width:10%;">ID</div>
                        <div class="th">{{__('messages.Customer name')}}</div>
                        <div class="th">{{__('messages.Requester for quotation')}}</div>
                        <div class="th">{{__('messages.Date')}}</div>
                        <div class="th">Status</div>
                        <div class="th"></div>
                    </div>

                    <!-- list -->
                    @foreach ($quotation as $index)
                        <div class="tbody">
                            <div class="td" style="width:10%;">
                                <input type="text" value="{{trim($index->id)}}" class="form-input" readonly>
                            </div>

                            <div class="td">
                                @if ($index->customer_name)
                                    <input type="text" value="{{trim($index->customer_name)}}" class="form-input" readonly>
                                @else
                                    - - - - -
                                @endif
                            </div>

                            <div class="td">
                                @if ($index->requester_quotation)
                                    <input type="text" value="{{trim($index->requester_quotation)}}" class="form-input" readonly>
                                @else
                                    - - - - -
                                @endif
                            </div>

                            <div class="td">
                                @if ($index->reply_date)
                                    <input type="text" value="{{date("d/m/Y", )}}" class="form-input" readonly>
                                @else
                                    - - - - -
                                @endif
                            </div>

                            <div class="td">
                                <input type="text" value="{{$index->status === 'A' ? __('messages.Pending') : __('messages.Sent') }}" class="form-input" readonly>
                            </div>

                            <div class="td">
                                <div class="table-button">
                                    <a href="{{route('direct.distributor.quotation.show', $index->id)}}" data-button="view">
                                        <span class="tooltip">{{__('messages.View')}}</span>
                                    </a>

                                    <a href="" data-button="download">
                                        <span class="tooltip">{{__('messages.Download')}}</span>
                                    </a>

                                    @if ($index->status != 'S')
                                        <button type="button" data-trigger="delete" onclick="">
                                            <span class="tooltip">{{__('messages.Delete')}}</span>
                                        </button>  
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{ $quotation->links() }}
            </div>
        </div>    
    </section>
@endsection