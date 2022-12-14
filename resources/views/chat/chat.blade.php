@extends('customer.dashboard.dashboard')
@section('content')


<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<style>
body{
    background:#eee;
}
.chat-list {
    padding: 0;
    font-size: .8rem;
}
.chat-list li {
    margin-bottom: 10px;
    overflow: auto;
    color: #ffffff;
}
.chat-list .chat-img {
    float: left;
    width: 48px;
}
.chat-list .chat-img img {
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    width: 100%;
}
.chat-list .chat-message {
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 20px;
    background: #5a99ee;
    display: inline-block;
    padding: 10px 20px;
    position: relative;
}
.chat-list .chat-message:before {
    content: "";
    position: absolute;
    top: 15px;
    width: 0;
    height: 0;
}
.chat-list .chat-message h5 {
    margin: 0 0 5px 0;
    font-weight: 600;
    line-height: 100%;
    font-size: .9rem;
}
.chat-list .chat-message p {
    line-height: 18px;
    margin: 0;
    padding: 0;
}
.chat-list .chat-body {
    margin-left: 20px;
    float: left;
    width: 70%;
}
.chat-list .in .chat-message:before {
    left: -12px;
    border-bottom: 20px solid transparent;
    border-right: 20px solid #5a99ee;
}
.chat-list .out .chat-img {
    float: right;
}
.chat-list .out .chat-body {
    float: right;
    margin-right: 20px;
    text-align: right;
}
.chat-list .out .chat-message {
    background: #fc6d4c;
}
.chat-list .out .chat-message:before {
    right: -12px;
    border-bottom: 20px solid transparent;
    border-left: 20px solid #fc6d4c;
}
.card .hcdr:first-child {
    -webkit-border-radius: 0.3rem 0.3rem 0 0;
    -moz-border-radius: 0.3rem 0.3rem 0 0;
    border-radius: 0.3rem 0.3rem 0 0;
}
.card .hcd {
    background: #17202b;
    border: 0;
    font-size: 1rem;
    padding: .65rem 1rem;
    position: relative;
    font-weight: 600;
    color: #ffffff;
}
.content{
    margin-top:-30px;
}
.ccd {
    height: 450px;
    overflow-x: hidden;
    overflow-y: auto;
    text-align:justify;
    }
.bottom_wrapper {
  width: 100%;
  background-color: #fff;
  padding: 20px 20px;
  bottom: 0;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
}
.bottom_wrapper .message_input_wrapper {
  display: inline-block;
  height: 50px;
  border-radius: 25px;
  border: 1px solid #bcbdc0;
  width: calc(100% - 160px);
  position: relative;
  padding: 0 20px;
}
.bottom_wrapper .message_input_wrapper .message_input {
  border: none;
  height: 100%;
  box-sizing: border-box;
  width: calc(100% - 40px);
  position: absolute;
  outline-width: 0;
  color: gray;
}
.bottom_wrapper .send_message {
  width: 140px;
  height: 50px;
  display: inline-block;
  border-radius: 50px;
  background-color: #fff;
  border: 2px solid #a3d063;
  color: #a3d063;
  cursor: pointer;
  transition: all 0.2s linear;
  text-align: center;
  float: right;
  font-size: 18px;
  font-weight: 300;
  display: inline-block;
  line-height: 18px;
}
.bottom_wrapper .send_message:hover {
  color:  #fff;
  background-color: #a3d063;
}
.btn-gradientt {
    width:20%;
    position: relative;
    display: inline-block;
    left:-90px;
    background: rgba(0, 0, 0, 0.15);
    border-top-right-radius: 60px;
    border-top-left-radius: 60px;
    border-bottom-left-radius: 60px;
    padding: 8px 24px 8px 16px;
    box-shadow: 2px 0px 0px 0px rgba(78, 72, 72, 0.4);
    }
.btn-pink{
    border-radius: 50px;
    font-size:15px;
    padding:0px 20px;
    color: #fff;
    background-color: #f11350;
    border:none;
    justify-content: center;
    align-items: center;
    display: flex;
    width:400px;
    margin: auto;
}
.card .hcd p{
display:inline;
}
</style>
</head>
<body>


        	<div class="card">
        		<div class="card-header hcd">
                    <img class="rounded-circle" src="../img/{{$rider->image}}" alt="" width=40 height = 40>
                    <p class="text-white mx-2">{{$rider->name}}</p>
                </div>
                <div class="ccd" id="ccd">
        		<div class="card-body height3">
        			<ul class="chat-list" id="here">
                    @foreach($chats as $chat)
                    @if(!empty($chat->rmessage))
        				<li class="in">
        					<div class="chat-img">
        						<img alt="Avtar" src="../imag/{{$rider->image}}">
        					</div>
        					<div class="chat-body">
        						<div class="chat-message">
        							<h5>{{$rider->name}}</h5>
                                    <br>
        							<h6>{{$chat->rmessage}}</h6>
                                    <p><small>{{$chat->time}}</small></p>
        						</div>
        					</div>
        				</li>
                        @else
                        <br>
                        @endif
                        @if(!empty($chat->cmessage))
        				<li class="out">
        					<div class="chat-img">
        						<img alt="Avtar" src="../customer_image/{{$cus->image}}">
        					</div>
        					<div class="chat-body">
        						<div class="chat-message">
        							<h5>{{$cus->name}}</h5>
                                    <br>
        							<h6>{{$chat->cmessage}}</h6>
                                    <p><small>{{$chat->time}}</small></p>
        						</div>
        					</div>
        				</li>
                        @else
                        <br>
                        @endif
                        @endforeach
        			</ul>
        		</div>
                </div>
        	</div>
         <div class="bottom_wrapper clearfix">
          <form action="{{route('userChatSend')}}" method="post" name="form">
          {{csrf_field()}}
         <div class="message_input_wrapper">

            <input class="message_input" placeholder="Type your message here..." type="text" name="msg">
         </div>
         
         <input type="submit" class="send_message" value="Send">
          </form>
         </div>



</body>

  <script>
   $(document).ready(function(){
   window.setInterval(function(){
   $("#here").load(" #here > *");
   }, 500);
   });
   const theElement = document.getElementById('ccd');
   const scrollToBottom = (node) => {
	node.scrollTop = node.scrollHeight;
   }
scrollToBottom(theElement);
</script>

@endsection