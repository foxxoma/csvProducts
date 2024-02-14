<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>
        <div id="tableContainer"></div>
        <nav aria-label="Page navigation example">
            <ul class="pagination" id="pagination"></ul>
        </nav>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </body>

    <style>
        /* Стили для таблицы */
        table { width:  100%; border-collapse: collapse; }
        th, td { padding:  8px; text-align: left; border-bottom:  1px solid #ddd; }
        tr:hover {background-color:#f5f5f5;}
    </style>

    <script type="text/javascript">
        var myHeaders = new Headers();
        myHeaders.append("Accept", "application/json");

        var requestOptions = {
          method: 'GET',
          headers: myHeaders,
          redirect: 'follow'
        };

        fetch("http://127.0.0.1:8000/api/v1/products", requestOptions)
          .then(response => response.text())
          .then(result => {
            let data = JSON.parse(result);
            renderTable(data);
            renderPagination(data);
          })
          .catch(error => console.log('error', error));

        function renderTable(data) {
            const table = $('<table/>');
            const thead = $('<thead/>').appendTo(table);
            const tbody = $('<tbody/>').appendTo(table);

            // Заголовки таблицы
            const headers = Object.keys(data.data[0]);
            const headerRow = $('<tr/>');
            headers.forEach(header => {
                headerRow.append(`<th>${header}</th>`);
            });
            thead.append(headerRow);

            // Данные таблицы
            data.data.forEach(item => {
                const row = $('<tr/>');
                headers.forEach(header => {
                    row.append(`<td>${item[header]}</td>`);
                });
                tbody.append(row);
            });

            $('#tableContainer').html(table);
        }

        function renderPagination(data) {
            const pagination = $('#pagination');
            pagination.empty();

            // Добавление кнопок пагинации
            data.meta.links.forEach(link => {
                const li = $('<li/>').addClass('page-item').appendTo(pagination);
                const a = $('<a/>')
                    .addClass('page-link')
                    .attr('href', '#' + link.label)
                    .text(link.label)
                    .appendTo(li);

                if (link.active) {
                    li.addClass('active');
                } else if (link.url === null) {
                    li.addClass('disabled');
                } else {
                    a.on('click', () => loadPage(link.url));
                }
            });
        }

        function loadPage(url) {
            fetch(url, requestOptions)
              .then(response => response.text())
              .then(result => {
                let data = JSON.parse(result);
                renderTable(data);
                renderPagination(data);
              })
              .catch(error => console.log('error', error));
            // Здесь вы можете загрузить данные с сервера по указанному URL
            // и затем вызвать renderTable и renderPagination с полученными данными
        }
    </script>
</html>
