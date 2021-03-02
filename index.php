<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
    *:focus{
        box-shadow:none !important;
        outline:none !important;
    }
    </style>
  </head>
  <body>
        <div class="container-fluid p-4 bg-light">
            <dov class="row main">
                <div class="col-md-3">
                    <form method="post">
                        <h4>CREATE CUSTOM IMAGE</h4>
                        <hr>
                        <input type="number" class="form-control mb-1" id="width" placeholder="width" required="required">
                        <br>
                        <input type="number"  class="form-control mb-1" id="height" placeholder="height" required="required">
                        <br>
                        <input type="color" id="color" class="form-control mb-1">
                        <br>
                        <select class="form-control mb-1" id="format">
                            <option>jpeg</option>
                            <option>png</option>
                            <option>gif</option>
                        </select>
                        <br>
                        <button class="btn btn-primary submit-btn">Generate image</button>
                        </form>
                        <!-- resize image -->
                        <form action="POST" class="resize-form">
                        <h4 class="mt-2">RESIZE IMAGE</h4>
                        <hr>
                        <input type="file" class="form-control mb-1" id="file-input" name="file-input" required="required">
                        <br>
                        <input type="number" class="form-control mb-1" id="resize-width"  name="r-width"required="required" placeholder="width">
                        <br>
                        <input type="number" id="height_resize" class="form-control mb-1" name="r-height" placeholder="height" required="required">
                        <br>
                        <input type="color" id="color" class="form-control mb-1">
                        
                        
                        <br>
                        <button class="btn btn-primary resize-btn">RESIZE</button>
                        </form>
                </div>
                <div class="col-md-9 text-center bg-white shadow-sm overflow-auto">
                    <div class=" mt-5" id="result">
                    </div>
                </div>
            </dov>
        </div>
  </body>
</html>

<script type="text/javascript">
$(".main").css({
    height: $(window).height()-50,
});
$(window).resize(function(){
    $(".main").css({
    height: $(window).height()-50,
});
});
        $(document).ready(function(){
            $(".submit-btn").click(function(e){
                e.preventDefault();
            var width = $("#width").val();
            var height = $("#height").val();
            var color = $("#color").val();
            var format = $("#format").val();
            var a = color[1]+color[2];
            var b = color[3]+color[4];
            var c = color[5]+color[6];
             var r = parseInt(a,16);
            var g = parseInt(b,16);
            var b = parseInt(c,16);
            $.ajax({
                type: "POST",
                url:"image.php",
                data : {
                    width: width,
                    height: height,
                    red: r,
                    green: g,
                    blue: b,
                    format: format
                },
                success: function(response)
                {
                    //alert(response);
                    $("#result").html("");
                    var name = response.trim();

                    var img = document.createElement("img");


                    img.src = "images/"+name;
                    img.style.width = "80%";
                    img.style.marginLeft = "10%";
                    img.style.marginRight = "10%";
                    $("#result").append(img);
                    var a = document.createElement("a");
                    a.href = "images/"+name;
                    a.download = name;
                    a.innerHTML = "Download now";
                    a.className = "btn btn-primary py-2 my-5";
                    result.append(a);


                }
            });
        });
        });
        //upload file
        $(document).ready(function(){
                $("#file-input").on('change', function(){
                    var file = this.files[0];
                var url = URL.createObjectURL(file);
                var img = document.createElement("img");
                img.src = url;  
                $("#result").html(img);
                img.onload = function(){
                    var o_width = img.width;
                    var o_height = img.height;

                    $("#resize-width").on("input", function(){
                        var type_width = Number(this.value);
                        //alert(type_width);
                        var ratio = type_width / o_width;
                        var rac_height = Math.floor(o_height*ratio);

                        document.getElementById("height_resize").value = rac_height;
                        //$("#height").val(rac_height);
                        img.width = type_width;
                        img.height = rac_height;
                    });
                    $("#height_resize").on("input", function(){
                        var type_height = this.value;

                        img.height = type_height;
                    });
                }
                $(".resize-form").submit(function(e){
                    e.preventDefault();
                    var c_width = $("#r-width").val();
                    var c_height = $("#r-height").val();
                    $.ajax({
                        type: "POST",
                        url:"resize.php",
                        data: new FormData(this),
                        processData: false,
                        cache: false,
                        contentType: false,
                        success: function(response){
                            var link  = "images/"+response.trim();
                            var a = document.createElement("A");
                            a.href = link;
                            a.download = response;
                            a.innerHTML = "Download now";
                            a.className = "btn btn-danger py-2 my-2";
                            $("#result").append(a);
                        },
                    });
                });

            });
        });

</script>
