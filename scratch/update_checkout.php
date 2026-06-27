<?php

$file_path = 'c:\\laragon\\www\\Aplikasi-Rental\\resources\\views\\livewire\\checkout.blade.php';
$content = file_get_contents($file_path);

// 1. Replace payment methods section
// We replace Transfer Bank and QRIS labels with Midtrans label
$old_transfer = '<label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer transition {{ $paymentMethod === \'Transfer Bank\' ? \'border-emerald-600 bg-emerald-50 shadow-sm\' : \'border-slate-300 bg-white hover:border-emerald-300\' }}">
                            <input type="radio" wire:model.live="paymentMethod" name="payment_method" value="Transfer Bank" class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-500">
                            <span class="text-sm font-medium {{ $paymentMethod === \'Transfer Bank\' ? \'text-emerald-700\' : \'text-slate-700\' }}">Transfer Bank</span>
                        </label>';

$old_qris = '<label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer transition {{ $paymentMethod === \'QRIS\' ? \'border-emerald-600 bg-emerald-50 shadow-sm\' : \'border-slate-300 bg-white hover:border-emerald-300\' }}">
                            <input type="radio" wire:model.live="paymentMethod" name="payment_method" value="QRIS" class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-500">
                            <span class="text-sm font-medium {{ $paymentMethod === \'QRIS\' ? \'text-emerald-700\' : \'text-slate-700\' }}">QRIS</span>
                        </label>';

$new_midtrans = '<label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer transition {{ $paymentMethod === \'Midtrans\' ? \'border-emerald-600 bg-emerald-50 shadow-sm\' : \'border-slate-300 bg-white hover:border-emerald-300\' }}">
                            <input type="radio" wire:model.live="paymentMethod" name="payment_method" value="Midtrans" class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-500">
                            <span class="text-sm font-medium {{ $paymentMethod === \'Midtrans\' ? \'text-emerald-700\' : \'text-slate-700\' }}">Online Payment (Midtrans)</span>
                        </label>';

$content = str_replace($old_transfer, $new_midtrans, $content);
$content = str_replace($old_qris, '', $content);

// 2. Remove Info Tujuan Pembayaran and Upload Bukti
$info_start = '{{-- Info Tujuan Pembayaran --}}';
$info_end = '<div class="mt-4 rounded-md bg-amber-50 p-3 border border-amber-200">';
$pos_start = strpos($content, $info_start);
$pos_end = strpos($content, $info_end);
if ($pos_start !== false && $pos_end !== false) {
    $content = substr_replace($content, '', $pos_start, $pos_end - $pos_start);
}

// 3. Add Midtrans Snap Script at the top of the file
$snap_script = '<script src="{{ env(\'MIDTRANS_IS_PRODUCTION\', false) ? \'https://app.midtrans.com/snap/snap.js\' : \'https://app.sandbox.midtrans.com/snap/snap.js\' }}" data-client-key="{{ env(\'MIDTRANS_CLIENT_KEY\') }}"></script>';

$content = str_replace('<div class="min-h-screen bg-slate-100/80 p-3 lg:p-4">', '<div class="min-h-screen bg-slate-100/80 p-3 lg:p-4">' . "\n    " . $snap_script, $content);

// 4. Add Javascript listener for snap-pay
$js_listener = <<<EOT
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('snap-pay', (event) => {
                const snapToken = event.token;
                snap.pay(snapToken, {
                    onSuccess: function(result) {
                        window.location.href = '/checkout/success?kode_rental=' + result.order_id;
                    },
                    onPending: function(result) {
                        window.location.href = '/checkout/success?kode_rental=' + result.order_id;
                    },
                    onError: function(result) {
                        Swal.fire('Gagal!', 'Pembayaran gagal.', 'error');
                    },
                    onClose: function() {
                        Swal.fire('Warning!', 'Anda menutup popup pembayaran sebelum menyelesaikannya.', 'warning');
                    }
                });
            });
        });
    </script>
EOT;

$content = str_replace('</script>

    @if($showDataIncompleteModal)', "</script>\n\n" . $js_listener . "\n\n    @if(\$showDataIncompleteModal)", $content);

file_put_contents($file_path, $content);
echo "checkout.blade.php updated successfully.";
