<div class='ticket-header'>{{ $product->name }}</div>
<span class="ticket-closer"><i class="ri-close-line"></i></span>
<div id="ticket-body" class='ticket-body custom-scrollbar'>
    <ul id='conversation'>
        @foreach ($messages as $message)
            <li class='{{ $message->sender_id == auth()->id() ? 'message-left' : 'message-right' }}'>
                <div class='message-avatar'>
                    <div class='avatar'>
                        <i class="ri-user-fill"></i>
                    </div>
                </div>
                <div class='message-text'>{{ $message->message }}</div>
                @if ($message->attachment)
                    <div class="attachment">
                        <a href="{{ asset('images/ticket/' . $message->attachment) }}">
                            <img src="{{ asset('images/ticket/' . $message->attachment) }}" />
                        </a>
                    </div>
                @endif
                <div class='message-hour'>{{ $message->created_at->format('M-d h:i a') }}
                    <span class='ri-check-double-line'></span>
                </div>
            </li>
        @endforeach
    </ul>
</div>

    <form id="ticket-form" action="{{ route('user.product-message', $product->id) }}">
        <div class='ticket-form-wrapper d-flex'>
            <div class="input-group">
                <input required type="text" id='message' name="message" class="form-control"
                    placeholder="{{ $lng->Message }}">
               
                <div class="input-group-append">
                    <button class="input-group-text" id="submit-btn">{{ $lng->Send }}</button>
                </div>
            </div>
        </div>
    </form>

