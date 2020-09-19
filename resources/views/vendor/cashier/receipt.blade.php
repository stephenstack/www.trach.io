<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>trach.io Invoice</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }

        body {
            margin: 0px;
        }

        * {
            font-family: Verdana, Arial, sans-serif;
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .invoice table {
            margin: 50px;
        }

        .invoice h3 {
            margin-left: 50px;
        }

        .information {
            background-color: #e2e8f0;
            color: #2d3748;
        }

        .information .logo {
            margin: 5px;
        }

        .information table {
            padding: 10px;
        }
    </style>

</head>

<body>

    <div class="information">
        <table width="100%">
            <tr>
                <td align="left" style="width: 40%;">
                    <h3 style="margin-left: 50px;">{{$owner->name}}</h3>
                <pre>
                {{$owner->street ?: ''}}
                {{$owner->city ?: ''}}
                {{$owner->state ?: ''}}
                {{$owner->zip ?: ''}}
                {{$owner->country ?: ''}}
                    
                <br /><br />
                Invoice Date: {{ $invoice->date()->toFormattedDateString() ?: '' }}
                Invoice ID: {{ $id ?? $invoice->id ?: '' }}
                Status: {{$invoice->status}}
                </pre>


                </td>
                <td align="center">
                    <img src="{{public_path('images/logos/FullColor_TransparentBg_72dpi-147_x_128.png')}}" alt="trach.io logo"  class="logo" />
                </td>
                
                <td align="right" style="width: 40%;">

                    <h3>trach.io</h3>
                    <pre>

                    https://www.trach.io
                    Cork, 
                    Ireland
                    support@trach.io
                </pre>
                </td>
            </tr>

        </table>
    </div>


    <br />
    <div class="invoice">
        <h3>Invoice Details</h3>
        <table width="100%">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->subscriptions() as $subscription)

                <tr class="row">
                    <td>Subscription ({{ ucfirst($owner->plan->name) }} - {{$owner->plan->recurrance}})</td>
                    <td>
                        {{ $subscription->startDateAsCarbon()->formatLocalized('%B %e, %Y') }} -
                        {{ $subscription->endDateAsCarbon()->formatLocalized('%B %e, %Y') }}
                    </td>
                    <td>{{ $subscription->total() }}</td>
                </tr>
                @endforeach

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>

            <tfoot>
                <!-- Display The Discount -->
                @if ($invoice->hasDiscount())
                <tr>
                    <td colspan="2" style="text-align: right;">
                        @if ($invoice->discountIsPercentage())
                        {{ $invoice->coupon() }} ({{ $invoice->percentOff() }}% Off)
                        @else
                        {{ $invoice->coupon() }} ({{ $invoice->amountOff() }} Off)
                        @endif
                    </td>

                    <td>-{{ $invoice->discount() }}</td>
                </tr>
                @endif

                <!-- Display The Tax Amount -->
                @if ($invoice->tax_percent)
                <tr>
                    <td colspan="2" style="text-align: right;">Tax ({{ $invoice->tax_percent }}%)</td>
                    <td>{{ $invoice->tax() }}</td>
                </tr>
                @endif

                <!-- Display The Final Total -->
                <tr>
                    <td colspan="2" style="text-align: right;"><strong>Total</strong></td>
                    <td><strong>{{ $invoice->total() }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="information" style="position: absolute; bottom: 0;">
        <table width="100%">
            <tr>
                <td align="left" style="width: 50%;">
                    &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
                </td>
                <td align="right" style="width: 50%;">
                    trach.io - Tracheostomy care
                </td>
            </tr>

        </table>
    </div>
</body>

</html>