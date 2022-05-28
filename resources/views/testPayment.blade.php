<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>transaction #{{ $details->number }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <style>
        html {
            font-size: 14px;
        }

        @media (min-width: 768px) {
            html {
                font-size: 16px;
            }
        }

        .container {
            max-width: 960px;
        }

        .pricing-header {
            max-width: 700px;
        }

        .card-deck .card {
            min-width: 220px;
        }

        .btransaction-top {
            btransaction-top: 1px solid #e5e5e5;
        }

        .btransaction-bottom {
            btransaction-bottom: 1px solid #e5e5e5;
        }

        .box-shadow {
            box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
        }

    </style>
</head>

<body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white btransaction-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal"></h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="https://jurnalmms.web.id/"></a>
            <a class="p-2 text-dark" href="https://github.com/mulyosyahidin"></a>
            <a class="p-2 text-dark" href="https://instagram.com/mul.yoo"></a>
        </nav>
    </div>

    <div class="container pb-5 pt-5">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Data transaction</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed">
                            <tr>
                                <td>ID</td>
                                <td><b>#{{ $details->number }}</b></td>
                            </tr>
                            <tr>
                                <td>Total Harga</td>
                                <td><b>Rp {{ number_format($details->total_price, 2, ',') }}</b></td>
                            </tr>
                            <tr>
                                <td>Status Pembayaran</td>
                                <td><b>
                                        @if ($details->payment_status == 1)
                                            Menunggu Pembayaran
                                        @elseif ($details->payment_status == 2)
                                            Sudah Dibayar
                                        @else
                                            Gagal
                                        @endif
                                    </b></td>
                            </tr>
                            <tr>
                                <td>Tanggal Dibuat</td>
                                <td><b>{{ $details->transaction->ts_dibuat->format('d M Y H:i') }}</b></td>
                            </tr>
                            @if ($details->ts_dibayar)
                            <tr>
                                <td>Tanggal Dibayar</td>
                                <td><b>{{ $details->ts_dibayar->format('d M Y H:i') }}</b></td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Pembayaran</h5>
                    </div>
                    <div class="card-body">
                            <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script>
        const payButton = document.querySelector('#pay-button');
        payButton.addEventListener('click', function(e) {
            e.preventDefault();

            snap.pay('{{ $details->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    window.location.replace('{{ route('validation') }}');
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    window.location.replace('{{ route('validation') }}');
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                }
            });
        });
    </script>

</body>

</html>
