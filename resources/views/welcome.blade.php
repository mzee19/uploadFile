<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->


    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Styles -->

    <style>
        .progress {
            position: relative;
            width: 100%;
        }

        .bar {
            background-color: #b5076f;
            width: 0%;
            height: 20px;
        }

        .percent {
            position: absolute;
            display: inline-block;
            left: 50%;
            color: #040608;
        }
    </style>
</head>
<body>
<div class="">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Upload Images & Videos</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="POST" action="{{route('storeImage')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input name="files[]" type="file" required multiple class="form-control"><br/>
                                <div class="progress">
                                    <div class="bar"></div>
                                    <div class="percent">0%</div>
                                </div>
                                <br>
                                <input type="submit" value="Submit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

<script type="text/javascript">


    $(function () {
        $(document).ready(function () {
            var bar = $('.bar');
            var percent = $('.percent');

            $('form').ajaxForm({
                beforeSend: function() {
                    var percentVal = '0%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                complete: function(response) {
                    if(response.status == 1){
                        alert('File Has Been Uploaded Successfully');
                        window.location.reload()
                        return true
                    }
                    var printErrorMessages = ".alert";
                    $(printErrorMessages).find('ul').html('');
                    $(printErrorMessages).css('display', 'block');
                    $.each(response.responseJSON.errors, function (key, value) {
                        $(printErrorMessages).find("ul").append('<li>' + value + '</li>');
                    });

                    setTimeout(function () {
                        let hideErrorMessage = ".alert"
                        $(hideErrorMessage).hide()
                    }, 4000);


                }
            });
        });
    });
</script>
</body>
</html>
