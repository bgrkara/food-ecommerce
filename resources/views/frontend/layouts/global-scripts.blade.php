<script>

/** Show Sweet Confirm Alert **/
$('body').on('click', '.delete-item', function (e){
    e.preventDefault();
    let url = $(this).attr('href');
    Swal.fire({
        title: 'Emin misin?',
        text: "Silme İşlemini Geri Döndüremezsiniz",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Evet, Silin!',
        cancelButtonText: 'İptal',
        customClass: {
            confirmButton: 'btn btn-primary me-3',
            cancelButton: 'btn btn-label-secondary'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                method: 'DELETE',
                url: url,
                data: {_token: '{{ csrf_token() }}' },
                success: function (response){
                    if(response.status === 'success'){
                        toastr.success(response.message)
                        window.location.reload();
                    }else if(response.status === 'error'){
                        toastr.error(response.message)
                    }
                },
                error: function (error){
                    console.error(error)
                }
            })
        }
    });
})

/** Load Product Modal **/
function loadProductModal(productId){
    $.ajax({
        method: 'GET',
        url: "{{ route('load-product-modal', ':productId') }}".replace(':productId', productId),
        success: function (response) {
            $('.load_product_modal_body').html(response);
            $('#popupAddcart').modal('show');

        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    })
}

/** Update Menu Cart **/
function updateSidebarCart(callback = null) {

    $.ajax({
        method: 'GET',
        url: '{{ route("get-cart-products") }}',
        success: function (response) {
            $('.cart-contents').html(response);
            let cartTotal = $('#cart_total').val();
            let cartCount = $('#cart_product_count').val();
            $('.cart_subtotal').text("{{ currencyPosition(':cartTotal') }}".replace(':cartTotal', cartTotal));
            $('.cart_count').text(cartCount);

            if(callback && typeof callback === 'function'){
                callback();
            }

        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    })

}

/**  Remove Product From Sidebar **/

function removeProductFromSidebar($rowId, $id){
    $.ajax({
        method: 'GET',
        url: '{{ route("cart-product-remove", ":rowId") }}'.replace(":rowId", $rowId),
        beforeSend: function () {
            $('.cart-remove-btn-' + $id).attr('disabled', true).html('<span class="loader-remove"></span>')
        },
        success: function (response){
            if(response.status === 'success'){
                updateSidebarCart(function () {
                    toastr.success(response.message);
                    setTimeout(() => {
                        $('.cart-remove-btn-' + $id).html('<i class="icon-cross"></i>').attr('disabled', false);
                    }, 1000);
                });
            }
        },
        error: function (xhr, status, error){
            let errorMessage = xhr.responseJSON.message;
            toastr.error(errorMessage)
        }
    })
}

/**  Get Current Amount Cart Total **/

function getCartTotal(){
    return parseInt('{{ cartTotal() }}');
}


</script>
