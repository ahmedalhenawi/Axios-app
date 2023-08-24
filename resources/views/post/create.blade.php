<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
    <title>Document</title>
</head>
<body>


    <div class="container">
        <div class="row">

          <div class="col-5 mt-5">

            <form id="my-form">
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control" name="title" id="title" >
                </div>
                <div class="mb-3">
                  <label for="content" class="form-label">Content</label>
                  <input type="text" class="form-control" name="content" id="content">
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" name='status' id="status">
                  <label class="form-check-label" for="status" >Check me out</label>
                </div>
                <div class="mb-3">
                    <label for="cover" class="form-label">Default file input example</label>
                    <input class="form-control" type="file" id="cover" name="cover" >
                </div>
                <button type="button" onclick="create()" class="btn btn-primary">Submit</button>
              </form>




            </div>

        </div>
      </div>


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <script src="{{asset('js/bootstrap.min.js')}}"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> --}}
      <script>
        function create(){
            console.log(123);

            const myForm = document.getElementById('my-form');
            const formData = new FormData(myForm);
            formData.append('ahmed' , 'alhenawi');
            formData.append('status' , document.getElementById('status').checked);
            formData.append('_method' , 'put');


            // for (var pair of formData.entries()) {
            //     console.log(pair[0]+ ', ' + pair[1]);
            // }

            axios.post('{{ route('post.update' , ['post'=>1]) }}', formData)
                .then(function(response) {
                    swal(response.data.message);
                    document.getElementById('my-form').reset();
                })
                .catch(function(error) {
                    console.log(error);
                    swal(error.response.data.message);
                });
        }
      </script>

</body>
</html>
