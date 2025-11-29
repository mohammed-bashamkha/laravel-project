<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>كشف حساب</title>
    <style>
        /* خطوط وألوان عامة */
        body {

            font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #ffffff;
            color: #000;
        }

        .container {
            width: 70%;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header .company img {
            height: 70px;
        }

        .header .app-logo img {
            height: 60px;
        }

        .header .text {
            text-align: right;
        }

        .header .text h2 {
            font-size: 22px;
            margin: 0;
        }

        .header .text p {
            margin: 5px 0 0 0;
        }

        /* Cards */
        .cards {
            display:flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card {
            flex: 1 1 30%;
            background-color: #f3f4f6;
            padding: 5px;
            border-radius: 8px;
            text-align: center;
            margin: 0 5px;
            border: 1px solid #ccc;
        }

        .card p.title {
            font-size: 14px;
            margin: 0;
            font-weight: bold;
        }

        .card p.amount {
            font-size: 18px;
            margin: 5px 0 0 0;
            font-weight: bold;
        }

        .green { color: #15803d; }
        .red { color: #b91c1c; }
        .blue { color: #1d4ed8; }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: right;
            font-size: 14px;
        }

        th {
            background-color: #e5e7eb;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f3f4f6;
        }

        tr:hover {
            background-color: #e0e0e0;
        }

        /* Footer */
        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
        }

        /* للطباعة PDF */
        @media print {
            body {
                padding: 0;
                background-color: #fff;
            }

            .card {
                page-break-inside: avoid;
            }

            .header, .footer {
                page-break-inside: avoid;
            }

            table, th, td {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Header -->
        <div class="header">
            <div class="text">
                <h2>كشف حساب</h2>
                @if ($entity->type == 'worker')
                    <p>أسم العامل: {{ $entity->name }}</p>
                @else
                    <p>أسم المشروع: {{ $entity->name }}</p>
                @endif
            </div>
            <div class="company">
                <h2>Daily Cash</h2>
            </div>
        </div>

        <!-- Cards -->
        <div class="cards">
            <div class="card green">
                <p class="title">إجمالي لكم</p>
                <p class="amount">{{ number_format($total_income, 2) }} ريال</p>
            </div>

            <div class="card red">
                <p class="title">إجمالي عليكم</p>
                <p class="amount">{{ number_format($total_expense, 2) }} ريال</p>
            </div>

            <div class="card blue">
                <p class="title">الرصيد المتبقي</p>
                <p class="amount">{{ number_format($balance, 2) }} ريال</p>
            </div>
        </div>

        <!-- Table -->
        <h3 style="margin-bottom: 10px; direction: rtl;">تفاصيل العمليات</h3>
        <table>
            <thead>
                <tr>
                    <th>التاريخ</th>
                    <th>النوع</th>
                    <th>المبلغ</th>
                    <th>الوصف</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $t)
                <tr>
                    <td>{{ $t->date }}</td>
                    <td>
                        @if($t->type === 'income')
                            <span class="green">لكم</span>
                        @else
                            <span class="red">عليكم</span>
                        @endif
                    </td>
                    <td>{{ number_format($t->amount, 2) }}</td>
                    <td>{{ $t->description ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer -->
        <div class="footer">
            تم إنشاء كشف الحساب بواسطة نظام إدارة النقدية
        </div>

    </div>
</body>
</html>
