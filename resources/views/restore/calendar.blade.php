<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Backup kalender</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f6f7f9;
            margin: 0;
            padding: 40px 20px;
            color: #111827;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 28px;
            margin: 0;
        }

        .btn {
            background: #2563eb;
            color: #fff;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
        }

        .btn:hover {
            background: #1e4fd8;
        }

        .card {
            background: rgba(255,255,255,0.8);
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            backdrop-filter: blur(8px);
        }

        /* FullCalendar styling */
        .fc .fc-toolbar-title {
            font-size: 18px;
            font-weight: 700;
        }

        .fc .fc-daygrid-event {
            border-radius: 10px;
            padding: 4px 8px;
            font-weight: 600;
        }

        .fc .fc-daygrid-day-number {
            font-weight: 600;
            color: #374151;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="topbar">
        <h1>Backup kalender</h1>

        <a class="btn" href="/restore?token={{ urlencode($token) }}">
            Lijstweergave
        </a>
    </div>

    <div class="card">
        <div id="calendar"></div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const events = @json($events);
    const token  = @json($token);

    const calendar = new FullCalendar.Calendar(
        document.getElementById('calendar'),
        {
            initialView: 'dayGridMonth',
            height: 'auto',
            firstDay: 1, // maandag
            events: events,

            eventClick: function(info) {
                info.jsEvent.preventDefault();

                const day = info.event.extendedProps.day;

                // Klik op dag → ga naar lijst gefilterd op datum
                window.location.href =
                    '/restore?token=' + encodeURIComponent(token) +
                    '&date=' + encodeURIComponent(day) +
                    '&from_calendar=1';
            }
        }
    );

    calendar.render();
});
</script>

</body>
</html>

