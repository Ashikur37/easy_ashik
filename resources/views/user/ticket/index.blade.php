@extends('layouts.user')
@section('title', "$lng->Ticket")
@section('content')
<div class="user-panel-content-wrapper">
  <div class="main-content-wrapper ticket-container">
      <h4 class="section-title bb-none">{{$lng->MyTickets}}
        <button class="default-btn ticket-create-btn" id="create-ticket">{{$lng->CreateNew}}</button>
      </h4>
     <div class="table-responsive">
        <table class="table">
          <thead>
            <tr class="title-row">
              <th>{{$lng->Subject}}</th>
              <th>{{$lng->Created}}</th>
              <th>{{$lng->Status}}</th>
              <th>{{$lng->Action}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tickets as $ticket)
            <tr>
              <td><span>{{$ticket->subject}}</span></td>
              <td><span>{{$ticket->created_at->diffForHumans()}}</span></td>
              <td>
                @if($ticket->status==1)
                <span class='status-badge success'>{{$lng->Open}}</span>
                @else
                <span class='status-badge danger'>{{$lng->Closed}}</span>
                @endif
              </td>
              <td>
                <span data-id="{{$ticket->id}}" class="show-chat-btn btn-view">
                  <i role="button" class="ri-eye-line"></i>
                </span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
     </div>
  </div>
  {!!$tickets->links()!!}
</div>
<div class='ticket' id="chat-box"></div>
<div class="modal fade" id="ticket-modal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"> 
     <div class="modal-body p-5">
        <h2 class="mb-4 text-center">Create Ticket</h2>
        <span class="close modal-close-btn" data-dismiss="modal"><i class="ri-close-line"></i></span>
        <form method="post" action="{{route('user.ticket-store')}}">
          <div class="form-group">
            @csrf
              <label>{{$lng->ComplainType }} *</label>
              <select name="ticket_category_id" data-size="7" data-live-search="true"
                                    class="ts-custom-select category-select wide"
                                    data-width="100%">
                @foreach($ticketCategories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="subject">{{$lng->Subject}} *</label>
              <input required placeholder="{{$lng->Subject}}" type="text" class="form-control" name="subject">
          </div>
          <div class="form-group">      
              <label for="message">{{$lng->Message}} *</label>      
              <textarea required name="message" class="form-control" placeholder="{{$lng->Message}}"></textarea>
          </div>
          <div class="form-group mb-0">    
              <button  class="default-btn px-4 mt-4">{{$lng->Submit}}</button>          
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('pageScripts')
<script>
  $(function () {
    $("#create-ticket").on('click', function() {
      $('#ticket-modal').modal('show');
      return;
    });
    $(".show-chat-btn").on('click',function() {
      let id = $(this).data('id');
      $("#chat-box").load("{{URL::to('/user/load-ticket')}}/" + id, function() {
        $("#chat-box").css('display', 'block')
        setTimeout(function(){
            $('#ticket-body').scrollTop($('#ticket-body')[0].scrollHeight);
          },300)
      });
    })
    $(document).on('submit', "form#ticket-form", {}, function(e) { 
      e.preventDefault();
      var formData = new FormData(this);
      showLoader()
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: $(this).attr("action"),
        type: 'POST',
        data: formData,
        success: function(data) {
          $("#chat-box").html(data);
          setTimeout(function(){
            $('#ticket-body').scrollTop($('#ticket-body')[0].scrollHeight);
          },300)
          hideLoader()
        },
        cache: false,
        contentType: false,
        processData: false
      });
    });
    $(document).on('click', '.ticket-closer', {}, function() {
      $("#chat-box").css('display', 'none')
    })
  });
</script>
@endsection