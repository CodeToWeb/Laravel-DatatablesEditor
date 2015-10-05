<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DataTables / Editor -> Laravel</title>

    <link href="css/app.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <link rel="stylesheet" type="text/css" href="css/editor.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//nightly.datatables.net/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//nightly.datatables.net/buttons/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//nightly.datatables.net/select/css/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/editor.dataTables.min.css">

    <script type="text/javascript" charset="utf-8" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="//nightly.datatables.net/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="//nightly.datatables.net/buttons/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="//nightly.datatables.net/select/js/dataTables.select.min.js"></script>

    <script type="text/javascript" charset="utf-8" src="js/dt-codetoweb.dataTables.editor.js"></script>

</head>
<body class="bootstrap">

<div style="margin:10px">
    <h2 >DataTables Editor Interface to Laravel 5</h2>

    <div class="col-sm-9 main ">

        <table class="table table-striped table-bordered " id="demo" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Updated Date</th>
            </tr>
            </thead>
        </table>
    </div>

</div>


<script>

    var editor; // use a global for the submit and return data rendering in the examples

    $(document).ready(function() {
        editor = new $.fn.dataTable.Editor( {
            // ajax: '/dt/public/data-response',
            ajax: {
                url: '/dt/public/data-response',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            table: '#demo',
            idSrc: "id",

            fields: [
                {
                    "label": "ID",
                    "name": "id"
                },
                {
                    "label": "First Name",
                    "name": "first_name"
                },
                {
                    "label": "Last Name",
                    "name": "last_name"
                },
                {
                    "label": "Update Date",
                    "name": "updated_date"
                }
            ]
        } );

        $('#demo').DataTable(
                {
                    dom: "Blfrtip",
                    processing: true,

                    // only needed for //yajra version
                    serverSide: true,
                    lengthChange: true,

                    "scrollY":  "300px",
                    "scrollCollapse": true,

                    ajax: '/dt/public/datatables/data', //yajra version under Laravel 5.1
                    columns: [
                        // Format for yajra version
                        {
                            "data": "id" , name: 'id'
                        },
                        {
                            "data": "first_name", name: 'first_name'
                        },
                        {
                            "data": "last_name", name: 'last_name'
                        },
                        {
                            "data": "updated_date", name: 'updated_date'
                        }

                        /*
                         // Format for datatables editor - php serverside
                         {
                         "data": "id"
                         },
                         {
                         "data": "name_first"
                         },
                         {
                         "data": "name_last"
                         }
                         */
                    ],
                    select: true,
                    buttons: [
                        { extend: "create", editor: editor },
                        { extend: "edit",   editor: editor },
                        { extend: "remove", editor: editor }
                    ]
                } );
    } );

</script>




</body>
</html>
