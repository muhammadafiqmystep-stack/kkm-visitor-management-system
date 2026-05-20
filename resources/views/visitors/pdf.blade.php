<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Visitor Pass #{{ str_pad($visitor->id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            margin: 18mm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            background: #e8e4dc;
            color: #1a1a1a;
            font-size: 11px;
            line-height: 1.35;
        }

        .page-wrap {
            padding: 8px 0;
        }

        .ticket {
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
            border-collapse: collapse;
            border: 2px solid #0d0d0d;
            background: #faf8f3;
        }

        .ticket td {
            vertical-align: top;
        }

        /* Main body */
        .ticket-main {
            width: 78%;
            padding: 0;
            border-right: none;
        }

        .ticket-header {
            background: #0f0f12;
            color: #f5e6c8;
            padding: 14px 18px 12px;
            border-bottom: 3px solid #c9a227;
        }

        .ticket-header .brand {
            font-size: 9px;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: #a89878;
            margin-bottom: 4px;
        }

        .ticket-header h1 {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin: 0;
            line-height: 1.1;
        }

        .ticket-header .admit {
            margin-top: 6px;
            font-size: 11px;
            letter-spacing: 0.35em;
            color: #c9a227;
            font-weight: bold;
        }

        .ticket-body {
            padding: 16px 18px 14px;
        }

        .meta-row {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }

        .meta-row td {
            padding: 0;
            border: none;
            vertical-align: bottom;
        }

        .ticket-no {
            font-size: 10px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .ticket-no strong {
            display: block;
            font-size: 18px;
            color: #0f0f12;
            letter-spacing: 0.06em;
            margin-top: 2px;
        }

        .issued {
            text-align: right;
            font-size: 10px;
            color: #666;
        }

        .issued strong {
            display: block;
            color: #1a1a1a;
            font-size: 11px;
            margin-top: 2px;
        }

        .field {
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 1px dashed #ccc5b8;
        }

        .field:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .field label {
            display: block;
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            color: #888;
            margin-bottom: 3px;
        }

        .field .value {
            font-size: 14px;
            font-weight: bold;
            color: #0f0f12;
            word-break: break-word;
        }

        .field .value.name {
            font-size: 17px;
            letter-spacing: 0.02em;
        }

        .barcode-block {
            margin-top: 14px;
            padding-top: 10px;
            border-top: 1px solid #ddd6c8;
        }

        .barcode {
            height: 36px;
            overflow: hidden;
            line-height: 0;
        }

        .barcode span {
            display: inline-block;
            height: 36px;
            background: #0f0f12;
            margin-right: 1px;
            vertical-align: top;
        }

        .barcode-id {
            margin-top: 5px;
            font-size: 9px;
            letter-spacing: 0.25em;
            text-align: center;
            color: #444;
        }

        /* Perforation + stub */
        .ticket-perf {
            width: 4%;
            background: #faf8f3;
            padding: 0;
            position: relative;
        }

        .perf-line {
            width: 100%;
            min-height: 220px;
            border-left: 2px dashed #8a8278;
            border-right: 2px dashed #8a8278;
            background: #f0ebe3;
        }

        .ticket-stub {
            width: 18%;
            background: #0f0f12;
            color: #f5e6c8;
            padding: 12px 10px;
            text-align: center;
        }

        .stub-rotate-wrap {
            padding: 8px 0;
        }

        .stub-title {
            font-size: 8px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #c9a227;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .stub-id {
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 0.08em;
            margin-bottom: 12px;
            color: #fff;
        }

        .stub-name {
            font-size: 9px;
            line-height: 1.3;
            color: #c8beb0;
            word-break: break-word;
            max-height: 48px;
            overflow: hidden;
        }

        .stub-foot {
            margin-top: 14px;
            font-size: 7px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #6a6258;
        }

        .notch-row td {
            height: 10px;
            background: #e8e4dc;
            border: none;
        }

        .notch {
            width: 18px;
            height: 18px;
            background: #e8e4dc;
            border-radius: 50%;
            border: 2px solid #0d0d0d;
            margin: 0 auto;
        }

        .fine-print {
            margin-top: 12px;
            text-align: center;
            font-size: 8px;
            color: #888;
            letter-spacing: 0.05em;
        }
    </style>
</head>
<body>
@php
    $ticketCode = 'VP-' . str_pad($visitor->id, 6, '0', STR_PAD_LEFT);
    $issuedAt = $visitor->created_at
        ? $visitor->created_at->timezone(config('app.timezone'))->format('d M Y · H:i')
        : now()->format('d M Y · H:i');
    $seed = (int) $visitor->id * 7919;
@endphp
<div class="page-wrap">
    <table class="ticket" cellpadding="0" cellspacing="0">
        <tr class="notch-row">
            <td colspan="3" style="border: 2px solid #0d0d0d; border-bottom: none; background: #faf8f3;">
                <div class="notch"></div>
            </td>
        </tr>
        <tr>
            <td class="ticket-main">
                <div class="ticket-header">
                    <div class="brand">Visitor Registration</div>
                    <h1>Entry Pass</h1>
                    <div class="admit">Admit One · Guest</div>
                </div>
                <div class="ticket-body">
                    <table class="meta-row">
                        <tr>
                            <td class="ticket-no">
                                Ticket number
                                <strong>{{ $ticketCode }}</strong>
                            </td>
                            <td class="issued">
                                Valid from
                                <strong>{{ $issuedAt }}</strong>
                            </td>
                        </tr>
                    </table>

                    <div class="field">
                        <label>Guest name</label>
                        <div class="value name">{{ $visitor->name }}</div>
                    </div>
                    <div class="field">
                        <label>Phone</label>
                        <div class="value">{{ $visitor->phone }}</div>
                    </div>
                    <div class="field">
                        <label>Email</label>
                        <div class="value">{{ $visitor->email }}</div>
                    </div>

                    <div class="barcode-block">
                        <div class="barcode">
                            @for ($i = 0; $i < 52; $i++)
                                @php
                                    $w = (($seed + $i * 17) % 5) + 1;
                                @endphp
                                <span style="width: {{ $w }}px;"></span>
                            @endfor
                        </div>
                        <div class="barcode-id">{{ $ticketCode }}</div>
                    </div>
                </div>
            </td>
            <td class="ticket-perf">
                <div class="perf-line"></div>
            </td>
            <td class="ticket-stub">
                <div class="stub-rotate-wrap">
                    <div class="stub-title">Stub</div>
                    <div class="stub-id">{{ $ticketCode }}</div>
                    <div class="stub-name">{{ $visitor->name }}</div>
                    <div class="stub-foot">Present at desk</div>
                </div>
            </td>
        </tr>
        <tr class="notch-row">
            <td colspan="3" style="border: 2px solid #0d0d0d; border-top: none; background: #faf8f3;">
                <div class="notch"></div>
            </td>
        </tr>
    </table>
    <p class="fine-print">This pass is generated for registered visitors only. Non-transferable.</p>
</div>
</body>
</html>