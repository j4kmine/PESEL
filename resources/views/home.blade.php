<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>PESEL Number Generator</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" referrerpolicy="no-referrer" />
    <style>
         :root {
            --dimension: 100px;
            --thickness: 4px;
            --color: red;
        }
        
        @keyframes rotate {
            to {
                transform: rotate(360deg);
            }
        }
        
        .arc {
            position: relative;
            width: var(--dimension);
            height: var(--dimension);
        }
        
        .arc:before,
        .arc:after {
            border-bottom: var(--thickness) solid var(--color);
            border-left: var(--thickness) solid transparent;
            border-radius: 50%;
            border-right: var(--thickness) solid var(--color);
            border-top: var(--thickness) solid var(--color);
            bottom: 0;
            box-sizing: border-box;
            content: '';
            left: 0;
            margin: auto;
            position: absolute;
            right: 0;
            top: 0;
            transform-origin: center center;
        }
        
        .arc:before {
            animation: rotate 1s ease-in-out infinite;
            height: 100%;
            width: 100%;
        }
        
        .arc:after {
            animation: rotate 1s ease-in-out infinite reverse;
            height: 50%;
            width: 50%;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">PESEL NUMBERS GENERATOR</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <form class="well form-horizontal" action=" " method="post" id="contact_form">
            <fieldset>
                <legend>Generate Pesel!</legend>
                <div class="form-group">
                    <label class="col-md-4 control-label">Brith Date</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input id="datepicker" name="brith" placeholder="Brith Date" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Gender</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="M" checked>Male
                              </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="F">Female
                              </label>
                        </div>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4">
                        <button type="button" id="submitbtn" class="btn btn-warning">Generate <span class="glyphicon glyphicon-send"></span></button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    </div>
    <div class="container">
        <div class="col-md-4 col-md-offset-4 col-xs-12">
            <div class="arc" style="display: none;"></div>
            <div class="panel panel-default" style="display: none;">
                <div class="panel-heading">Result</div>
                <div class="panel-body">
                    <h5>PESEL </h5>
                    <b class="pesel"></b>
                    <h5>German SVN </h5>
                    <b class="svn"></b>
                    <h5>Dutch BSN</h5>
                    <b class="bsn"></b>
                </div>
            </div>
        </div>
    </div>

    <!-- /.container -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd",

            });
            $("#submitbtn").click(function(e) {
                e.preventDefault();
                $(".panel").hide();
                $('#arc').show();
                var brith = $("#datepicker").val();
                var gender = $('input[name="gender"]:checked').val();
                var query = {};
                if(brith && gender){
                    var query = {
                        brith: brith,
                        gender: gender      
                    };
                }
               
              
                $.ajax({
                    type: "POST",
                    url: '{{url("generate")}}',
                    data: query,
                    success: function(data) {
                        $('#arc').hide();
                        $(".panel").show();
                        $(".pesel").text(data["pesel"]);
                        $(".bsn").text(data.bsn);
                        $(".svn").text(data.svn);
                    }
                }); 
            });
        });
    </script>
</body>

</html>