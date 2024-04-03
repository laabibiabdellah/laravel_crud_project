@props(['title','btnTitle','btnRoute'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD | {{$title}}</title>
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="root">
        <div class="w-100 bg-dark">
            <h2 class="py-4 text-white text-center">CRUD PROJECT</h2>
        </div>
        <div class="container mx-auto">
            <div class="position-relative">
                <h3 class="py-4 text-center">{{$title}}</h3>
                <a id="list-btn" class="btn" href="{{route($btnRoute)}}">{{$btnTitle}}</a>
            </div>
            <div class="pb-5">
                {{$slot}}
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>