<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Breeze Exercise</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles --><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            #groups_table th:hover {
              background: grey;
            }

            th.asc:after {
              content: '\25b2';
            }

            th.desc:after {
              content: '\25bc';
            }

        </style>
    </head>
    <body>
      <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light clear">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href= "{{ action('Group@index') }}">Groups <span class="sr-only">current</span></a></li>
                  <li>
                  <a class="nav-link" href="{{ route('import') }}">Import</a></li>
                </ul>
              </nav>

            <div class="content">
                @yield('content')
            </div>
        </div>
      </div>
      <script>
        $("*[ajax-call]").on('click', function(e) {
          $('this').addClass('active');
          var url = $(this).attr('ajax-call');
          e.preventDefault();
        
        $.ajax({
          type:'get',
          url: url,
          success: function (response) {
            var trHTML = '';
            $("#groups_table tbody").empty();
            $.each(response, function (i, item) {
              trHTML += '<tr scope="col"><td>' + item.id + '</td><td>' + item.first_name + '</td><td>' + item.last_name + '</td><td>' + item.email + '</td></</tr>';
            });

            $('#groups_table tbody').append(trHTML);
          }
        });
          });

    $('#groups_table th').click(function(){
      $('#groups_table th').removeClass('desc');
      $('#groups_table th').removeClass('asc');
      var table = $(this).parents('table').eq(0)
      var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
      this.asc = !this.asc
      if (!this.asc){
        rows = rows.reverse();
        $(this).addClass('asc');
      } else {
        $(this).addClass('desc');
      }
      for (var i = 0; i < rows.length; i++){table.append(rows[i])}
      });

      function comparer(index) {
          return function(a, b) {
          var valA = getCellValue(a, index), valB = getCellValue(b, index)
          return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
      }
      }

    function getCellValue(row, index){ return $(row).children('td').eq(index).text() }

    $('#import_csv').on('submit', function(e){
    
      e.preventDefault();
      $('#csv_panel .alert').remove();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
              var rows = '';
              rows += '<tr>';
              $.each(Object.keys(data[0][0]), function (i, item) {
                rows += '<th>' + item + '</th>';
              });
              rows += '</tr>';
              $.each(data[0], function (i, row) {
                rows += '<tr>';
                $.each(row, function (i, item) {
                  rows += '<td>' + item + '</td>';
                });
                rows += '</tr>';
              });
              $("#csv_panel").append('<div class="alert alert-success" role="alert">Submission was successful.</div>')
              $("#csv_panel").append('<table class="alert alert-success" role="alert">' + rows + '</table>')

                console.log('Submission was successful.');
                console.log(data);
            },
            error: function (data) {
              var items = "";
              $.each(data.responseJSON.errors, function (i, item) {
                if(item.isArray) {
                  items += '<li>' + item[0] + '</li>';
                } else {
                  items += '<li>' + item + '</li>';
                }
              });
              var html = '<div class="alert alert-danger" role="alert">' + items + '</div>';
              $("#csv_panel").append(html);

                console.log('An error occurred.');
                console.log(data);
            },
        });
    });

      </script>
    </body>
</html>
