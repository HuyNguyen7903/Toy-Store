$(document).ready(function () {
    $('input[name="payment-method"]').change(function() {
        // Ẩn tất cả QR code và các input của thẻ
        $('.qr-code').addClass('hidden');
        $('.credit-card-inputs').addClass('hidden');
        // Kiểm tra giá trị của radio button đã chọn
        if (this.value === 'VNPAY' || this.value === 'Banking') {
            // Hiện QR code tương ứng
            $(this).siblings('.qr-code').removeClass('hidden');
        } else if (this.value === 'credit-card') {
            // Hiện input của thẻ nội địa
            $(this).siblings('.credit-card-inputs').removeClass('hidden');
        }
    });

    $('input[name="ngayhethan"]').on('input', function (e) {
        let value = $(this).val();
    
        // Automatically add '/' after the month
        if (value.length === 2 && e.originalEvent.inputType !== 'deleteContentBackward') {
            $(this).val(value + '/');
            value = $(this).val(); // Update the value after adding the slash
        }
    
        // Validate month and year
        if (value.length === 5) {
            const [MM, YY] = value.split('/').map(num => parseInt(num, 10));
            
            if (MM < 1 || MM > 12 || YY < 23) {
                alert("Tháng và năm hết hạn không hợp lệ");
                $(this).val('');
            }
        }
    });
    
    
});
