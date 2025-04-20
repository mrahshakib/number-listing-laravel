<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Number Listing System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container mx-auto bg-light mt-5 p-4 rounded">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center mb-2">
                    <h2>Phone Number Listing System</h2>
                    <a href="{{route('index')}}"><button class="btn btn-dark mt-3">Home</button></a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('edit.store', $data->id)}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control form-control-lg"
                                            placeholder="Enter Name Here" value="{{old('name', $data->name)}}">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" name="number" id="number"
                                            class="form-control form-control-lg" placeholder="Enter Number Here"
                                            value="{{old('number', $data->number)}}" oninput="convert(this)">
                                        @error('number')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group d-flex justify-content-center">
                                        <button class="btn btn-success btn-lg">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <h4 class="text-center text-secondary">Edit Number</h4>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script>
        //Convert Bangla to english
        function convert(input) {
            const banglaDigits = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
            const englishDigits = ['0','1','2','3','4','5','6','7','8','9'];
        
            let converted = input.value.split('').map(char => {
                let index = banglaDigits.indexOf(char);
                return index !== -1 ? englishDigits[index] : char;
            }).join('');
        
            input.value = converted;
        }
    </script>
</body>

</html>
