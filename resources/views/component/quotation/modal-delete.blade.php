<div class="modal" id="delete">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <form method="POST" class="modal-form">
            @csrf @method('POST')  
            <input type="hidden" name="id_delete" id="id_delete">
            
            <div class="modal-header">
                <button type="button" data-modal="close"></button>
            </div>

            <div class="modal-body">
                <div class="modal-icon"></div>

                <h2 class="modal-title">{{ __('messages.Are you sure you want to delete?') }}</h2>
            </div>

            <div class="modal-footer">
                <button type="button" data-modal="cancel" >
                    {{ __('messages.Cancel') }}
                </button>

                <button type="submit" data-modal="submit" >
                    {{ __("messages.Delete") }}
                </button>
            </div>
        </form>
    </div>
</div>