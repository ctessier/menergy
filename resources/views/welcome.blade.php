<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>

        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>

        <link rel="stylesheet" type="text/css" href="{{ mix('/css/vendor.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ mix('/css/app.css') }}">
    </head>
    <body>
        <div id="app" class="container">

            <menergy-tabs>
                <menergy-tab name="Electricité" :selected="true">
                <div class="box">
                  graph goes here.
                </div>
                  <menergy-form></menergy-form>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Relève</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Date</th>
                        <th>Relève</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <tr>
                        <td>20/01/2017</td>
                        <td>560</td>
                      </tr>
                      <tr>
                        <td>20/01/2017</td>
                        <td>560</td>
                      </tr>
                      <tr>
                        <td>20/01/2017</td>
                        <td>560</td>
                      </tr>
                      <tr>
                        <td>20/01/2017</td>
                        <td>560</td>
                      </tr>
                      <tr>
                        <td>20/01/2017</td>
                        <td>560</td>
                      </tr>
                      <tr>
                        <td>20/01/2017</td>
                        <td>560</td>
                      </tr>
                      <tr>
                        <td>20/01/2017</td>
                        <td>560</td>
                      </tr>
                      <tr>
                        <td>20/01/2017</td>
                        <td>560</td>
                      </tr>
                    </tbody>
                </table>
                </menergy-tab>
                <menergy-tab name="Gaz">
                  no content here.
                </menergy-tab>

            </menergy-tabs>

        </div>

        <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
