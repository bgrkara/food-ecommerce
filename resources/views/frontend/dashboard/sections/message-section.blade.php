<div class="tab-pane" id="messages">
    <div class="fp_dashboard_body fp__change_password">
        <div class="fp__message">
            <h3>Müşteri Destek Platformu</h3>
            <div class="fp__chat_area">
                <div class="fp__chat_body">
{{--                    <div class="fp__chating">--}}
{{--                        <div class="fp__chating_img">--}}
{{--                            <img src="images/service_provider.png" alt="person"--}}
{{--                                 class="img-fluid w-100">--}}
{{--                        </div>--}}
{{--                        <div class="fp__chating_text">--}}
{{--                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.--}}
{{--                                Pariatur qui amet aperiam, magni accusamus voluptatum--}}
{{--                                neque--}}
{{--                                aut tenetur odit officia fugit et sint harum inventore--}}
{{--                                recusandae id quibusdam ducimus consequuntur.</p>--}}
{{--                            <span>15 Jun, 2023, 05:26 AM</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="fp__chating tf_chat_right">--}}
{{--                        <div class="fp__chating_img">--}}
{{--                            <img src="images/client_img_1.jpg" alt="person"--}}
{{--                                 class="img-fluid w-100">--}}
{{--                        </div>--}}
{{--                        <div class="fp__chating_text">--}}
{{--                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.--}}
{{--                            </p>--}}
{{--                            <span>15 Jun, 2023, 05:26 AM</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <form class="fp__single_chat_bottom chat_input">
                    @csrf
                    <label for="select_file"><i class="fa fa-file" aria-hidden="true"></i></label>
                    <input type="text" placeholder="Bir mesaj yazın..." name="message" class="fp_send_message">
                    <input type="hidden" name="receiver_id" value="1">

                    <button type="submit" class="fp__massage_btn"><i class="fa fa-paper-plane"
                                                       aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function (){
            $('.chat_input').on('submit', function (e){
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    method: 'POST',
                    url: '{{ route("chat.send-message") }}',
                    data: formData,
                    beforeSend: function (){
                         let message = $('.fp_send_message').val();
                         let html = `<div class="fp__chating tf_chat_right">
                                       <div class="fp__chating_img">
                                       <img src="images/client_img_1.jpg" alt="person" class="img-fluid w-100">
                                       </div>
                                       <div class="fp__chating_text">
                                       <p>${message}</p>
                                       <span>15 Jun, 2023, 05:26 AM</span>
                                       </div>
                                    </div>`

                        $('.fp__chat_body').append(html)
                    },
                    success: function (response){
                    },
                    error: function (xhr, status, error){
                        let errors = xhr.responseJSON.errors;
                        $.each(errors,function (key,value){
                            toastr.error(value);
                        })
                    },
                })
            });
        })
    </script>
@endpush
