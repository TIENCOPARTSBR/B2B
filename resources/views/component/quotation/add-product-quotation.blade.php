<form class="form-quotation" id="form-quotation">
    <input type="hidden" name="quotation_id" value="{{$id}}">
    <input type="text" id="part_number" name="part_number" placeholder="{{__('messages.Type the code')}}">

    <button type="submit">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="8" cy="8" r="7" stroke-width="2"/>
            <path d="M17 17L13 13" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </button>

    <i class="warning">{{__('messages.Search one part number at a time')}}</i>
</form>